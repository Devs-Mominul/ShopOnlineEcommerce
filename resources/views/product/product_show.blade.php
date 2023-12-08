@extends('layouts.admin')
@section('dashboard')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">Shwo Product</div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <td>Product Name</td>
                    <td>{{ $product->product_name }}</td>

                </tr>
                <tr>
                    <td>Price</td>
                    <td>{{ $product->price }}</td>

                </tr>

                <tr>
                    <td>Short Desp</td>
                    <td>{{!!   $product->short_desp !!}}</td>
                </tr>
                <tr>
                    <td>Long Desp</td>
                    <td>{{!!   $product->long_desp !!}}</td>
                </tr>
                <tr>
                    <td>Addi Info</td>
                    <td>{{!!   $product->addi_info !!}}</td>
                </tr>
                <tr>
                    <td>preview</td>
                    <td><img width="200px" src="{{ asset('uploads/product/preview/') }}/{{ $product->preview }}" alt=""></td>
                </tr>
                <tr>
                    <td>Gallery</td>
                    <td>
                        @foreach ($gallery as $gallery)
                        <img width="100px" src="{{ asset('uploads/product/gallery/') }}/{{ $gallery->gallery }}" alt="">

                        @endforeach
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

@endsection
