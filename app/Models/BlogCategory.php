<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogCategory
 * 
 * @package App\Models
 * 
 * @property-read BlogCategory  $parentCategory
 * @property-read string        $parentTitle
 */
class BlogCategory extends Model
{
    use SoftDeletes;

    /**
     * ID корневой категории
     */
    const ROOT = 1;
    
    protected $fillable
    =[
        'title',
        'slug',
        'parent_id',
        'description',
    ];

    /**
     * Получить родительскую категорию
     *
     * @return BlogCategory
     */
    public function parentCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }

    /**
     * Accessor example
     *
     * read more in Laravel Docs -> eloquuent-mutators
     * 
     * @return string
     */
    public function getParentTitleAttribute()
    {
        $title = $this->parentCategory->title
            ?? ($this->isRoot()
            ? 'Корень'
            : '???');

        return $title;
    }

    /**
     * Проверка я вляется ли текущий объект корневым
     *
     * @return boolean
     */
    public function isRoot()
    {
        return $this->id === BlogCategory::ROOT;
    }


    /*
     * Mutators test
     
        //  /**
        //  * Accessor example
        //  *
        //  * @param [type] $valueFromObject
        //  * @return bool|mixed|null|string|string[]
        //  */
        // public function getTitleAttribute($valueFromObject)
        // {
        //     return mb_strtoupper($valueFromObject);
        // }

        // /**
        //  * Mutator example
        //  *
        //  * @param [type] $incomingValue
        //  * @return void
        //  */
        // public function setTitleAttribute($incomingValue)
        // {
        //     $this->attributes['title'] = mb_strtolower($incomingValue);
        // }
        // */
      
}
