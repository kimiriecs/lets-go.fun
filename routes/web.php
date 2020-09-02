<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


    // Route::resource('rest', 'RestTestController')
    //     ->names('restTest')
    //     ->parameters(['rest' => 'post_id']);
    
    //Route::resource('rest', 'RestTestController')->names('restTest');
    
    Route::get('/', function () {
        return view('welcome');
    });
    
    Auth::routes();
    
    Route::get('/home', 'HomeController@index')->name('home');

    $groupedataCollections = [
        'middleware' => 'auth',
        'prefix' => 'digging_deeper'
    ];
    
    Route::group($groupedataCollections, function() {
        Route::get('collections', 'DigginDeeperController@collections')->name('digging_deeper.collections');
    });

    $groupedataPosts = [
        'middleware' => 'auth',
        'namespace' => 'Blog',
        'prefix' => 'blog'
    ];

    Route::group($groupedataPosts, function() {
        Route::resource('posts', 'PostController')->names('blog.posts');
    });
    
    
    //admin blog dashbord
    
    $groupedataAdmin = [
        'middleware' => 'auth',
        'namespace' => 'Blog\Admin',
        'prefix' => 'admin/blog',
    ];
    Route::group($groupedataAdmin, function () {
        $methods = ['index', 'edit', 'update', 'create', 'store'];
        Route::resource('categories', 'CategoryController')
            ->only($methods)
            ->names('blog.admin.categories');
            // ->parameters([
            //     'categories' => 'category_id'
            // ]);   
    });

    Route::group($groupedataAdmin, function () {
        $methods = ['index', 'show', 'edit', 'update', 'create', 'store', 'destroy'];
        Route::resource('posts', 'PostController')
            ->only($methods)
            ->names('blog.admin.posts');
            // ->parameters([
            //     'posts' => 'post_id'
            // ]);   
    });
    
    