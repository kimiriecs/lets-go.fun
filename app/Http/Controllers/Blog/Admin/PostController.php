<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Models\BlogPost;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Jobs\BlogPostAfterCreateJob;
use App\Jobs\BlogPostAfterDeleteJob;
use App\Repositories\BlogPostRepository;
use App\Http\Requests\BlogPostCreateRequest;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Repositories\BlogCategoryRepository;
use App\Http\Controllers\Blog\Admin\BaseController;


/**
 * Управлене статьями блога
 * 
 * @package App\Http\Controllers\Blog\Admin
 */
class PostController extends BaseController
{
    /**
     * @var BlogPostRepository
     */
    private $blogPostRepository;

    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    /**
     * PostController Constructor
     */
    public function __construct() {

        parent::__construct();

        $this->blogPostRepository = app(BlogPostRepository::class);
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->blogPostRepository->getAllWithPaginate(5);

        // dd(__METHOD__, $paginator);

        return view('blog.admin.posts.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(__METHOD__);

        $item = new BlogPost();

        $categoryList = $this->blogCategoryRepository->getForCombobox();

        return view('blog.admin.posts.edit', compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\BlogPostCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogPostCreateRequest $request)
    {
        // dd(__METHOD__, $id);

        $data = $request->input();

        // -----------OLD---------------

        // $item = (new BlogPost())->create($data);

        // if ($item) {

        //     $job = new BlogPostAfterCreateJob($item);

        //     $this -> dispatch($job);

        //     return redirect()->route('blog.admin.posts.edit', [$item->id])
        //             ->with(['success' => 'Успешно сохранено']);
        // } else {
        //     return back()->withErrors(['msg' => 'Ошибка сохранения'])
        //             ->withInput();
        // }
        

        // -----------NEW---------------
        $item = BlogPost::create($data);

        if ($item) {

            $job = new BlogPostAfterCreateJob($item);

            $this -> dispatch($job);

            return redirect()->route('blog.admin.posts.edit', [$item->id])
                        ->with(['success'=>'Успешно сохранено']);

        } else {
            
            return back()->withErrors(['msg'=>'Ошибка сохранения'])
                    ->withInput();

        }
        
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd(__METHOD__, $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->blogPostRepository->getEdit($id);
        if (empty($item)) {
            abort(404);
        }

        $categoryList = $this->blogCategoryRepository->getForCombobox();

        return view('blog.admin.posts.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\BlogPostUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogPostUpdateRequest $request, $id)

    // public function update(Request $request, $id)
    {
        // dd(__METHOD__, $id, $request->all());

        /*
        * Ушло в BlogPostObserver
            if (empty($data['slug'])) {
                $data['slug'] = Str::slug($data['title']);
            }
            if (empty($item->published_at) && $data['is_published']) {
                $data['published_at'] = Carbon::now();
            } 
        */

        $item = $this->blogPostRepository->getEdit($id);
        if (empty($item)) {
           return back()
                ->withErrors(['msg'=>"Запись id[{$id}] не найдена"])
                ->withInput();
        }

        $data = $request->all();

        $result = $item->update($data);
        if ($result) {
            return redirect()
                    ->route('blog.admin.posts.edit', $item->id)
                    ->with(['success'=>'Успешно сохранено']);
        }else {
            return back()
                    ->withErrors(['msg'=>'Ошибка сохранения'])
                    ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd(__METHOD__, $id, request()->all());

        //SoftDeletes - post остается в базе данных
        $result = BlogPost::destroy($id);

        //ForceDelete - post полностью удаляется из базы данных
        //$result = BlogPost::find($id)->ForceDelete();

        if ($result) {

            BlogPostAfterDeleteJob::dispatc($id)->delay(20);

            //Другие варианты запуска Job

            //BlogPostAfterDeleteteJob::dispatchNow($id);  // выполнится немедленно 
                                                            // независимо от того есть ли 'implements ShouldQueue'

            // dispatch(new BlogPostAfterDeleteteJob($id))->delay(20);  // helper dispatch(new App\Jobs\SomeJob)
            //dispatchNow(new BlogPostAfterDeleteteJob($id));    // helper dispatch(new App\Jobs\SomeJob)

            //$this->dispatch(new BlogPostAfterDeleteteJob($id))
            //$this->dispatch_now(new BlogPostAfterDeleteteJob($id))

            //$job = new BlogPOstAfterDeleteteJob($id);
            //$job->handle();

            //< Другие варианты запуска Job

            return redirect()
                ->route('blog.admin.posts.index')
                ->with(['success' => "Запись id[{$id}] успешно удалена"]);
        } else {
            return back()->withErrors(['msg' => "Ошибка удаления"]);
        }
    }
}
