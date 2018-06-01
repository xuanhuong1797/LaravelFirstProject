@extends('layouts.admin') 

@section('style')
@endsection
@section('selectPage')
    Product
@endsection
@section('content')
    <div class="card mb-3">
        <div class="create-button">
            <a class="btn btn-success" href="{{ route('product.admin.create') }}" style="float: right;">Create New Product</a>
        </div>
        <div class="card-header">
            <i class="fa fa-table"></i> Product Table</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Product Creator</th>
                            <th>Address</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    <img src="{{ URL::to('/') }}/{{ $product->image->first()->image_url }}" alt="" style="width: 200px;height: 200px;display: block;margin: auto">
                                </td>
                                <td>
                                    <a href="{{ route('product.show',[$product->slug]) }}">{{ $product->name }}</a>
                                </td>
                                <td>{{ $product->user->name }}</td>
                                <td>{{ $product->address }}</td>
                                <td>{{ str_limit($product->description,100) }}</td>
                                <td style="text-align: center">
                                    @if ($product->published)
                                        <i class="fas fa-check-circle" style="color: blue"></i>
                                        @else
                                        <i class="fas fa-times-circle" style="color: red"></i>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-primary editBtn" href="{{ route('product.admin.edit',$product->id) }}">Edit</a>
                                    <button class="btn btn-danger deleteBtn" idc="{{ $product->id }}">Delete</button>
                                    @if (Auth::user()->can('publish products') ||Auth::user()->can('unpublish products') )
                                        @if ($product->published)
                                            <button class="btn btn-info publishProduct">
                                                Unpublish
                                            </button>
                                            @else
                                            <button class="btn btn-info publishProduct">
                                                Publish
                                            </button>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Product Creator</th>
                            <th>Address</th>
                            <th>Description</th>
                            <th>Status</th>
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
    <script src="{{ asset('js/admin.product.js') }}"></script>
@endsection