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
                    {{ Form::model($product, ['method'=> 'POST','route' => ['product.update',$product->id],'files'=>true]) }}
                    {{ method_field('PUT') }} {{ Form::bsText('name',$product->name,['']) }}
                    {{ Form::bsTextArea('address',$product->address,['']) }}
                    {{ Form::bsTextArea('description',$product->description,['']) }}
                    {{ Form::bsNumber('price',$product->price) }} {{ Form::bsSelect('category_id',App\Models\Category::pluck('name','id'),$product->category_id) }}
                    {{ Form::submit('Edit',['class' =>'btn btn-primary']) }}
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
