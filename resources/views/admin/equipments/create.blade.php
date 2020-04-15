@extends('layouts.app', ['page' => __('Create Equipment'), 'pageSlug' => 'equipment_create'])

@section('content')
    {!! Form::open(['method'=>'POST', 'action'=>'EquipmentController@store', 'files'=>true]) !!}

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Create Equipment') }}</h5>
                </div>

                <div class="card-body">

                    @include('alerts.success')

                    <div class="input_fields_wrap form-group{{ $errors->has('authors') ? ' has-danger' : '' }}">
                        <label>{{ __('Title') }}</label><span class="star"> * </span>
                        <input type="text" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Enter title') }}" value="{{ old('title') }}" required >
                        @include('alerts.feedback', ['field' => 'title'])
                        <br>

                        <label>{{ __('Content') }}</label><span class="star"> * </span>
                        <textarea id="ckeditor" name="content" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" placeholder="{{ __('Enter content') }}" rows="10" required>{{ old('content') }}</textarea>
                        @include('includes.ckeditor')
                        @include('alerts.feedback', ['field' => 'content'])
                    </div>
                    <br>
                    <div class="form-group{{ $errors->has('professorship') ? ' has-danger' : '' }}">
                        <label>{{ __('Professorship') }}</label><span class="star"> * </span>
                        {!! Form::select('professorship_id', [' '=>'Select Professorship...'] + $professorships, null, ['class'=>"back-color form-control {{ $errors->has('professorship_id') ? ' is-invalid' : '' }}"]) !!}
                        @include('alerts.feedback', ['field' => 'professorship_id'])
                    </div>
                    <hr>

                    <div class="card-footer">
                        <input type="submit" value="create" class="btn btn-primary">
                        <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
@endsection



