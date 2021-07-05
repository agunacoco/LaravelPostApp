<x-app-layout>
<!DOCTYPE html>
<html>
<body>
    <div class="container">
    <meta charset="utf-8">
    <title>create</title>
    
    <form action="/posts/store" method="post" enctype="multipart/form-data">
        @csrf
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('글쓰기') }}
            </h2>
        </x-slot>
        <div class="form-group">
            <input type = 'text' name = 'title' placeholder = 'title' value="{{ old('title') }}"><br/>
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