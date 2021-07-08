<x-app-layout>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>index</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
    </head>
    <body>
        <div class="container" >
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('글쓰기') }}
                </h2>
            </x-slot>
            {{-- <form>폼 데이터를 서버로 보낼 때 해당 데이터가 도착할 url을 명시 .
            action 속성은 <form> 태그에 입력된 내용을 처리하는 서버 프로그램의 url 지정.
            method 속성 - get, post 
            사용자가 입력한 내용은 어떤 방식(get, post)으로 넘길 것인지를 지정하는 역할을 하며 속성값으로 get과 post가 있다.
            get은 주소 표시줄에 입력한 내용이 나타나며 보안상 문제가 많다.
            post는 입력된 내용의 크기에 제한 받지 않고 입력헌 내용이 노출되지 않는다. --}}
            <form action="/posts/store" method="post" enctype="multipart/form-data">
                @csrf 
                {{-- 사이트 간 요청 위조를 막기 위한 보안 토큰을 삽입한 것. get 외의 접근에서는 꼭 이 토큰을 함께 전송해야만 접근이 가능. --}}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control" type = 'text' name = 'title' id="title" value="{{ old('title') }}"><br/> 
                    {{-- old('title')는 이전의 값을 그대로 가져오는 것이다. --}}
                    @error('title')
                    <div>{{ $message }} </div>   
                    @enderror
                    {{-- 에러 메세지를 한국어로 바꾸려면 lang 폴더에 ko라는 국가언어코드로 폴더를 만든다.
                            폴더에 validation.php에서 required에 메세지를 변경해준다.
                            app.php의 locale에 국가언어코드를 바꾸면 설정 완료!  --}}
                </div>
                <div class="form-group">
                    <label for='content'>Content</label>
                    <textarea class="form-control" name = 'content' id="content">{{ old('content') }}</textarea><br/>
                    @error('content')
                    <div>{{ $message }} </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="file">File</label>
                    <input type="file" id="file" name="imageFile">
                    @error('imageFile')
                        <div>{{  $message }} </div>
                    @enderror
                </div><br/>
                <div class="form-group" >
                    <input type = 'submit' class="btn btn-primary" value="등록">
                </div>
            <form>
        </div>
        <script>
            ClassicEditor
                    .create( document.querySelector( '#content' ) )
                    .then( editor => {
                            console.log( editor );
                    } )
                    .catch( error => {
                            console.error( error );
                    } );
    </script>
    </body>
</html>
</x-app-layout>