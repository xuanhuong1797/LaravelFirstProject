@extends('layouts.master')

@section('content')
    <h1 style="text-align: center">Edit Profile</h1>
    <hr>
    <div class="row">
        <div class="col-md-8" style="margin: auto">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{ Form::model($user, ['method'=> 'POST','route' => ['user.update',$user->id],'files'=>true]) }}
            {{ method_field('PUT') }}
            <div class="col-md-6" style="margin: auto">
                <div class="text-center">
                    <img src="{{ URL::to('/') }}/{{ $user->avatar_url }}" class="avatar img-circle" alt="avatar">
                    <h6>Upload a different photo...</h6>
                    <div class="col-md-6">
                        {{ Form::file('avatar') }}
                    </div>
                </div>
            </div>
            {{ Form::bsText('email',$user->email,['disabled']) }} {{ Form::bsText('name',$user->name,['']) }}
            {{ Form::bsText('username',$user->username,['']) }} {{ Form::bsSelect('gender',['0'=>'Man','1'=>'Woman'],$user->gender,[]) }}
            {{ Form::submit('Edit',['class' =>'btn btn-primary']) }}
            {!! Form::close() !!}
        </div>

    </div>
@endsection