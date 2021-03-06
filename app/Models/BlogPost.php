<?php

namespace App\Models;

use App\Models\User;
use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class BlogPost
 * 
 * @package App\Models
 * @property App\Models\BlogCategory    $category
 * @property App\Models\User            $user
 * @property string                     $title
 * @property string                     $slug
 * @property string                     $category_id
 * @property string                     $excerpt
 * @property string                     $content_raw
 * @property string                     $published_at
 * @property boolean                    $is_published
 */
class BlogPost extends Model
{
    use SoftDeletes;

    const UNKNOWN_USER = 1;

    protected $fillable = 
    [
        'title',
        'slug',
        'category_id',
        'excerpt',
        'content_raw',
        'is_published',
        'published_at',
        // 'user_id',
    ];

    /**
     * Категория статьи
     *
     * @return \Illuminate\Database\Eloquent\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }
    /**
     * Автор статьи
     *
     * @return \Illuminate\Database\Eloquent\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
