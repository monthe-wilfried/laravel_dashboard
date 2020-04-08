@extends('layouts.app', ['page' => __('Create User'), 'pageSlug' => 'create_user'])

@section('content')
    {!! Form::open(['method'=>'POST', 'action'=>'UserController@store', 'files'=>true]) !!}

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Create User') }}</h5>
                </div>
                {{--                <form method="post" action="{{ route('user.userUpdate') }}" enctype="multipart/form-data"  autocomplete="off">--}}
                <div class="card-body">
                    {{--                        @csrf--}}
                    {{--                        @method('put')--}}

                    @include('alerts.success')


                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label>{{ __('Name') }}</label>
                        <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required >
                        @include('alerts.feedback', ['field' => 'name'])
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <label>{{ __('Email address') }}</label>
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email address') }}" value="{{ old('email') }}" required>
                        @include('alerts.feedback', ['field' => 'email'])
                    </div>

                    <div class="form-group{{ $errors->has('biography') ? ' has-danger' : '' }}">
                        <label>{{ __('Biography') }}</label>
                        <textarea class="form-control" name="biography" rows="2" placeholder="Short description of yourself...">{{ old('biography') }}</textarea>
                        @include('alerts.feedback', ['field' => 'biography'])
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group{{ $errors->has('professorship_id') ? ' has-danger' : '' }}">
                        <label>{{ __('Professorship') }}</label>
                        {!! Form::select('professorship_id', [''=>'Select a professorship...'] + $professorships, null, ['class'=>" {{ $errors->has('professorship_id') ? ' is-invalid' : '' }}" ]) !!}
                        @include('alerts.feedback', ['field' => 'professorship_id'])
                    </div>
                    <br>
                    <div class="form-group">
                        <label>{{ __('Role') }}</label>
                        {!! Form::select('role_id', [''=>'Select a role...'] + $roles, null, ['class'=>" {{ $errors->has('role_id') ? ' is-invalid' : '' }}" ]) !!}
                        @include('alerts.feedback', ['field' => 'role_id'])
                    </div>
                    <br>
                    <label>{{ __('Picture') }}</label>
                    <input type="file" name="file" class="form-control" >
                    @include('alerts.feedback', ['field' => 'file'])

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h5 class="title">{{ __('Password') }}</h5>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <label>{{ __('Password') }}</label>
                        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
                        @include('alerts.feedback', ['field' => 'password'])
                    </div>

                    <div class="form-group">
                        <label>{{ __('Confirm Password') }}</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm New Password') }}" value="" required>
                    </div>
                    <hr>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection

