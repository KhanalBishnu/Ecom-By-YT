@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-header">
                    <h3>Add Category
                        <a href="{{ url('admin/category') }}"
                            class="btn btn-primary float-end btn-sm text-white">Back</a>
                    </h3>

                </div>
                <div class="card-body">
                    <form action="{{ url('admin/category') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name">Name</label>
                                <input type="text" name="name"class="form-control" >
                                @error('name')
                                    <small class=text-danger>{{$message}}</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
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

                            <div class="mb-3 col-md-6">
                                <label for="image">Image</label>
                                <input type="file" name="image"class="form-control">
                                @error('image')
                                <small class=text-danger>{{$message}}</small>
                            @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="description">Descroption</label>
                                <textarea name="description"class="form-control" rows="3"></textarea>
                                @error('description')
                                <small class=text-danger>{{$message}}</small>
                            @enderror
                            </div>
                            <div class="col-md-12">
                                <h4>SEO Tags</h4>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" name="meta_title"class="form-control">
                                @error('meta_title')
                                <small class=text-danger>{{$message}}</small>
                            @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="meta_keyword">Meta Keyword</label>
                                <input type="text" name="meta_keyword"class="form-control">
                                @error('meta_keyword')
                                <small class=text-danger>{{$message}}</small>
                            @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="meta_description">Meta Descroption</label>
                                <textarea name="meta_description"class="form-control" rows="3"></textarea>
                                @error('meta_description')
                                <small class=text-danger>{{$message}}</small>
                            @enderror
                            </div>

                            <div class="mb-3 col-md-12">
                                <button class="btn btn-primary float-end">Save Category</button>
                            </div>


                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
