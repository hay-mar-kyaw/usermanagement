@extends('layouts.backend')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Edit Role</h4>
                        <a href="{{url('roles')}}" class="btn btn-danger btn-sm">Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{url('roles/'.$role->id)}}" method="POST">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" value="{{$role->name}}" id="name" name="name">
                              </div>
                              <div class="mb-3">
                                    <button  type="submit" class="btn btn-primary ">Update</button>
                              </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
