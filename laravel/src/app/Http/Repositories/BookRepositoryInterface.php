<?php

namespace App\Http\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;

interface BookRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get all books by paginate
     *
     * @param array $data
     *
     * @return LengthAwarePaginator|null
     */
    public function getAllByPagination(array $data): ?LengthAwarePaginator;

    /**
     * Add a book to category
     *
     * @param int $bookId
     *
     * @param int $categoryId
     *
     * @return bool
     */
    public function addBookToCategory(int $bookId, int $categoryId): bool;

    /**
     * Update book in category
     *
     * @param int $bookId
     *
     * @param int $categoryId
     *
     * return bool
     */
    public function updateBookInCategory(int $bookId, int $categoryId): bool;

    /**
     * Get all id of books by query like name
     * 
     * @param string $name
     * 
     * @return array
    */
    public function getIdsByName(string $name): array;
}
