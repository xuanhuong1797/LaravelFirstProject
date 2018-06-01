@extends('layouts.admin') 

@section('selectPage')
    Category
@endsection
@section('style')
@endsection

@section('content')
    <div class="card mb-3">
        <div class="create-button">
            <a href="{{ route('category.create') }}" class="btn btn-success" style="float: right;">Create New Category</a>
        </div>
        <div class="card-header">
            <i class="fa fa-table"></i> Category table </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>
                                    <img src="{{ URL::to('/') }}/{{ $category->image_url }}" alt="" style="width: 40px;display: block;margin: auto">
                                </td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a class="btn btn-primary editBtn" href="{{ route('category.edit',[$category->id]) }}">Edit</a>
                                    <button class="btn btn-danger deleteBtn">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th></th>
                        </tr>
                    </tfoot>

                </table>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('js/sb-admin-datatables.js') }}"></script>
    <script src="{{ asset('js/admin.category.js') }}"></script>
@endsection