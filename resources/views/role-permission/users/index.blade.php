@extends('layouts.backend')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                @if(Session('status'))
                    <div class="alert alert-success">{{Session('status')}}</div>
                @endif
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Users</h4>
                        @can('create user')
                        <a href="{{url('users/create')}}" class="btn btn-primary btn-sm">Add User</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>UserName</th>
                                    <th>Role</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Gender</th>
                                    <th>Is_Active</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index=>$user)
                                    <tr>
                                        <td>{{$index + 1}}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>
                                            @if(!empty($user->getRoleNames()))
                                                @foreach ($user->getRoleNames() as $rolename)
                                                <span class="badge bg-primary text-white">{{$rolename}}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>{{ (($user->gender) == 0)? 'Male':'Female'}}</td>
                                        <td>{{ (($user->is_active) == 0)? 'Active':'Inactive'}}</td>
                                        <td class="d-flex">
                                            @can('update user')
                                            <a href="{{url('users/'.$user->id.'/edit')}}" class="btn btn-sm btn-success">Edit</a>
                                            @endcan
                                            @can('delete user')
                                            <a href="{{url('users/'.$user->id.'/delete')}}" class="btn btn-sm btn-danger mx-2">Delete</a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
