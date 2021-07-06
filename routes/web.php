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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard'); //auth
//middleware은 웹사이트 url을 호출할 때 해당 http 요청을 확인하여 필터링하거나 요청자가 회원인지 로그인 정보가 있는지 해당 페이지를 접속할 수 있는 권한이 있는지를 확인해서 조건에 맞는 페이지를 리턴해야 하는 상황이 온다,
//그때 사용할 수 있는 것이 미들웨어다.

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts/create', [PostsController::class, 'create'])/*->middleware(['auth'])*/->name('posts.create');
//Route::get('/posts.create', 'PostsController@create');

//route에서 http요청을 처리할 수 있도록 로직을 설정.
//이와 비슷하게 컨트롤러를 연결해 처리할 수도 있다.

Route::post('/posts/store', [PostsController::class, 'store'])->name('posts.store')/*->middleware(['auth'])*/;
//get post 방식 두개 
//get방식은 정보 조회할 때
//post 방식은 자원에 대한 변경방식.
//게시글 등록 삭제 내용 변경 등은 post방식으로 하기. 해킹의 악용가능. 
//model 대응되는 table의 하나의 레코드를 나타내는 클래스를 정의.

Route::get('/posts/index', [PostsController::class, 'index'])->name('posts.index');
Route::get('/posts/show/{id}', [PostsController::class, 'show'])->name('posts.show');
Route::get('/posts/{id}', [PostsController::class, 'edit'])->name('post.edit');
Route::put('/posts/{id}', [PostsController::class, 'update'])->name('post.update');
Route::delete('/posts/{id}', [PostsController::class, 'destroy'])->name('post.delete');
