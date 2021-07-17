@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 mb-4">
            <div>
                <small class="text-secondary info-post d-block mb-3"><a href="{{ route('posts') }}">Post</a> &raquo; <a href="{{ route('categories.show', $post->category->slug) }}">{{ $post->category->name }}</a> &raquo; {{ $post->title }}</small>
                <h1 class="title">{{ $post->title }}</h1>
                <div>
                    @can ('delete', $post)
                        <form action="{{ route('posts.delete', $post->slug) }}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    @endcan
                     
                    @can('update', $post)
                        <a href="{{ route('posts.edit',$post->slug) }}" type="submit" class="btn btn-primary btn-sm">Edit</a>
                    @endcan
                </div>
                <small class="text-secondary info-post d-block penulis">Oleh {{ $post->user->name }}</small>
                <small class="text-secondary info-post">Disunting pada: {{ $post->created_at->format('F d, Y') }}</small>
            </div>
            <img src="{{ $post->takeImg }}" class="img-fluid img-post">

            <p class="mb-5">
                {{ $post->body }}
            </p>

            <p>
                <button class="btn btn-outline-primary btn-comment form-control p-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                  Comment
                </button>
            </p>
            <div class="collapse" id="collapseExample">
                <form action="{{ route('posts.comment',$post->slug) }}" method="post" class="mb-3">
                    @csrf
                    <textarea name="comment" class="form-control" id="comment" rows="4" placeholder="Write something..."></textarea>
                    <button type="submit" class="btn btn-primary mt-2">Send</button>
                </form>
            </div>

            @foreach ($comments as $comment)
                <div class="card mb-2">
                    <div class="card-header">
                        <img src="/storage/images/posts/6ha0izbGRSX5WWyBrhSyC2iGxS7KShRt9tCaYLJb.jpg" alt="" class="img-user float-left">
                        <div class="row">
                            <p class="fw-bold m-0">{{ $comment->user_id === 0 ? 'Unknown' : Str::limit($comment->user->name, 20, '...') }}</p>
                            <small class="fw-light text-info time font-monospace">{{ $comment->created_at->format('F d, Y - H:i a') }}</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{ $comment->comment }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="col-md-4">
            <div>
                <h1 class="fs-5">Related Post</h1>
                <hr>
            </div>

            <div>
                @foreach($related as $r)
                    @if ($post->id !== $r->id)
                        <div class="card shadow mb-3" style="width: 18rem; padding:0">
                            <div class="card-body">
                                <p class="card-title fw-bold">{{ $r->title }}</p>
                                <p class="card-text">{{ Str::limit($r->body, 100, '.') }}</p>
                                <a href="{{ route('posts.show',$r->slug) }}">Read more...</a>
                            </div>
                        </div>

                    @elseif ($r->count < 1 && $post->id !== $r->id)
                        <div class="alert alert-primary">
                            No related posts.
                        </div>
                    @endif
                    
                    
                    
                @endforeach
                
            </div>
        </div>
    </div>
@endsection