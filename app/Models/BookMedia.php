<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookMedia extends Model
{
    use HasFactory;

    protected $table = 'book_media';

    protected $fillable = [
        'book_id',
        'file_path',
        'type', // Example: 'image', 'video', etc.
    ];

    /**
     * Get the book associated with the media.
     *
     * @return BelongsTo
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
