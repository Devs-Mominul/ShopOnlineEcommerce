@extends('layouts.admin')
@section('dashboard')
<div class="col-lg-8">
    <div class="card">
        <div class="card-header">Brands List</div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Sl</th>
                    <th>Brand</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                @foreach ($brands as $brand)
                <tr>
                    <td>{{ $brand->id }}</td>
                    <td>{{ $brand->brand_name }}</td>
                    <td><img width="60px" src="{{ asset('uploads/brand/') }}/{{ $brand->brand_logo }}" alt=""></td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('brand.edit',$brand->id) }}" class="mr-1 shadow btn btn-primary btn-xs sharp"><i class="fa fa-pencil"></i></a>
                            <a href="{{ route('brand.delete',$brand->id) }}" class="shadow btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></a>
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
        <div class="card-header">Brand List</div>
        <div class="card-body">
            <form action="{{ route('brand.store') }}" method="post" enctype="multipart/form-data">
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
