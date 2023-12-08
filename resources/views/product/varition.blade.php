@extends('layouts.admin')
@section('dashboard')
<div class="col-lg-8">
    <div class="card">
        <div class="card-header">Color List</div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Color Name</th>
                    <th>Color Code</th>
                    <th>Action</th>
                </tr>
                @foreach ($colors as $color)
                <tr>
                    <td>{{ $color->color_name }}</td>
                    <td>
                        <i style=" text-align:center; color:transparent; width: 50px;height:50px;background-color:{{ $color->color_code }};">
                            @if($color->color_code==null)
                            <span class="text-danger">{{ $color->color_name }}</span>
                            @else
                            {{ $color->color_code }}
                            @endif
                        </i>
                    </td>
                    <td><a href="" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a></td>
                </tr>

                @endforeach

            </table>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="card">
        <div class="card-header">Add Varition</div>
        <div class="card-body">
            <form action="{{ route('varition.post') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="color_name">Color Name:</label>
                    <input type="text" name="color_name" id="color_name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="color_code">Color Code:</label>
                    <input type="text" name="color_code" id="color_code" class="form-control">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>

</div>
<div class="col-lg-8">
    <div class="card">
        <div class="card-header">
            <h3>Size List</h3>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($categories as $category)
                <div class="col-lg-6">
                    <div class="card bg-light">
                        <div class="card-header">{{ $category->category_name }}</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>

                                    <th>Size</th>
                                    <th>Action</th>
                                </tr>
                                @foreach (App\Models\Size::where('category_id',$category->id)->get() as $size)
                                <tr>
                                    <td>{{ $size->size_name }}</td>
                                    <td> <a href="" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a></td>
                                </tr>

                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </div>

</div>
<div class="col-lg-4">
    <div class="card">
        <div class="card-header">Add Size</div>
        <div class="card-body">
            <form action="{{ route('size.post') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="size_name">Category Name:</label>
                    <select name="category_id" id="" class="form-control">
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>

                        @endforeach
                    </select>

                </div>

                <div class="mb-3">
                    <label for="size_name">Size Name:</label>
                    <input type="text" name="size_name" id="size_name" class="form-control">
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
