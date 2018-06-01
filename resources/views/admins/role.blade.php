@extends('layouts.admin') 

@section('selectPage')
    Role
@endsection
@section('style')
@endsection

@section('content')
    <div class="card mb-3">
        <div class="create-button">
            <a href="{{ route('role.admin.create') }}" class="btn btn-success" style="float: right;">Create New Role</a>
        </div>
        <div class="card-header">
            <i class="fa fa-table"></i> Role table </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Role Name</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>

                                <td>{{ $role->name }}</td>
                                <td>
                                    <a class="btn btn-primary editBtn" href="{{ route('role.admin.edit',[$role->id]) }}">Edit</a>
                                    <!-- <button class="btn btn-danger deleteBtn">Delete</button> -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Role Name</th>
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