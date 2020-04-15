@extends('layouts.app', ['page' => __('Edit Equipment'), 'pageSlug' => 'equipment_edit'])

@section('content')
    <form method="post" action="{{ route('equipments.update', $equipment->id) }}">
       @csrf
        @method('PUT')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Edit Equipment') }}</h5>
                </div>

                <div class="card-body">

                    @include('alerts.success')

                    <div class="input_fields_wrap form-group{{ $errors->has('authors') ? ' has-danger' : '' }}">
                        <label>{{ __('Title') }}</label><span class="star"> * </span>
                        <input type="text" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Enter title') }}" value="{{ old('title', $equipment->title) }}" required >
                        @include('alerts.feedback', ['field' => 'title'])
                        <br>

                        <label>{{ __('Content') }}</label><span class="star"> * </span>
                        <textarea id="ckeditor" name="content" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" placeholder="{{ __('Enter content') }}" required>{{ old('content', $equipment->content) }}</textarea>
                        @include('includes.ckeditor')
                        @include('alerts.feedback', ['field' => 'content'])
                        <br>

                    </div>
                    <br>
                    <div class="form-group{{ $errors->has('professorship') ? ' has-danger' : '' }}">
                        <label>{{ __('Professorship') }}</label><span class="star"> * </span>
                        {!! Form::select('professorship_id', $professorships, $equipment->professorship->id, ['class'=>"back-color form-control {{ $errors->has('professorship_id') ? ' is-invalid' : '' }}"]) !!}
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

    </form>
@endsection



