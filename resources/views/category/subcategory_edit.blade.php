@extends('layouts.admin')
@section('dashboard')
<div class="col-lg-8 mx-auto">
    <div class="card">
        <div class="card-header">Subcategory Edit</div>
        <div class="card-body">
            <form action="{{ route('subcategory_edit.store',$subcategory->id) }}" method="post">
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
