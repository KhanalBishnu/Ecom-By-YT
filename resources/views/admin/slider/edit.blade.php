@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>

            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Edit Slider
                        <a href="{{ url('admin/slider') }}"
                            class="btn btn-primary float-end btn-sm text-white">Back</a>
                    </h3>

                </div>
                <div class="card-body">
                    <form action="{{ url('admin/slider/'.$slider->id) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="title">Title</label>
                                <input type="text" name="title"class="form-control" value="{{$slider->title}}">
                                @error('title')
                                    <small class=text-danger>{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="description">Description</label>
                                <input type="text" name="description"class="form-control" value="{{$slider->description}}">
                                @error('description')
                                <small class=text-danger>{{$message}}</small>
                            @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="image">Image</label>
                                <input type="file" name="image"class="form-control">
                                <img src="{{asset("$slider->image")}}" style="width:70px; height:80px;">

                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="status">Status</label><br>
                                <input type="checkbox" name="status" {{$slider->status=='1' ?'checked':''}}>
                            </div>




                            <div class="mb-3 col-md-12">
                                <button class="btn btn-primary float-end">Update Slider</button>
                            </div>


                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
