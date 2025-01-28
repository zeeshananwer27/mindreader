<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ChapterTopic extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'uid',
        'chapter_id',
        'order',
        'type',
        'content',
    ];

    protected static function booted(): void
    {
        static::creating(function (Model $model) {
            $model->uid = Str::uuid();
        });
    }

    /**
     * Get the Chapter that owns the topic.
     *
     * @return BelongsTo
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }
}
