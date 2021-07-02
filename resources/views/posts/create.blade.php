<x-app-layout>
<!DOCTYPE html>
<html>
<body>
    <meta charset="utf-8">
    <title>create</title>
    
    <form action="/posts/store" method="post">
        @csrf
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('글쓰기') }}
            </h2>
        </x-slot>
        <div class="form-group">
            <input type = 'text' name = 'title' placeholder = 'title' value="{{ old('title') }}"><br/>
            @error('title')<div>{{ $message }} </div>@enderror
        </div>
        <div class="form-group">
            <textarea name = 'content' placeholder = 'content' >{{ old('content') }}</textarea><br/>
            @error('content')
            <div>{{ $message }} </div>
            @enderror
        </div>
        <input type = 'submit' class="btn btn-primary" value="등록">
    </form>
</body>
</html>
</x-app-layout>