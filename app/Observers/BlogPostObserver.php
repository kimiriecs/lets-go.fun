<?php

namespace App\Observers;

use App\Models\BlogPost;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class BlogPostObserver
{
    /**
     * Обработка перед созданием записи
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function creating(BlogPost $blogPost)
    {
        $this->setPublishedAt($blogPost);

        $this->setSlug($blogPost);

        $this->setHtml($blogPost);

        $this->setUser($blogPost);
    }

    /**
     * Обработка перед обновлением записи
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function updating(BlogPost $blogPost)
    {   
        /*
         * $test[]
            $test[] = $blogPost->isDirty();
            $test[] = $blogPost->isDirty('published_at');
            $test[] = $blogPost->isDirty('user_id');
            $test[] = $blogPost->getAttribute('published_at');
            $test[] = $blogPost->is_published;
            $test[] = $blogPost->getOriginal('is_published');
            $test[] = $blogPost->getDirty();
            dd($test);
         */

        $this->setPublishedAt($blogPost);

        $this->setSlug($blogPost);
    }

    /**
     * Если дата публикации не установлена и устанавливаается флаг "Опубликовано",
     * то устанавливаем дату публикациии на текущую
     *
     * @param BlogPost $blogPost
     * @return void
     */
    protected function setPublishedAt(BlogPost $blogPost)
    {
        $isNeedPublishedAtInsert = empty($blogPost->published_at) && $blogPost->is_published;

        if ($isNeedPublishedAtInsert) {
            $blogPost->published_at = Carbon::now();
        }
    }

    /**
     * Если слаг не установлен, то добавляем его спомощью конвертации заголовка статьи
     *
     * @param BlogPost $blogPost
     * @return void
     */
    protected function setSlug(BlogPost $blogPost)
    {
        $isNeedSlugInsert = empty($blogPost->slug);

        // dd($isNeedSlugInsert);

        if (empty($blogPost->slug)) {
            $blogPost->slug = Str::slug($blogPost->title);
        }
    }

    /**
     * Установка значения поля content_html относительно поля content_raw
     *
     * @param BlogPost $blogPost
     * @return void
     */
    protected function setHtml(BlogPost $blogPost)
    {
        if ($blogPost->isDirty('content_raw')) {
            //TODO здесь должна быть генерация markdown->html
            $blogPost->content_html = $blogPost->content_raw;
        }
    }

    /**
     * Если не указан user_id, то устанавливается пользователь по умолчанию
     *
     * @param BlogPost $blogPost
     * @return void
     */
    protected function setUser(BlogPost $blogPost)
    {
        $blogPost->user_id = auth()->id ?? BlogPost::UNKNOWN_USER;
    }

    /**
     * Handle the blog post "created" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function created(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "updated" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function updated(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "restored" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "force deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }
}
