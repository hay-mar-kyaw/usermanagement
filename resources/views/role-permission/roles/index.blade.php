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
                        <h4>Roles</h4>
                        <a href="{{url('roles/create')}}" class="btn btn-primary btn-sm">Add Role</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>
                                            @can('give permissions')
                                            <a href="{{url('roles/'.$role->id.'/give-permissions')}}" class="btn btn-sm btn-primary">Add/Edit Role Permission</a>
                                            @endcan
                                            @can('update role')
                                            <a href="{{url('roles/'.$role->id.'/edit')}}" class="btn btn-sm btn-success">Edit</a>
                                            @endcan
                                            @can('delete role')
                                            <a href="{{url('roles/'.$role->id.'/delete')}}" class="btn btn-sm btn-danger mx-2">Delete</a>
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
