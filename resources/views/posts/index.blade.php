<!DOCTYPE html>
<html>
    <body>
        <meta charset="utf-8">
        <title>index</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </body>
<body>
    <div class="container mt-5">
        <h1>게시글 리스트</h1>
        <a href="/posts/create" class="btn btn-primary">게시글 작성</a>
        <ul class="list-group mt -3">

            @foreach ( $posts as $post )
            <li class="list-group-item">
                <span>Title : {{  $post->title }} </span>
        
                <div>
                    content: {{ $post->content }}
                </div>
                <span>written on {{ $post -> created_at }} </span>
                <hr>
            </li>  
            @endforeach
        </ul>
        <div class="mt-5">
            {{ $posts -> links()}}
        </div>
    </div>
</body>
</html>