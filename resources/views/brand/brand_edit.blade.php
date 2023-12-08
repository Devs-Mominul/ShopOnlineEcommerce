@extends('layouts.admin')
@section('dashboard')
<div class="col-lg-8 mx-auto">
    <div class="card">
        <div class="card-header">Edit Brand List</div>
        <div class="card-body">
            <form action="{{ route('brand_edit_store',$brands->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="brand_name">Brand Name:</label>
                    <input type="text" name="brand_name" id="brand_name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="brand_logo">Brand Logo:</label>
                    <input type="file" name="brand_logo" id="brand_logo" class="form-control">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
