@extends('layouts.admin')
@section('dashboard')
<div class="col-lg-6">
    <div class="card">
        <div class="card-header">Edit Category</div>
        <div class="card-body">
            <form action="{{ route('category_edit.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="category_name"> Category Name:</label>
                    <input type="hidden" name="category_id" id="category_id" class="form-control" value="{{ $category_info->id }}" >
                    <input type="text" name="category_name" id="category_name" class="form-control" value="{{ $category_info->category_name }}">
                </div>
                <div class="mb-3">
                    <label for="category_name"> Category IMage:</label>

                    <input type="file" name="category_img" id="category_img" class="form-control">
                </div>
                <div class="mb-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
