@extends('layouts.admin') 

@section('style')
@endsection
@section('selectPage')
    User
@endsection
@section('content')
    <div class="card mb-3">
        <div class="create-button">
            <a class="btn btn-success" href="{{ route('user.admin.create') }}" style="float: right; ">Create New User</a>
        </div>
        <div class="card-header">
            <i class="fa fa-table"></i> User Table</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <img src="{{ URL::to('/') }}/{{ $user->avatar_url }}" alt="" style="width: 100px;height: 100px; display: block;margin: a">
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    @foreach($user->getRoleNames() as $role)
                                        @if($loop->last)
                                            <button class="btn btn-info">{{ $role }}</button>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <a class="btn btn-primary editBtn" href="{{ route('user.admin.edit',[$user->id]) }}">Edit</a>
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
                            <th>Role</th>
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
    <script src="{{ asset('js/admin.user.js') }}"></script>
@endsection