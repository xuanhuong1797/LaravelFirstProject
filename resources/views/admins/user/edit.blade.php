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
                    {{ Form::model($user, ['method'=> 'POST','route' => ['user.admin.update',$user->id],'files'=>true]) }}
                    {{ method_field('PUT') }} {{ Form::bsText('email',$user->email,['disabled']) }}
                    {{ Form::bsText('name',$user->name,['']) }} {{ Form::bsText('username',$user->username,['']) }}
                    {{ Form::bsSelect('gender',['0'=>'Man','1'=>'Woman'],$user->gender,[]) }}
                    {{ Form::bsSelect('role',$role->pluck('name','name'),$user->getRoleNames()->last(),[]) }}
                    <img src="{{ URL::to('/') }}/{{ $user->avatar_url }}" alt="" style="width: 200px;height: 200px;display: block;margin: auto">
                    <div class="form-group">
                        <label for="image_url">Update your user image</label>
                        <br> {{ Form::file('avatar') }}
                    </div>
                    {{ Form::submit('Update',['class' =>'btn btn-primary','style' =>'display:block;margin:auto']) }}
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