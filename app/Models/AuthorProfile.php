<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class AuthorProfile extends Model
{
    use HasFactory, Filterable;

    protected $table = 'custom_author_profiles';

    protected $fillable = [
        'uid',
        'name',
        'biography',
        'tone',
        'style',
        'image',
        'user_id',
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
     * Get the books written by this author profile.
     *
     * @return HasMany
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'author_profile_id');
    }

    public function user()
{
    return $this->belongsTo(User::class);
}

}
