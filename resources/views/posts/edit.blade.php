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
            <div class="container" >
                <x-slot name="header">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('글쓰기') }}
                    </h2>
                </x-slot><br/>
                <form action="{{ route('post.update', ['id' => $post->id, 'page' => $page]) }}" method="post" enctype="multipart/form-data">
                    @csrf 
                    @method("put")

                {{-- method spoofing --}}
                {{-- <input type="hidden" name="_method" value="put"> --}}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{  old('title')  ? old('title') : $post->title}}" ><br/> 
                    @error('title')
                    <div>{{ $message }} </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for='content'>Content</label>
                    <textarea class="form-control" id="content" name = 'content' >{{ old('content') ? old('content') : $post->content }}</textarea><br/>
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

                <div class= "form-group">
                    <img class="img-thumbnail" width="30%" src="{{ $post -> imagePath() }}">
                </div><br/>
                <input type = 'submit' class="btn btn-primary" value="등록">
            </form>
        </div>
    </body>
</html>
</x-app-layout>