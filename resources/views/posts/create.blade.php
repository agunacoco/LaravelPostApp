<html>
<body>
    <form action="/posts/store" method="post">
        @csrf
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