<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        dd($request);

        //DB에 저장

        // 결과 뷰를 반환
        return view();
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
    public function show()
    {
    }
    public function index()
    {
    }
}
