<x-app-layout>
<!DOCTYPE html>
<html>
        <head>
            <meta charset="utf-8">
            <title>index</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        </head>
        <body>
            <div class="container" m-5>
                <x-slot name="header">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('목록보기') }}
                    </h2>
                </x-slot>
                <div class="m-5">
                    <a href="{{ route('posts.index', ['page'=>$page]) }}">목록보기</a>
                </div>
                <div class="form-group">
                    <label for='tltle'>Title</label>
                    <input tyoe="text" readonly
                        name="title" class = "form-control" id="title"
                        value="{{  $post->title }}">
                </div>
                <div class="form-group">
                    <label for='content'>Content</label>
                    <textarea class="form-control" name="content" 
                        id="content" readonly>{{  $post->content }}</textarea>
                </div>

                <div class="form-group">
                    <label for="imageFile">Post Image</label>
                    <div>
                        <img class="img-thumbnail" width="20%" src="{{ $post->imagePath() }}" id="imageFile" >{{ $post->content }}
                    </div>

                <div class="form-group">
                    <label>등록일</label>
                    <input type="text" readonly
                    class="form-control"
                    value="{{  $post->created_at->diffForHumans()}}">
                </div>
                <div class="form-group">
                    <label>수정일</label>
                    <input type="text" readonly
                    class="form-control"
                    value="{{  $post->updated_at }}">
                </div>
                <div class="form-group">
                    <label>작성자</label>
                    <input type="text" readonly
                    class="form-control"
                    value="{{  $post->user_id }}">
                </div>
                <div class="flex">
                    <button class="btn btn-warning" onclick=location.href="{{ route('post.edit', ['id' =>$post->id] )}}">수정</button>
                    <button class="btn btn-danger" onclick=location.href="{{ route('post.delete', ['id' => $post->id])}}">삭제</button>
                  
                </div>
            </div>
        </body>
</html>
</x-app-layout>