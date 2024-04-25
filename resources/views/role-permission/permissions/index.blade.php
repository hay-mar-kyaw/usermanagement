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
                        <h4>Permissions</h4>
                        <a href="{{url('permissions/create')}}" class="btn btn-primary btn-sm">Add Permission</a>
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
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{$permission->id}}</td>
                                        <td>{{$permission->name}}</td>
                                        <td>
                                            @can('update permission')
                                            <a href="{{url('permissions/'.$permission->id.'/edit')}}" class="btn btn-sm btn-success">Edit</a>
                                            @endcan
                                            @can('update permission')
                                            <a href="{{url('permissions/'.$permission->id.'/delete')}}" class="btn btn-sm btn-danger mx-2">Delete</a>
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
