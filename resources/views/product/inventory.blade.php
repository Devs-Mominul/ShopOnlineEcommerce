@extends('layouts.admin')
@section('dashboard')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">Add Inventory</div>
        <div class="card-body">
            <form action="{{ route('inventory.store',$product->id) }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="product_name">Product Name</label>
                    <input type="text" disabled name="product_id" id="Product_id" value="{{ $product->product_name }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="color">Color</label>
                    <select name="color_id" id="color_id" class="form-control">
                        <option value="">select color</option>
                        @foreach ($color as $color)
                        <option value="{{ $color->id }}">{{ $color->color_name }}</option>

                        @endforeach
                    </select>

                </div>
                <div class="mb-3">
                    <label for="size">Size</label>
                    <select name="size_id" id="size_id" class="form-control">
                        <option value="">select color</option>
                        @foreach (App\Models\Size::where('category_id',$product->id)->get() as $size)
                        <option value="{{ $size->id }}">{{ $size->size_name }}</option>

                        @endforeach
                    </select>

                </div>
                <div class="mb-3">
                    <label for="product_name">Quantity</label>
                    <input type="text" name="quantity" id="quantity" class="form-control">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">Inventory List</div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
                @foreach ($inventory as $inventory)
                <tr>
                    <td>{{ $inventory->rel_to_color->color_name}}</td>
                    <td>{{ $inventory->rel_to_size->size_name}}</td>
                    <td>{{ $inventory->quantity }}</td>
                    <td>
                        <div class="d-flex">
                          
                            <a href="" class="shadow btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></a>
                        </div>
                    </td>
                </tr>

                @endforeach

            </table>
        </div>
    </div>
</div>

@endsection
