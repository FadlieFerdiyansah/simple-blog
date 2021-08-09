@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md">
            <div class="d-flex justify-content-end mb-2">
                <a href="{{ route('tags.create') }}" class="btn btn-primary btn-sma">Create Tag</a>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        <tr>
                            <td>{{ $tags->count() * ($tags->currentPage() - 1) + $loop->iteration  }}</td>
                            <td>{{ $tag->name }}</td>
                            <td>
                                <a href="{{ route('tags.edit',$tag) }}" class="btn btn-info mr-2" style="float:left;"> Edit </a>

                                <form action="{{ route('tags.delete',$tag->slug) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger"> Delete </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div>
                {{ $tags->links() }}
            </div>
        </div>
        
    </div>
@endsection