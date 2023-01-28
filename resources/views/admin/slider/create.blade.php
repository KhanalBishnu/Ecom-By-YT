@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-header">
                    <h3>Add Slider
                        <a href="{{ url('admin/slider') }}"
                            class="btn btn-primary float-end btn-sm text-white">Back</a>
                    </h3>

                </div>
                <div class="card-body">
                    <form action="{{ url('admin/slider') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="title">Title</label>
                                <input type="text" name="title"class="form-control" >
                                @error('title')
                                    <small class=text-danger>{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="description">Description</label>
                                <input type="text" name="description"class="form-control">
                                @error('description')
                                <small class=text-danger>{{$message}}</small>
                            @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="image">Image</label>
                                <input type="file" name="image"class="form-control">
                                @error('image')
                                <small class=text-danger>{{$message}}</small>
                            @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="status">Status</label><br>
                                <input type="checkbox" name="status">
                            </div>

                            <div class="mb-3 col-md-12">
                                <button class="btn btn-primary float-end">Save Slider</button>
                            </div>


                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
