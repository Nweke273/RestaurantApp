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

            <form action="/management/menu" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="menuName"></label>
                    <input type="text" name="name" class="form-control" placeholder="Menu...">
                </div>
                <label for="menuPrice">Price</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="text" name="price" class="form-control" aria-label="Amount(to the nearest dollor)">
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
                <label for="MenuImage">Image</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="inputGroupFile01">
                        <label class="custom-file-label" for="inputGroupFile01">Choose File</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Description">Description</label>
                    <input type="text" class="form-control" placeholder="Description..." name="description">
                </div>
                <div class="form-group">
                    <label for="Category">Category</label>
                    <select name="category_id" class="form-control" id="">
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                   
                </div>
                <button class="btn btn-primary" type="submit">Save Category</button>
            </form>
        </div>

    </div>
</div>
@endsection