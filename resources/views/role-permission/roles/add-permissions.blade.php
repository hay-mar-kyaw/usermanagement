@extends('layouts.backend')
@section('content')
    <div class="container mt-5">
        <div class="row">

            <div class="col-md-12">
                @if(Session('status'))
                    <div class="alert alert-success">{{Session('status')}}</div>
                @endif
                <div class="card mt-3">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Role : {{$role->name}}</h4>
                        <a href="{{url('roles')}}" class="btn btn-danger btn-sm">Back</a>
                    </div>
                    <div class="card-body">

                        <form action="{{url('roles/'.$role->id.'/give-permissions')}}" method="POST">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                @error('permission')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                <label for="" class="mb-3">Permissions</label>

                                <div class="row">
                                    @foreach ($permissions as $permission)
                                        <div class="col-md-2">
                                            <label for="name" class="form-label">
                                                <input type="checkbox" value="{{$permission->name}}" name="permission[]" {{in_array($permission->id,$rolePermissions)? 'checked':''}}>
                                                {{$permission->name}}
                                            </label>

                                        </div>
                                    @endforeach
                                </div>
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
