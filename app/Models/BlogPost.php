<?php

namespace App\Models;

use App\Models\User;
use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes;

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
    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
