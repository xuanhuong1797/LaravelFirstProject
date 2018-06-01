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
                    {{ Form::model($product, ['method'=> 'POST','route' => ['product.admin.update',$product->id],'files'=>true]) }}
                    {{ method_field('PUT') }} {{ Form::bsText('name',$product->name,['']) }}
                    {{ Form::bsTextArea('address',$product->address,['']) }}
                    {{ Form::bsTextArea('description',$product->description,['']) }}
                    {{ Form::bsNumber('price',$product->price) }} {{ Form::bsSelect('category_id',App\Category::pluck('name','id'),$product->category_id) }}
                    {{ Form::bsSelect('user_id',App\User::pluck('name','id'),$product->user_id,[]) }}
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