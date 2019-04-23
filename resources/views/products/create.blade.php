@extends('layouts.master')
@section('style')

@endsection

@section('content')
    <div class="row">
        <div class="card-wrapper col-md-8" style="margin: auto;">
            <div class="card">
                <div class="card-header">
                    <h4>Upload your product</h4>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(Session::has('messenger'))
                        <div class="alert alert-success">
                            {{ Session::get('messenger') }}
                        </div>
                    @endif
                    {!! Form::open(['url' => 'product/store','files' => true]) !!}
                        {{ Form::token() }}
                        {{ Form::bsText('name',null,['required' => true, 'placeholder'=>'Your product \'s name' ]) }}
                        {{ Form::bsTextArea('description',null,['required' => true, 'placeholder'=>'Your product \'s description', 'rows' => 4]) }}
                        {{ Form::bsNumber('price',null,['required' => true]) }}
                        <div class="form-group">
                            {{ Form::label('Category', null, ['class' => 'control-label col-md-3']) }}
                            {{ Form::select('category_id', $categories, null, ['class' => 'form-control','placeholder'=>'Pick up your product Catagory', 'required' => true]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('Province', null, ['class' => 'control-label col-md-3']) }}
                            {{ Form::select('province_id', $provincies, null, ['class' => 'form-control','placeholder'=>'Please select your Province', 'id' => 'province_option', 'required' => true]) }}
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">District:</label>
                            <select class="form-control" name="district_id" id="district_option" required>
                                <option value="" disabled selected>Please select your District</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Ward:</label>
                            <select class="form-control" name="ward_id" id="ward_option" required>
                                <option value="" disabled selected>Please select your Ward</option>
                            </select>
                        </div>
                        {{ Form::bsText('address',null,['required' => true]) }}
                        {{ Form::bsFile('images[]',['required' => true]) }}
                        {{ Form::bsSubmit('Submit') }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>


    </div>

@endsection

@section('script')
    <script src="{{ asset('js/product/create.js') }}"></script>
@endsection
