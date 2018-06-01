@extends('layouts.admin') 
@section('style')

@endsection

@section('content')
    <div class="row">
        <div class="card-wrapper col-md-8" style="margin: auto;">
            <div class="card">
                <div class="card-header">
                    <h4>Create your Category</h4>
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
                    {!! Form::open(['url' => 'category/store','files' => true]) !!} {{ Form::token() }} {{ Form::bsText('name') }}
                    {{ Form::bsFile('image') }} {{ Form::bsSubmit('Submit') }}
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