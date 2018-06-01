@extends('layouts.admin') 
@section('style')

@endsection

@section('content')
    <div class="row">
        <div class="card-wrapper col-md-8" style="margin: auto;">
            <div class="card">
                <div class="card-header">
                    <h4>Create new user</h4>
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
                    {!! Form::open(['url' => 'admin/user/store','files' => true]) !!} {{ Form::token() }} {{ Form::bsText('email') }}
                    {{ Form::bsText('name') }} {{ Form::bsText('username') }}
                    {{ Form::bsSelect('gender',['0'=>'Man','1'=>'Woman']) }}
                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                    {{ Form::bsSelect('role',$role->pluck('name','name')) }}
                    {{ Form::file('avatar') }} {{ Form::submit('Create',['class' =>'btn btn-primary','style' =>'display:block;margin:auto']) }}
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