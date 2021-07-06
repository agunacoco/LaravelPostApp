<x-app-layout>
<!DOCTYPE html>
<html>
<body>
    <div class="container">
    <meta charset="utf-8">
    <title>create</title>

    {{-- <form>폼 데이터를 서버로 보낼 때 해당 데이터가 도착할 url을 명시 .
        action 속성은 <form> 태그에 입력된 내용을 처리하는 서버 프로그램의 url 지정.
        method 속성 - get, post 
        사용자가 입력한 내용은 어떤 방식(get, post)으로 넘길 것인지를 지정하는 역할을 하며 속성값으로 get과 post가 있다.
        get은 주소 표시줄에 입력한 내용이 나타나며 보안상 문제가 많다.
        post는 입력된 내용의 크기에 제한 받지 않고 입력헌 내용이 노출되지 않는다. --}}
    <form action="/posts/store" method="post" enctype="multipart/form-data">
        @csrf 
        {{-- 사이트 간 요청 위조를 막기 위한 보안 토큰을 삽입한 것. get 외의 접근에서는 꼭 이 토큰을 함께 전송해야만 접근이 가능. --}}
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('글쓰기') }}
            </h2>
        </x-slot>
        <div class="form-group">
            <input type = 'text' name = 'title' placeholder = 'title' value="{{ old('title') }}"><br/> 
            {{-- old('title')는 이전의 값을 그대로 가져오는 것이다. --}}
            @error('title')
            <div>{{ $message }} </div>   
            @enderror
            {{-- 에러 메세지를 한국어로 바꾸려면 lang 폴더에 ko라는 국가언어코드로 폴더를 만든다.
                    폴더에 validation.php에서 required에 메세지를 변경해준다.
                    app.php의 locale에 국가언어코드를 바꾸면 설정 완료!  --}}
        </div>
        <div class="form-group">
            <textarea name = 'content' placeholder = 'content' >{{ old('content') }}</textarea><br/>
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
        </div>


        <input type = 'submit' class="btn btn-primary" value="등록">
    </form>
    </div>
</body>
</html>
</x-app-layout>