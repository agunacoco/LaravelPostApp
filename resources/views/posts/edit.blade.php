<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('글쓰기') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('post.update', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data">
                @csrf 
                @method("put")

                {{-- method spoofing --}}
                {{-- <input type="hidden" name="_method" value="put"> --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-label" id="title" name="title" value="{{  old('title')  ? old('title') : $post->title}}" class="form-control">
                    @error('title')
                    <div>{{ $message }} </div>
                    @enderror
                </div>
        
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" name = 'content' >{{ old('content') ? old('content') : $post->content }}</textarea><br/>
                    @error('content')
                    <div>{{ $message }} </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="file" class="form-control" >File</label>
                    <input type="file" id="file" name="imageFile">
                    @error('imageFile')
                        <div>{{  $message }} </div>
                    @enderror
                </div>

                <div class= "form-group">
                    <img class="img-thumbnail" width="20%" src="{{ $post -> imagePath() }}">
                </div>
                <input type = 'submit' class="btn btn-primary" value="등록">
            </form>
        </div>
    </body>
    </html>
    </x-app-layout>