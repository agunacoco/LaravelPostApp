<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
            // title에 최소 3자 이상은 안되면 에러 발생. 
            // 에러 발생 -> 리다이렉션 발생 create()로.
            'title' => 'required|min:3',
            'content' => 'required|min:3',
            'imageFile' => 'image|max:2000'
        ]);

        //dd($request);

        //DB에 저장
        $post = new Post;
        $post->title = $title;
        $post->content = $content;
        $post->user_id = Auth::user()->id;  //현재 로그인된 사용자 아이디를 가져온다.

        // File 처리
        //내가 원하는 파일시스템 상의 위치에 원하는 이름으로  
        //파일을 저장하고
        //$post->image = $fileName;
        if ($request->file('imageFile')) {
            $name = $request->file('imageFile')->getClientOriginalName();
            // $name = 'spaceship.jpg';
            $extension = $request->file('imageFile')->extension();
            // $extension = 'jpg';

            //spacehship.jpg의 이미지파일 이름이라면
            //spaceship_123kdsjbk.jpg로 파일 이름을 변경.
            $nameWithoutExtension = Str::of($name)->basename('.' . $extension);
            // $nameWithoutExtension = 'spaceship';

            //dd(nameWithoutExtension);
            // dd($name . ' extension: ' . $extension);
            $fileName = $nameWithoutExtension . '_' . time() . '.' . $extension;
            // $fileName = 'spaceship'.'_'.'1234453'.'jpg';
            // dd($fileName);

            $request->file('imageFile')->storeAs('public/images', $fileName);
            //$request->imageFile
            //그 파일 이름을 컬럼에 설정.
            $post->image  = $fileName;
        }
        //$fileName = $name;
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

        $posts = Post::latest()->paginate(5); //한페이지에 5개씩 보여준다.
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
