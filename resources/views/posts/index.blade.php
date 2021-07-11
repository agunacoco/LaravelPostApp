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
        <div class="container mt-5">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('게시글 리스트') }}
                </h2>
            </x-slot>
            {{-- @auth는 현재 접속자가 인증된 사용자인지 아니면 guest인지 판별하는데 사용가능한 편의 기능이다. --}}
            @auth 
                <button onclick=location.href="/posts/create" class="btn btn-primary">게시글 작성</button>
            @endauth
            <br/>
            <ul class="list-group">

                {{-- PostController에서 posts 내용을 담아온 변수 $post을 foreach 반복문에 사용. --}}
                @foreach ( $posts as $post )
                    <li class="list-group-item">
                        <span>
                            {{-- route('posts.show')의 posts.shows는 web.php에서 설정한 각 라우터의 name이다. --}}
                            <a href="{{ route('posts.show', ['id'=>$post->id, 'page'=>$posts->currentPage()]) }}"> {{-- 각 post마다 link를 달아준다. 상세내용을 보여준다. 아이디와 페이지의 값을 show에 전달해준다. --}}
                                Title : {{  $post->title }} <br/>
                            </a>
                        </span>
                
                        <span>
                            {{-- 만든 시간 데베에서 받아옴.  diffForHumans()는 n일전 이런식으로 뜨는 것. --}}
                            written on {{ $post -> created_at->diffForHumans() }} <br/> 

                            {{-- count가 0 이상이면 Str::plural('view', $post->count)를 아니면 'view'로 나타내기.
                            Str::plural('view', $post->count)는 count가 1이면 view로 표시하고 1 이상이면 views로 알아서 자동 변환해준다. --}}
                            {{ $post->count }} {{ $post->count > 0 ? Str::plural('view', $post->count) : 'view' }}
                        </span>
                    </li><br/>
                @endforeach
            </ul>
            <div class="mt-4">
                {{ $posts -> links()}}  
            </div>
        </div>
    </body>
</html>
</x-app-layout>