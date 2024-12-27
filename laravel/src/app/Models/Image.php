<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'book_id',
        'url',
    ];

    /**
     * Relationship to the book table
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
