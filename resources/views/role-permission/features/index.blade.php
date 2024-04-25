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
                        <h4>Features</h4>
                        @can('create feature')
                        <a href="{{url('features/create')}}" class="btn btn-primary btn-sm">Add Feature</a>
                        @endcan
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
                                @foreach ($features as $feature)
                                    <tr>
                                        <td>{{$feature->id}}</td>
                                        <td>{{$feature->name}}</td>
                                        <td>
                                            @can('update feature')
                                            <a href="{{url('features/'.$feature->id.'/edit')}}" class="btn btn-sm btn-success">Edit</a>
                                            @endcan
                                            @can('delete feature')
                                            <a href="{{url('features/'.$feature->id.'/delete')}}" class="btn btn-sm btn-danger mx-2">Delete</a>
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
