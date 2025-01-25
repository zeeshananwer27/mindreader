<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Audiobook extends Model
{
    use HasFactory, Filterable;

    protected $table = 'custom_audiobooks';

    protected $fillable = [
        'uid',
        'file_path',
        'book_id',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    protected static function booted()
    {
        static::creating(function (Model $model) {
            $model->uid = Str::uuid();
        });
    }

    /**
     * Get the book associated with the audiobook.
     *
     * @return BelongsTo
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
