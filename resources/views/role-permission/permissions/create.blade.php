@extends('layouts.backend')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Create Permission</h4>
                        <a href="{{url('permissions')}}" class="btn btn-danger btn-sm">Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{url('permissions')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                              </div>
                              <div class="mb-3">
                                    <button  type="submit" class="btn btn-primary ">Save</button>
                              </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
