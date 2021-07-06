<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function create()
    {
        // dd('OK'); //덤프?? 
        return view('posts.create');
    }
    // request객체를 이용하여 사용자가 입력한 값이나 요청을 얻거나 확인할 수 있다. 
    // 사용한 데이터 조회.
    //create에서 폼에서 request로 전달되서 값을 가져온다.
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

        // dd($request);

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
            $post->image = $this->uploadPostImage($request);
        }

        //$fileName = $name;
        $post->save();

        // 결과 뷰를 반환
        //redirect : 다시 전송하기.
        return redirect('/posts/index');  //index로 요청.

        // $posts = Post::paginate(5);
        // return view('posts.index', ['posts'=>$posts]);
    }

    protected function uploadPostImage($request)
    {
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
        return $fileName;
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

    //construct 구성한다
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    public function show(Request $request, $id)
    {
        //dd($request->page);
        //dd($request->id);
        $page = $request->page;
        $post = Post::find($id);
        return view('posts.show', compact('post', 'page'));
    }
    public function edit($id)
    {

        $post = Post::find($id);
        //dd($post);
        //$post = Post::where('id', $id)->get();
        // 수정 폼 생성.
        return view('posts.edit')->with('post', $post);
    }
    public function update(Request $request, $id)
    {
        //vaildate
        $request->validate([
            // title에 최소 3자 이상은 안되면 에러 발생. 
            // 에러 발생 -> 리다이렉션 발생 create()로.
            'title' => 'required|min:3',
            'content' => 'required|min:3',
            'imageFile' => 'image|max:2000'
        ]);

        $post = Post::find($id);
        // 이미지 파일 수정. 파일 시스템에서
        if ($request->file('imageFile')) {
            $imagePath = 'public/images/' . $post->image;
            Storage::delete('imagePath');
            $post->image = $this->uploadPostImage($request);
        }

        // 게시글을 데이터베이스에서 수정.
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        return redirect()->route('posts.show', ['id' => $id]);
    }
    public function destroy($id)
    {
        // 파일 시스템에서 이지미 파일 삭제. 
        // 게시글을 데이터베이스에서 삭제.
    }
}
