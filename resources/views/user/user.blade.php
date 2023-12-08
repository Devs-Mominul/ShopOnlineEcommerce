@extends('layouts.admin')
@section('dashboard')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">User List</div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>sl</th>
                    <th>photo</th>
                    <th>name</th>
                    <th>email</th>
                    <th>action</th>
                </tr>
                @foreach ($user_list as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>@if($user->photo==null)
                        <img src="{{ Avatar::create($user->name)->toBase64() }}" width="60px"   height="60px" style="border-radius: 50%;" />
                        @else
                        <img  width="60px" height="60px" style="border-radius: 50%;" src="{{ asset('uploads/user/') }}/{{ $user->photo }}" alt="">
                        @endif
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><button data-link="{{ route('user.remove',$user->id) }}" class="shadow btn btn-danger btn-xs sharp del_btn"><i class="fa fa-trash"></i></button></td>
                </tr>

                @endforeach

            </table>
        </div>
    </div>
</div>

@endsection
@push('js_script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    $('.del_btn').click(function(){
        var link=$(this).attr('data-link');
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
          }).then((result) => {
            if (result.isConfirmed) {
             window.location.href=link
            }
          });
    })
</script>

@endpush
