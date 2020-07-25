<?php

namespace App\Http\Controllers\Blog\Admin;

use Illuminate\Support\Str;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Repositories\BlogCategoryRepository;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Http\Controllers\Blog\Admin\BaseController as BaseController;

/**
 * Управление категориями блога
 * 
 * @package App\Http\Controllers\Blog\Admin
 */
class CategoryController extends BaseController
{
    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    public function __construct() 
    {
        parent::__construct();

        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* OLD
            $paginator = BlogCategory::paginate(15);
        */
        
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(5);
        
        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //public function edit($id, BlogCategoryRepository $categoryRepository)  -->old

    public function edit($id)
    {
        /* OLD
            $item[] = BlogCategory::find($id); //вернет null если нет категории
            $item[] = BlogCategory::findOrFail($id); //вернет 404 если нет категории
            $item[] = BlogCategory::where('id','...', $id)->first(); //('...','=' или '>' или '<', $...), по умолчанию '='
            dd(colect($item)->pluck('id'));

            $item = BlogCategory::findOrFail($id);
            $categoryList = BlogCategory::all();
            dd(__METHOD__, $categoryList);

        
            $item = $categoryRepository->getEdit($id);
            $categoryList = $categoryRepository->getForCombobox();
         */
        
        $item = $this->blogCategoryRepository->getEdit($id);
        if (empty($item)) {
            abort(404);
        }

        $categoryList = $this->blogCategoryRepository->getForCombobox();

        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /* OLD
           public function update(Request $request, $id)
            {
                dd(__METHOD__, $request->all(), $id);
            }
      */
    

    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        /* OLD
            //dd($request, $id);
        
            // $rules = [
            //     'title'         => 'required|min:5|max:200',
            //     'slug'          => 'max:200',
            //     'description'   => 'string|min:3|max:500',
            //     'parent_id'     => 'required|integer|exists:blog_categories,id',
            // ];
        
            // first_method
            // $validateData = $this->validate($request, $rules);
        
            // second_method
            // $validateData = $request->validate($rules);
        
            // third_method
            // $validator = \Validator::make($request->all(),$rules);
            // $validateData[] = $validator->passes();
            // $validateData[] = $validator->validate();
            // $validateData[] = $validator->valid();
            // $validateData[] = $validator->failed();
            // $validateData[] = $validator->errors();
            // $validateData[] = $validator->fails();

            // dd($validateData);

             //$item = BlogCategory::find($id);
        */
    
        $item = $this->blogCategoryRepository->getEdit($id);
        
        if (empty($item)) {
            return back()
                ->withErrors(['msg'=>"Запись id=[{$id}] не найдена"])
                ->withInput();
        }

        /* OLD
            // $data = $request->all();
        */
        
        $data = $request->validated();
                
        $result = $item->fill($data)->save();

        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => "Успешно сохранено"]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения"])
                ->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new BlogCategory();

        //$categoryList = BlogCategory::all();
        $categoryList = $this->blogCategoryRepository->getForCombobox();

        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        //Создаст объект но не добавит в базу данных

        /* OLD
                //$item = new BlogCategory($data);
                // $item->save();
                // dd($item);
        */

        $item = (new BlogCategory())->create($data);
        
        if ($item) {
            return redirect()->route('blog.admin.categories.edit', [$item->id])
                    ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
