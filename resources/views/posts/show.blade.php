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
                </x-slot><br/>
                
                <div class="form-group">
                    <label for='tltle'>Title</label>
                    <input type="text" readonly
                        name="title" class = "form-control" id="title"
                        value="{{  $post->title }}">
                </div><br/>
                <div class="form-group">
                    <label for='content'>Content</label>
                    <div name="content" id="content" readonly>
                        {!! $post->content !!}
                    </div>
                </div><br/>

                <div class="form-group">
                    <label for="imageFile">Post Image</label>
                    <div>
                        <img class="img-thumbnail" width="35%" src="{{ $post->imagePath() }}" id="imageFile" >
                    </div><br/>
                </div>

                <div class="form-group">
                    <label>등록일</label>
                    <input type="text" readonly
                    class="form-control"
                    value="{{  $post->created_at}}">
                </div><br/>

                <div class="form-group">
                    <label>수정일</label>
                    <input type="text" readonly
                    class="form-control"
                    value="{{  $post->updated_at }}">
                </div><br/>

                <div class="form-group">
                    <label>작성자</label>
                    <input type="text" readonly
                    class="form-control"
                    {{-- value="{{  $post->user()->select('name', 'email')->get() }}"> //user()로 select문을 사용 --}}
                    value="{{  $post->user->name}}">
                </div><br/>

                @auth
                    {{-- @if (auth()->user()->id == $post->user_id) --}}
                    @can('update', $post)
                    <div class="flex">
                        <a class="btn btn-warning" href="{{ route('post.edit', ['post' =>$post->id, 'page' => $page] )}}">수정</a>
                        {{-- location.href는 무조건 get 방식. --}}
                        {{-- <button class="btn btn-danger" onclick=location.href="{{ route('post.delete', ['id' => $post->id])}}">삭제</button> --}}
                        <form action="{{ route('post.delete', ['id' => $post->id, 'page' => $page])}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" >삭제</button>
                        </form>
                        <button class="btn btn-primary" onclick=location.href="{{ route('posts.index', ['page'=>$page]) }}">목록보기</button>
                    </div>
                    @endcan
                @endauth
            </div>
        </body>
</html>
</x-app-layout>