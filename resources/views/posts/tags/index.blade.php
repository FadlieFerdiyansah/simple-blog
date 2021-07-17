@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
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
                                <div class="btn btn-info">
                                    Edit
                                </div>

                                <div class="btn btn-danger">
                                    Delete
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div>
                {{ $tags->links() }}
            </div>
        </div>
        

        <div class="col-md-4">
            <div class="card shadow p-5">
                <div>
                    <h4>Create Tag</h4>
                    <hr>
                </div>

                <form action="{{ route('tags') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                      <label for="name" class="form-label">Name</label>
                      <input type="text" class="form-control" id="name" name="name">
                      <div class="text-danger">
                        @error('name')
                            {{ $message }}
                        @enderror
                      </div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Add">
                  </form>
            </div>
        </div>
    </div>
@endsection