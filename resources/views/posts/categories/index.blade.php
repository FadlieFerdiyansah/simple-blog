@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md">
            <div class="d-flex justify-content-end mb-2">
                <a href="{{ route('categories.create') }}" class="btn btn-primary">Create Category</a>
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
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $categories->count() * ($categories->currentPage() - 1) + $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href="{{ route('categories.edit',$category) }}" class="btn btn-info mr-2" style="float:left;"> Edit </a>

                                <form action="{{ route('categories.delete',$category) }}" method="post">
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
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection