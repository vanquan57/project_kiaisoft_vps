<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\BookRepositoryInterface;
use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{
    /**
     * Get model
     *
     * @return string
     */
    public function getModel(): string
    {
        return Book::class;
    }

    /**
     * Get all books by paginate
     *
     * @param array $data
     *
     * @return LengthAwarePaginator
     */
    public function getAllByPagination(array $data): ?LengthAwarePaginator
    {
        $query = $this->model->query()->select(
            'id',
            'author_id',
            'publisher_id',
            'name',
            'quantity',
            'views',
            'image'
        )
            ->with([
                'author:id,name',
                'publisher:id,name',
                'categories' => function ($query) {
                    $query->select('categories.id', 'categories.name');
                },
            ]);

        if (!empty($data['name'])) {
            $query->where('name', 'like', '%' . $data['name'] . '%');
        }

        if (!empty($data['author_id'])) {
            $query->where('author_id', $data['author_id']);
        }

        if (!empty($data['publisher_id'])) {
            $query->where('publisher_id', $data['publisher_id']);
        }

        if (!empty($data['category_id'])) {
            $categoryId = $data['category_id'];
            $query->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            });
        }

        if(!empty($data['column']) && !empty($data['order'])) {
            $query->orderBy($data['column'], $data['order']);
        }

        return $query->paginate($data['limit']);
    }

    /**
     * The method find a book by id
     *
     * @param int $id
     *
     * @return Book|null
     */
    public function find(int $id): ?Book
    {
        return $this->model->with([
            'author',
            'publisher',
            'categories',
            'images',
        ])->find($id);
    }

    /**
     * Add a book to category
     *
     * @param int $bookId
     *
     * @param int $categoryId
     *
     * @return bool
     */
    public function addBookToCategory(int $bookId, int $categoryId): bool
    {
        $book = $this->find($bookId);

        if ($book->categories()->attach($categoryId)) {
            return true;
        }

        return false;
    }

    /**
     * Update book in category
     *
     * @param int $bookId
     *
     * @param int $categoryId
     *
     * return bool
     */
    public function updateBookInCategory(int $bookId, int $category_id): bool
    {
        $book = $this->find($bookId);

        if ($book->categories()->sync($category_id)) {
            return true;
        }

        return false;
    }

    /**
     * Destroy a book
     *
     * @param int $id
     *
     * @return bool
     */
    public function destroy(int $id): bool
    {
        if ($book = $this->find($id)) {
            if ($book->orderDetails()->exists()) {
                return false;
            }

            $book->delete();

            return true;
        }

        return false;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function store(array $attributes): Model
    {
        return $this->model->create([
            'author_id' => $attributes['author_id'],
            'publisher_id' => $attributes['publisher_id'],
            'category_id' => $attributes['category_id'],
            'name' => $attributes['name'],
            'slug' => $attributes['name'],
            'mini_description' => $attributes['mini_description'],
            'details_description' => $attributes['details_description'],
            'publication_date' => $attributes['publication_date'],
            'image' => $attributes['image'],
            ... $attributes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * 
     * @param array $attributes
     *
     * @return bool
     */
    public function update(int $id, array $attributes): bool
    {
        return $this->model->find($id)->update([
            'author_id' => $attributes['author_id'],
            'publisher_id' => $attributes['publisher_id'],
            'category_id' => $attributes['category_id'],
            'name' => $attributes['name'],
            'slug' => $attributes['name'],
            'mini_description' => $attributes['mini_description'],
            'details_description' => $attributes['details_description'],
            'publication_date' => $attributes['publication_date'],
            ... $attributes,
        ]);
    }
}
