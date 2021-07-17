@extends('layouts.app')

@section('content')
<div class="row d-flex">
    <div class="col-md-8">
        <h3 class="text-secondary fw-light">Create Post</h3>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <form action="{{ route('posts.edit',$post->slug) }}" method="post" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="mb-3">
                <label for="image" class="form-label">Choose an image</label>
                <input class="form-control" type="file" id="image" name="image">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                @error('title')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="body" class="form-label">Body</label>
                <textarea name="body" id="body" rows="5" class="form-control">{{ $post->body }}</textarea>
                @error('body')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tags" class="mb-2">Tags</label>
                <select name="tags[]" id="tags" class="form-control" multiple>
                    @foreach ($tags as $tag)
                    
                    <option {{ $post->tags()->find($tag->id) ? 'selected' : null }} value="{{ $tag->id }}">{{ $tag->name }}</option>>
                    @endforeach
                </select>
                @error('tags')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category" class="mb-2">category</label>
                <select name="category" id="category" class="form-control">
                    <option disabled selected>Choose a category</option>
                    @foreach ($categories as $category)
                        <option {{ $category->id == $post->category_id ? 'selected' : null }} value="{{ $category->id }}">{{ $category->name }}</option>>
                    @endforeach
                </select>
                @error('category')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
    </div>
</div>
@endsection