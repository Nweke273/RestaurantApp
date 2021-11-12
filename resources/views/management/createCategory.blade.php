@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        @include('management.inc.sidebar')
        <div class="col-md-8">
            Category
            <hr>

            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>

            </div>

            @endif

            <form action="/management/category" method="POST">
                @csrf
                <div class="form-group">
                    <label for="categoryName"></label>
                    <input type="text" name="name" class="form-control" placeholder="Category...">
                </div>
                <button class="btn btn-primary" type="submit">Save Category</button>
            </form>
        </div>

    </div>
</div>
@endsection