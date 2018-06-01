@extends('layouts.admin') 
@section('style')

@endsection

@section('content')
    <div class="row">
        <div class="card-wrapper col-md-8" style="margin: auto;">
            <div class="card">
                <div class="card-header">
                    <h4>Upload your category</h4>
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
                    {{ Form::model($category, ['method'=> 'POST','route' => ['category.update',$category->id],'files'=>true]) }}
                    {{ method_field('PUT') }} {{ Form::bsText('name',$category->name,['']) }}
                    <img src="{{ URL::to('/') }}/{{ $category->image_url }}" alt="" style="width: 200px;height: 200px;display: block;margin: auto">
                    <div class="form-group">
                        <label for="image_url">Update your category image</label>
                        <br> {{ Form::file('image') }}
                    </div>
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