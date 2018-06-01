@extends('layouts.admin') 

@section('style')
@endsection
@section('selectPage')
    EditRole
@endsection
@section('content')
    <div class="card mb-3">
        <div class="create-button">
            <a class="btn btn-success" href="{{ route('product.admin.create') }}" style="float: right;">Create New Product</a>
        </div>
        <div class="card-header">
            <i class="fa fa-table"></i> Permission Table</div>
        <div class="card-body">
            <input type="hidden" id="roleID" value="{{ $role->id }}">
            <div class="table-responsive">
                <input type="hidden" name="" id="   " value="{{ $role->id }}">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Permission</th>
                            <th>
                                <input type="checkbox" id="checkAll">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>
                                    {{ $permission->id }}
                                </td>
                                <td>
                                    {{ $permission->name }}
                                </td>
                                <td>
                                    @if($role->hasPermissionTo($permission->name))
                                        <input type="checkbox" id="checkItem" value="{{ $permission->name }}" checked>
                                        @else
                                        <input type="checkbox" id="checkItem" value="{{ $permission->name }}">
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Permission</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
        <div class="card-footer">
            <button class="btn btn-success" id="saveEdit" style="float:right;">Save</button>
        </div>
    </div>
@endsection

@section('script')
    <!-- <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('js/sb-admin-datatables.js') }}"></script> -->
    <script src="{{ asset('js/admin.role.js') }}"></script>
@endsection