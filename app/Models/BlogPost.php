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
 * @property App\Models\BlogCategory    $blogCategory
 * @property App\Models\User            $user
 * @property string                     $title
 * @property string                     $slug
 * @property string                     $blog_category_id
 * @property string                     $excerpt
 * @property boolean                     $is_published
 */
class BlogPost extends Model
{
    use SoftDeletes;

    protected $fillable = 
    [
        'title',
        'slug',
        'blog_category_id',
        'excerpt',
        'is_published',
    ];

    /**
     * Категория статьи
     *
     * @return \Illuminate\Database\Eloquent\BelongsTo
     */
    public function blogCategory()
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
