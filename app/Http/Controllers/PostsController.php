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
        //가져올 때 name으로 값을 가져온다.
        $title = $request->title;
        $content = $request->content;

        $request->validate([
            // title,content에 최소 3자 이상은 안되면 에러 발생. 
            // 에러 발생 -> 리다이렉션 발생 create()로.
            'title' => 'required|min:3',
            'content' => 'required|min:3',
            'imageFile' => 'image|max:2000'
        ]);

        // dd($request);

        //DB에 저장
        
        //Post는 모델.
        //명확히 정의된 models를 통해 쉽게 DB에 데이터 저장, 복원 작업 가능.
        //데이터베이스 테이블에서 정보를 찾거나 저장할 때 쓰인다.
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
        $post->save(); //DB저장

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
        //imageFile을 public/images에 $fileName으로 저장한다.
        //왜 /app/public/image가 아니냐면 app이 기본 자동값으로 입력할 때 app을 제외하고 입력한다.
        //$request->imageFile
        //그 파일 이름을 컬럼에 설정.
        return $fileName;
    }
    public function index()
    {
        // $posts = Post ::orderBy('created_at', 'desc') -> get();
        // $posts = Post::latest()->get();
        // $posts = Post::orderByDesc('created_at') -> get();

        $posts = Post::orderBy('updated_at', 'desc')->paginate(5); //한페이지에 5개씩 보여준다.
        // dd($posts[0]->created_at);
        //dd($posts);
        return view('posts.index', ['posts' => $posts]); //각 게시물 $posts을 'posts'에 담아서 posts.index에 전달
    }
    public function user_index()
    {
        $posts = auth()->user()->posts()->orderBy('updated_at', 'desc')->paginate(5); // auth()->user() 현재 로그인된 사용자 정보. posts()는 User 모델에 정의된 posts()를 불러온다.
        return view('posts.index', ['posts' => $posts]);
    }

    //construct 구성한다
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);  // index랑 show는 middleware에서 예외한다.
        //웹사이트 url을 호출할 때 로그인한 사용자가 http 요청을 보내면, 로그인 되어있는지 미들웨어에서 확인하여 요청을 거부할껀지 승인할껀지에 대해서 설정이 가능하다.
    }
    public function show(Request $request, $id) //$id는 web.php에 라우트 경로를 지정할 때 id다.
    {
        //dd($request->page);
        //dd($request->id);
        $page = $request->page;
        $post = Post::find($id);
        // $post -> count++;  // 조회수 증가 시킴. 같은 user가 여러번 조회수 올릴 수 있다.  
        // $post->save();        //DB에 반영.
        
        /*
        이 글을 조회한 사용자들 중에, 현재
        로그인한 사용자가 포함되어 있는지를 체크하고
        포함되어 있지 않으면 추가. 
        포함되어 있음면 다음 단계로 넘어감.
        */
        if(Auth::user()!=null && !$post->viewers->contains(Auth::user()) ) {
            $post->viewers()->attach(Auth::user()->id);
        }

        return view('posts.show', compact('post', 'page'));
    }
    public function edit(Request $request, Post $post)
    {
        //$post = Post::find($id);
        //dd($post);
        //$post = Post::where('id', $id)->get();
        // 수정 폼 생성.
        return view('posts.edit', ['post' => $post, 'page' => $request->page]);
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
        //authorization. 즉 수정 권한이 있는지 검사
        //즉, 로그인한 사용자와 게시그르이 작성자가 같은지 체크
        // if (auth()->user()->id != $post->user_id) {
        //     abort(403);
        // }
        if ($request->user()->cannot('update', $post)) {   //PostPolicy에서 update update를 할수 없나?
            abort(403);
        }

        if ($request->file('imageFile')) {
            $imagePath = 'public/images/' . $post->image;
            Storage::delete('imagePath');
            $post->image = $this->uploadPostImage($request);
        }

        // 게시글을 데이터베이스에서 수정.
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        // return redirect()->route('posts.show', ['id' => $id, 'page' => $request->page]);
        return back();
    }
    public function destroy(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        //authorization. 즉 수정 권한이 있는지 검사
        //즉, 로그인한 사용자와 게시글이 작성자가 같은지 체크
        // if (auth()->user()->id != $post->user_id) {
        //     abort(403);
        // }
        if ($request->user()->cannot('delete', $post)) { //PostPolicy의 delete
            abort(403);
        }

        // 파일 시스템에서 이미지 파일 삭제. 
        $page = $request->page;
        if ($post->image) {
            $imagePath = 'public/images/' . $post->image;
            Storage::delete('imagePath');   //storage에 저장된 image를 삭제.
        }

        // 게시글을 데이터베이스에서 삭제.
        $post->delete();    //데베에서 id에 맞는 post를 제거한다.

        return redirect()->route('posts.index', ['page' => $page]);
    }
}
