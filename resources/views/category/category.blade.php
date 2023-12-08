@extends('layouts.admin')
@section('dashboard')
<div class="col-lg-8">
    <div class="card">
        <div class="card-header">Category List</div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>sl</th>
                    <th>Category Name</th>
                    <th>Category Image</th>
                    <th>Action</th>
                </tr>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->category_name }}</td>
                    <td><img width="50px" src="{{ asset('uploads/category/') }}/{{ $category->category_img }}" alt=""></td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('category.edit',$category->id) }}" class="mr-1 shadow btn btn-primary btn-xs sharp"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="shadow btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></a>
                        </div>
                    </td>
                </tr>

                @endforeach

            </table>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="card">
        <div class="card-header">Category</div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data" >
                @csrf
                <div class="mb-3">
                    <label for="category_name">Category Name:</label>
                    <input type="text" name="category_name" id="category" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="category_img">Category Image:</label>
                    <input type="file" name="category_img" id="category_img" class="form-control">
                </div>
                <div class="mb-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
