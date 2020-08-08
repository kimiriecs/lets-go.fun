<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\BlogCategory;

class BlogCategoryObserver
{
    /**
     * Обработка перед созданием записи
     *
     * @param BlogCategory $blogCategory
     * @return void
     */
    public function creating(BlogCategory $blogCategory)
    {
        $this->setSlug($blogCategory);
    }

    /**
     * Обработка перед обновлением записи
     *
     * @param BlogCategory $blogCategory
     * @return void
     */
    public function updating(BlogCategory $blogCategory)
    {   
        /*
         * $test[]
            $test[] = $blogCategory->isDirty();
            $test[] = $blogCategory->isDirty('...');
            $test[] = $blogCategory->isDirty('...');
            $test[] = $blogCategory->getAttribute('...');
            $test[] = $blogCategory->is_published;
            $test[] = $blogCategory->getOriginal('...');
            $test[] = $blogCategory->getDirty();
            dd($test);
         */

        $this->setSlug($blogCategory);
    }

    /**
     * Если слаг не установлен, то добавляем его спомощью конвертации заголовка
     *
     * @param BlogCategory $blogCategory
     * @return void
     */
    protected function setSlug(BlogCategory $blogCategory)
    {
        $isNeedSlugInsert = empty($blogCategory->slug);

        // dd($isNeedSlugInsert);

        if (empty($blogCategory->slug)) {
            $blogCategory->slug = Str::slug($blogCategory->title);
        }
    }

    /**
     * Handle the blog category "created" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function created(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "updated" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function updated(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "deleted" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function deleted(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "restored" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function restored(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "force deleted" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function forceDeleted(BlogCategory $blogCategory)
    {
        //
    }
}
