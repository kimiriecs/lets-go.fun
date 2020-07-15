<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Http\Controllers\Blog\Admin\BaseController as BaseController;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = BlogCategory::paginate(15);
        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $item[] = BlogCategory::find($id); //вернет null если нет категории
        // $item[] = BlogCategory::findOrFail($id); //вернет 404 если нет категории
        // $item[] = BlogCategory::where('id','...', $id)->first(); //('...','=' или '>' или '<', $...), по умолчанию '='
        // dd(colect($item)->pluck('id'));

        $item = BlogCategory::findOrFail($id);
        $categoryList = BlogCategory::all();
        //dd(__METHOD__, $categoryList);
        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    { 
        //dd($request, $id);
        /*
            $rules = [
                'title'         => 'required|min:5|max:200',
                'slug'          => 'max:200',
                'description'   => 'string|min:3|max:500',
                'parent_id'     => 'required|integer|exists:blog_categories,id',
            ];
        */

        /*
            first_method
            $validateData = $this->validate($request, $rules);
        */

        /*
            second_method
            $validateData = $request->validate($rules);
        */
        
        /*
            third_method
            $validator = \Validator::make($request->all(),$rules);
            $validateData[] = $validator->passes();
            $validateData[] = $validator->validate();
            $validateData[] = $validator->valid();
            $validateData[] = $validator->failed();
            $validateData[] = $validator->errors();
            $validateData[] = $validator->fails();
        */
       
        // dd($validateData);


        $item = BlogCategory::find($id);
        
        if (empty($item)) {
            return back()
                ->withErrors(['msg'=>"Запись id=[{$id}] не найдена"])
                ->withInput();
        }
        $data = $request->all();
        
        /*
            dd([
                $data,
                $request->all(), 
                $request->input(), 
            ]);
        */
        
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
