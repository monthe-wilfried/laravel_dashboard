@extends('layouts.app', ['page' => __('Edit Profile'), 'pageSlug' => 'edit_user'])

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Edit Profile') }}</h5>
                </div>
                {!! Form::model($user, ['method'=>'PUT', 'action'=>'UserController@userUpdate', 'files'=>true]) !!}
{{--                <form method="post" action="{{ route('user.userUpdate') }}" enctype="multipart/form-data"  autocomplete="off">--}}
                    <div class="card-body">
{{--                        @csrf--}}
{{--                        @method('put')--}}

                        @include('alerts.success')

                        <input type="hidden" name="user_id" value="{{$user->id}}">

                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label>{{ __('Name') }}</label><span class="star"> * </span>
                            <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', $user->name) }}">
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label>{{ __('Email address') }}</label><span class="star"> * </span>
                            <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email address') }}" value="{{ old('email', $user->email) }}">
                            @include('alerts.feedback', ['field' => 'email'])
                        </div>

                        <div class="form-group{{ $errors->has('biography') ? ' has-danger' : '' }}">
                            <label>{{ __('Biography') }}</label>
                            <textarea class="form-control" name="biography" rows="2" placeholder="Short description of yourself...">{{ old('biography', $user->biography) }}</textarea>
                            @include('alerts.feedback', ['field' => 'biography'])
                        </div>

                        @if($user->role->name == 'author')
                        <div class="form-group{{ $errors->has('professorship_id') ? ' has-danger' : '' }}">
                            <label>{{ __('Professorship') }}</label>
                            {!! Form::select('professorship_id', $professorships, null, ['class'=>"back-color form-control {{ $errors->has('professorship_id') ? ' is-invalid' : '' }}" ]) !!}
                            @include('alerts.feedback', ['field' => 'professorship_id'])
                        </div>
                        @endif
                        <br>
                        <div class="form-group">
                            <label>{{ __('Role') }}</label>
                            <input type="text" name="role" class="form-control" value="{{ old('role', $user->role->name ?? '') }}" readonly>
                            @include('alerts.feedback', ['field' => 'email'])
                        </div>
                        <br>
                        <label>{{ __('Picture') }}</label>
                        <input type="file"  name="file" class="form-control" >
                        @include('alerts.feedback', ['field' => 'file'])

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                        <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
                    </div>
                {!! Form::close() !!}
{{--                </form>--}}
            </div>


        </div>
        <div class="col-md-4">
            <div class="card card-user">
                <div class="card-body">
                    <p class="card-text">
                        <div class="author">
                            <div class="block block-one"></div>
                            <div class="block block-two"></div>
                            <div class="block block-three"></div>
                            <div class="block block-four"></div>
                            <a href="#">
                                <img class="avatar" src="{{ $user->photo ? asset('black/img/'.$user->photo->file) : asset('black/img/gravatar.png') }}">
                                <h5 class="title">{{ $user->name }}</h5>
                            </a>
                    <p class="description">
                        {{ __($user->professorship->name ?? $user->role->name) }}
                    </p>
                </div>
                </p>
                <div class="card-description">
                    <p class="text-center">{{ __($user->biography) }}</p>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

