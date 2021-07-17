@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>
                <div class="card-body">
                    Hello Admin, <b>{{ auth()->user()->name }}</b>
                </div>
            </div>
        </div>
    </div>
@endsection