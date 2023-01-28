@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-header">
                    <h3>Add Brand
                        <a href="{{ url('admin/brands') }}"
                            class="btn btn-primary float-end btn-sm text-white">Back</a>
                    </h3>

                </div>
                <div class="card-body">
                    <form action="{{ url('admin/brands') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="md-3">
                                <label for="category_id">Select Category</label>
                                <select name="category_id" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $cateItem )
                                        <option value="{{$cateItem->id}}">{{$cateItem->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="name">Name</label>
                                <input type="text" name="name"class="form-control" >
                                @error('name')
                                    <small class=text-danger>{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug"class="form-control">
                                @error('slug')
                                <small class=text-danger>{{$message}}</small>
                            @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="status">Status</label><br>
                                <input type="checkbox" name="status">
                            </div>

                            <div class="mb-3 col-md-12">
                                <button class="btn btn-primary float-end">Save Brand</button>
                            </div>


                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
