<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Chapter extends Model
{
    use HasFactory, Filterable;

    protected $table = 'custom_chapters';

    protected $fillable = [
        'uid',
        'title',
        'has_image',
        'content',
        'book_id',
        'retry_attempts',
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
     * Get the book that owns the chapter.
     *
     * @return BelongsTo
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    /**
     * Get the chapter content
     *
     * @return HasMany
     */
    public function topics(): HasMany
    {
        return $this->hasMany(ChapterTopic::class, 'chapter_id');
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
