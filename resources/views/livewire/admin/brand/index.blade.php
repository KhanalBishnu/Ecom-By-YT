@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>

            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Brands List
                        <a href="{{ url('admin/brands/create') }}" class="btn btn-primary float-end btn-sm">Add
                            Brand</a>
                    </h3>

                </div>
                <div class="card-body">
                    <table class="table table-border table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr>
                                    <td>{{ $brand->id }}</td>
                                    <td>{{ $brand->name }}</td>
                                    <td>
                                        @if ($brand->category)
                                        {{ $brand->category->name }}
                                        @else
                                        No Category
                                        @endif
                                    </td>
                                    <td>{{ $brand->slug }}</td>
                                    <td>{{ $brand->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                    <td>
                                        <a class="btn btn-success" href="{{url('admin/brands/'.$brand->id.'/edit')}}">Edit</a>
                                        <a class="btn btn-danger"href="{{url('admin/brands/delete',['id'=>$brand->id])}}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{ $brands->links() }}
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
