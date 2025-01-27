<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChapterTopic extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'chapter_id',
        'title',
        'paragraph',
        'image',
    ];

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
