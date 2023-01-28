@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Category
                        <a href="{{ url('admin/category') }}"
                            class="btn btn-primary float-end btn-sm text-white">Back</a>
                    </h3>

                </div>
                <div class="card-body">
                    <form action="{{ url('admin/category/'.$category->id) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name">Name</label>
                                <input type="text" name="name"class="form-control" value="{{$category->name}}">
                                @error('name')
                                    <small class=text-danger>{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug"class="form-control" value="{{$category->slug}}">
                                @error('slug')
                                <small class=text-danger>{{$message}}</small>
                            @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="status">Status</label><br>
                                <input type="checkbox" name="status" {{$category->status=='1' ?'checked':''}}>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="image">Image</label>
                                <input type="file" name="image"class="form-control">
                                <img src="{{asset($category->image)}}" width="60px" height="60px">
                                @error('image')
                                <small class=text-danger>{{$message}}</small>
                            @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="description">Descroption</label>
                                <textarea name="description"class="form-control" rows="3" >{{$category->description}}</textarea>
                                @error('description')
                                <small class=text-danger>{{$message}}</small>
                            @enderror
                            </div>
                            <div class="col-md-12">
                                <h4>SEO Tags</h4>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" name="meta_title"class="form-control" value="{{$category->meta_title}}">
                                @error('meta_title')
                                <small class=text-danger>{{$message}}</small>
                            @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="meta_keyword">Meta Keyword</label>
                                <input type="text" name="meta_keyword"class="form-control" value="{{$category->meta_keyword}}">
                                @error('meta_keyword')
                                <small class=text-danger>{{$message}}</small>
                            @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="meta_description">Meta Descroption</label>
                                <textarea name="meta_description"class="form-control" rows="3"> {{$category->meta_description}}</textarea>
                                @error('meta_description')
                                <small class=text-danger>{{$message}}</small>
                            @enderror
                            </div>

                            <div class="mb-3 col-md-12">
                                <button class="btn btn-primary float-end">Update Category</button>
                            </div>


                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
