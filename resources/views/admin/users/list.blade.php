@extends('admin.master')
@section('content')
    <div class="col-md-12 stretch-card ">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">Users List</h4>
                <a class="btn badge badge-danger" id="deleteUser" style="margin-top: 2%">Delete</a>
                <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                        <thead>
                        <tr style="width: 100%">
                            <th style="width: 2%"><input class="form-check form-check-danger" type="checkbox"
                                                         id="deleteAll"></th>
                            <th style="width: 1%">STT</th>
                            <th style="width: 20%">Name</th>
                            <th style="width: 20%">Email</th>
                            <th style="width: 20%">Phone number</th>
                            <th style="width: 8%">Role</th>
                            <th>Image</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key => $user)
                            <tr id="checkbox-{{ $user->id }}">
                                <td><input type="checkbox" class="checkbox" value="{{ $user->id }}"></td>
                                <td class="font-weight-bold">{{ $key }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone ?? 'Chưa cập nhật'}}</td>
                                <td>{{ $user->role }}</td>
                                <td>@if($user->image == null)
                                        <img src="{{ asset('storage/user.jpeg') }}" alt="">
                                    @else
                                        <img src="{{ asset('storage/'.$user->image ) }}) }}"
                                             alt="">
                                    @endif</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
