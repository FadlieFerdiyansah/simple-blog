@extends('layouts.app')

@section('content')
<div class="row d-flex">
    <div class="col-md-8">
        <h3 class="text-secondary fw-light">Update Tag &raquo; {{ $tag->name }}</h3>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <form action="{{ route('tags.edit',$tag) }}" method="post">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $tag->name }}">
                @error('name')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            </form>
    </div>
</div>
@endsection