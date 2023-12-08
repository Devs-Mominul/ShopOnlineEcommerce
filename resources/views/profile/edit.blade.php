@extends('layouts.admin')
@section('dashboard')
<div class="col-lg-6">
    <div class="card">
        <div class="card-header">Profile Update</div>
        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="post">
                @method('patch')
                @csrf
                <div class="mb-3">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="mb-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-lg-6">
    <div class="card">
        <div class="card-header">Profile Update</div>
        <div class="card-body">
            <form action="{{ route('password.update') }}" method="post">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="name">Current Password:</label>
                    <input type="password" name="current_password" id="current_password" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="email">password:</label>
                    <input type="password" name="password" id="password_confirmation" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="email">Confirm Password:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>
                <div class="mb-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-lg-6">
    <div class="card">
        <div class="card-header">Profile Image</div>
        <div class="card-body">
            <form action="{{ route('photo.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="photo">Update Photo</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                </div>
                <div class="mb-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
