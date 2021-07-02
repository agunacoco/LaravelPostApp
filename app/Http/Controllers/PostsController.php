<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function create()
    {
        //dd('OK'); //덤프?? 
        return view('posts.create');
    }
    //request객체를 사용한 데이터 조회.
    public function store(Request $request)
    {
        //$request -> input['title']; //input이라는 연관배열. 특정 키에 대한 값을 가져온다. title이라는 것을 가져온다.
        //$repuest -> input['content'];
        $title = $request->title;
        $content = $request->content;

        $request->validate([
            // title에 최소 3자 이상은 되어야한다.
            'title' => 'required|min:3',
            'content' => 'required'
        ]);

        //dd($request);

        //DB에 저장
        $post = new Post;
        $post->title = $title;
        $post->content = $content;
        $post->user_id = Auth::user()->id;  //현재 로그인된 사용자 아이디를 가져온다.
        $post->save();

        // 결과 뷰를 반환
        return redirect('/posts/index');  //index로 요청.

        // $posts = Post::paginate(5);
        // return view('posts.index', ['posts'=>$posts]);
    }
    public function index()
    {
        // $posts = Post ::orderBy('created_at', 'desc') -> get();
        // $posts = Post::latest()->get();
        // $posts = Post::orderByDesc('created_at') -> get();

        $posts = Post::latest()->paginate(5); //한페이지에 2개씩 보여준다.
        // dd($posts[0]->created_at);
        // dd($posts);
        return view('posts.index', ['posts' => $posts]);
    }
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    public function show(Request $request, $id)
    {
        //dd($request->page);
        $page = $request->page;
        $post = Post::find($id);
        return view('posts.show', compact('post', 'page'));
    }
    public function edit()
    {
    }
    public function update()
    {
    }
    public function destroy()
    {
    }
}
