@extends('layouts.admin') 
@section('style')

@endsection

@section('content')
    <div class="row">
        <div class="card-wrapper col-md-8" style="margin: auto;">
            <div class="card">
                <div class="card-header">
                    <h4>Create new product</h4>
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
                    {!! Form::open(['url' => 'admin/product/store','files' => true]) !!} {{ Form::token() }} {{ Form::bsText('name') }}
                    {{ Form::bsTextArea('address') }} {{ Form::bsTextArea('description') }}
                    {{ Form::bsNumber('price') }} {{ Form::bsSelect('category_id',App\Category::pluck('name','id'),null,['placeholder'=>'Pick your catagory']) }}
                    {{ Form::bsSelect('user_id',App\User::pluck('name','id'),null,['placeholder'=>'Pick product creator']) }}
                    {{ Form::bsFile('images[]') }} {{ Form::bsSubmit('Submit') }}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
    </script>
@endsection