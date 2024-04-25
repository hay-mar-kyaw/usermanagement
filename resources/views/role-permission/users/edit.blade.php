@extends('layouts.backend')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Edit User</h4>
                        <a href="{{url('users')}}" class="btn btn-danger btn-sm">Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{url('users/'.$user->id)}}" method="POST">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{$user->name}}">
                            </div>

                            <div class="mb-3">
                                <label for="username" class="form-label">User Name</label>
                                <input type="text" class="form-control" name="username" value="{{$user->username}}">
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-control" name="roles[]" multiple>
                                    <option value="" selected>Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role}} {{in_array($role,$userRoles)? 'selected':''}}">
                                            {{$role}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="number" class="form-control" name="phone" value="{{$user->phone}}">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control"name="email" value="{{$user->email}}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" class="form-control" id="address" rows="3">{{$user->address}}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>

                            

                            <div class="mb-3">
                                <label for="is_active" class="form-label">Is_Active</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_active" value=0 {{old(('is_active')==0)? 'checked':''}}>
                                    <label class="form-check-label" for="active">Yes</label><br>

                                    <input class="form-check-input" type="radio" name="is_active" value=1 {{old(('is_active')==1)? 'checked':''}}>
                                    <label class="form-check-label" for="inactive">No</label>
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
