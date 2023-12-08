@extends('layouts.admin')
@section('dashboard')
<div class="col-lg-8">
    <div class="card">
        <div class="card-header">Subcategory List</div>
        <div class="card-body">
            <div class="row">
               @foreach ($categories as $category)
               <div class="col-lg-6 bg-slate-600">
                <div class="card bg-light">
                    <div class="card-header">{{ $category->category_name }}</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Subcategory</th>
                                <th>Action</th>
                            </tr>
                            @foreach (App\Models\Subcategory::where('category_id',$category->id)->get() as $subcategory)
                            <tr>
                                <td>{{ $subcategory->subcategory_name }}</td>
                                <td><div class="d-flex">
                                    <a href="{{ route('subcategory.edit',$subcategory->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('subcategory.delete',$subcategory->id) }}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                </div></td>
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
        <div class="card-header">Subcategory</div>
        <div class="card-body">
            <form action="{{ route('subcategory.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="category_name">Category:</label>
                    <select name="category_id" id="category" class="form-control">
                      @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->category_name }}</option>

                      @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="subcategory_name">Subcategory</label>
                    <input type="text" name="subcategory_name" id="subcategory_name" class="form-control">
                </div>
                <div class="mb-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
