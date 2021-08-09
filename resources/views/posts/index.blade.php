@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-4">
    <div>
        @if(isset($category))
            <h2 class="fs-6">Category &raquo; {{ $category->name }}</h2>
        @elseif(isset($result))
            <h2 class="fs-6">Search result for '{{ request('query') }}'</h2>
        @else
            <h2 class="fs-6">All Posts</h2>
        @endif
        <hr>
    </div>

    @if (Auth::check())
        <div>
            <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm">
                Create post
            </a>
        </div>
    @else
    <div>
        <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
           Login for create post
        </a>
    </div>
    @endif
</div>

<div class="row">
    @forelse ($posts as $post)
        <div class="col-md-3 mb-4">
            <div class="card shadow">
                <img src="{{ $post->takeImg }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <p class="card-title font-weight-bold">{{ $post->title }}</p>
                    <p class="card-text">{{ Str::limit($post->body, 100, '.') }}</p>
                    <a href="{{ route('posts.show',$post->slug) }}">Read more...</a>
                </div>
                <div class="card-footer">
                    {{ $post->created_at->diffForHumans() }}
                </div>
            </div>
        </div>

        @empty
        <div class="col-md-4 alert alert-primary">
            There's no posts
        </div>
    @endforelse
</div>

<div class="my-4 d-flex justify-content-center">
    {{ $posts->links() }}
</div>
@endsection