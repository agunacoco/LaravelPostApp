<?php

use App\Http\Controllers\PostsController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts/create', [PostsController::class, 'create']);
//Route::get('/posts.create', 'PostsController@create');

Route::post('/posts/store', [PostsController::class, 'store']);
//get post 방식 두개 
//get방식은 정보 조회할 때
//post 방식은 자원에 대한 변경방식.
//게시글 등록 삭제 내용 변경 등은 post방식으로 하기. 해킹의 악용가능. 
//model 대응되는 table의 하나의 레코드를 나타내는 클래스를 정의.

Route::get('/posts/index', [PostsController::class, 'index']);
