@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-header">
                    <h3>Add Color
                        <a href="{{ url('admin/color') }}"
                            class="btn btn-primary float-end btn-sm text-white">Back</a>
                    </h3>

                </div>
                <div class="card-body">
                    <form action="{{ url('admin/color') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="name">Name</label>
                                <input type="text" name="name"class="form-control" >
                                @error('name')
                                    <small class=text-danger>{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="code">Code</label>
                                <input type="text" name="code"class="form-control">
                                @error('code')
                                <small class=text-danger>{{$message}}</small>
                            @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="status">Status</label><br>
                                <input type="checkbox" name="status">
                            </div>

                            <div class="mb-3 col-md-12">
                                <button class="btn btn-primary float-end">Save Color</button>
                            </div>


                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
