<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class Book extends Model
{
    use HasFactory, Filterable;

    protected $table = 'custom_books';

    protected $fillable = [
        'uid',
        'title',
        'genre',
        'language',
        'purpose',
        'target_audience',
        'length',
        'synopsis',
        'user_id',
        'author_profile_id',
        'about_author',
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
     * Get the chapters for the book.
     *
     * @return HasMany
     */
    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class, 'book_id');
    }

    public function chaptersCount(): int
{
    return $this->chapters()->count();
}

public function media(): HasMany
{
    return $this->hasMany(BookMedia::class, 'book_id');
}

    /**
     * Get the author profile associated with the book.
     *
     * @return BelongsTo
     */
    public function authorProfile(): BelongsTo
    {
        return $this->belongsTo(AuthorProfile::class, 'author_profile_id');
    }

    /**
     * Get the user who owns the book.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope for filtering by status.
     *
     * @param Builder $query
     * @param string $status
     * @return Builder
     */
    public function scopeStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }
}
