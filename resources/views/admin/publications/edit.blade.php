@extends('layouts.app', ['page' => __('Edit Professorship'), 'pageSlug' => 'edit_professorship'])

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Edit Professorships</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        {!! Form::model($professorship, ['method'=>'DELETE', 'action'=>['ProfessorshipController@update', $professorship->id]])  !!}
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label>{{ __('Name') }}</label>
                            {!! Form::text('name', null, ['class'=> "form-control {{ $errors->has('name') ? ' has-error' : '' }}"]) !!}
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>

                        <div class="form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
                            <label>{{ __('Code') }}</label>
                            {!! Form::number('code', null, ['class'=> "form-control {{ $errors->has('code') ? ' has-error' : '' }}"]) !!}
                            @include('alerts.feedback', ['field' => 'code'])
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Save', ['class'=>'btn btn-default']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
