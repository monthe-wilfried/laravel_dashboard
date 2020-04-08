@extends('layouts.app', ['page' => __('Edit Professorship'), 'pageSlug' => 'edit_professorship'])

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Edit Professorship</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        {!! Form::open(['method'=>'PUT', 'action'=>['ProfessorshipController@update', $professorship->id]])  !!}
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label>{{ __('Name') }}</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' has-error' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', $professorship->name) }}" required>
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>

                        <div class="form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
                            <label>{{ __('Code') }}</label>
                            <input type="text" name="code" class="form-control {{ $errors->has('code') ? ' has-error' : '' }}" placeholder="{{ __('Code') }}" value="{{ old('name', $professorship->code) }}" required>
                            @include('alerts.feedback', ['field' => 'code'])
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
