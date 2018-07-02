<?php

use App\Course;
use App\Category;

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

/*
    Authentication (login, logout, user registration, password reset)
*/
Auth::routes();

Route::get('/', function () { return view('welcome'); });

Route::get('/home', 'HomeController@index')->name('home');

/*
    Admin
*/
Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    Route::get('/', function() {
        return view('admin.dashboard', [
            'courses_count' => Course::count(),
            'categories_count' => Category::count(),
        ]); 
    })->name('dashboard');

    Route::resource('/categories', 'CategoryController');

    Route::resource('/courses', 'CourseController');

    Route::get('/courses/{course_slug}/pages', 'PageController@index');
    Route::get('/courses/{course_slug}/pages/create', 'PageController@create');
    Route::get('/courses/{course_slug}/pages/{page_slug}', 'PageController@show');
    Route::get('/courses/{course_slug}/pages/{page_slug}/edit', 'PageController@edit');

    Route::get('/courses/{course_slug}/files', 'FileController@index');
    Route::get('/courses/{course_slug}/files/create', 'FileController@create');
    Route::get('/courses/{course_slug}/files/{file_id}/edit', 'FileController@edit');
});

/*
    Frontend
*/
Route::namespace('Frontend')->name('frontend.')->group(function() {
    Route::resource('/categories', 'CategoryController')->only(['index', 'show']);

    Route::resource('/courses', 'CourseController')->only(['index', 'show']);
    
    Route::get('/courses/{course_slug}/pages/{page_slug}', 'PageController@show');
});