<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author_id',
        'publisher_id',
        'name',
        'slug',
        'mini_description',
        'details_description',
        'publication_date',
        'quantity',
        'size',
        'page',
        'cover_type',
        'views',
        'borrowing_number',
        'image',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'publication_date' => 'date',
    ];

    /**
     * Mutators for attributes slug
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * Relationship to the author table
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Relationship to the publisher table
     */
    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    /**
     * Relationship to the category table
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_categories')->withTimestamps();
    }

    /**
     * Relationship to the image table
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    /**
     *  Relationship to the wish_list table
     */
    public function wishLists()
    {
        return $this->belongsToMany(User::class, 'wish_lists')->withTimestamps();
    }

    /**
     * Relationship to the user table
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'carts')->withPivot('quantity')->withTimestamps();
    }

    /**
     * Relationship to the book_order table
     */
    public function orderDetails()
    {
        return $this->belongsToMany(Order::class, 'order_details')->withPivot(
            'borrow_date',
            'return_date',
            'quantity',
            'note',
            'status'
        )->withTimestamps();
    }

    /**
     * Relationship to the review table
     */
    public function feedbacks()
    {
        return $this->belongsToMany(User::class, 'feedbacks')->withPivot(
            'content',
            'star',
            'status'
        )->withTimestamps();
    }
}
