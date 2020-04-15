@extends('layouts.app', ['page' => __('Create Equipment'), 'pageSlug' => 'equipment_create'])

@section('styles')
{{--    <script src="https://cdn.ckeditor.com/4.4.5.1/full-all/ckeditor.js"></script>--}}
@endsection

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
                        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
                        <script>
                            CKEDITOR.replace( 'ckeditor', {
                                filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
                                filebrowserUploadMethod: 'form'
                            });
                        </script>
                        @include('alerts.feedback', ['field' => 'content'])
                        <br>

{{--                        <input type="text" name="authors[]" class="form-control{{ $errors->has('authors') ? ' is-invalid' : '' }}" placeholder="{{ __('Enter author') }}" value="{{ old('authors') }}" >--}}
{{--                        @include('alerts.feedback', ['field' => 'authors'])--}}
                    </div>


{{--                    <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">--}}
{{--                        <label>{{ __('Title') }}</label><span class="star"> * </span>--}}
{{--                        <input type="text" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Enter title') }}" value="{{ old('title') }}" required >--}}
{{--                        @include('alerts.feedback', ['field' => 'title'])--}}
{{--                    </div>--}}

{{--                    <div class="form-group{{ $errors->has('content') ? ' has-danger' : '' }}">--}}
{{--                        <label>{{ __('Content') }}</label><span class="star"> * </span>--}}
{{--                        <textarea name="content" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" placeholder="{{ __('Enter content') }}" rows="10" required>{{ old('content') }}</textarea>--}}
{{--                        <script>CKEDITOR.replace( 'content' );</script>--}}
{{--                        @include('alerts.feedback', ['field' => 'content'])--}}
{{--                    </div>--}}

{{--                    <div class="input_fields_wrap form-group{{ $errors->has('authors') ? ' has-danger' : '' }}">--}}
{{--                        <label>{{ __('Authors') }}</label><span class="star"> * </span><br>--}}
{{--                        <button class="add_field_button btn btn-default">Add More Authors</button>--}}
{{--                        <input type="text" name="authors[]" class="form-control{{ $errors->has('authors') ? ' is-invalid' : '' }}" placeholder="{{ __('Enter author') }}" value="{{ old('authors') }}" >--}}
{{--                        @include('alerts.feedback', ['field' => 'authors'])--}}
{{--                    </div>--}}
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

@section('scripts')

{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            var max_fields      = 10; //maximum input boxes allowed--}}
{{--            var wrapper   		= $(".input_fields_wrap"); //Fields wrapper--}}
{{--            var add_button      = $(".add_field_button"); //Add button ID--}}

{{--            var x = 1; //initlal text box count--}}
{{--            $(add_button).click(function(e){ //on add input button click--}}
{{--                e.preventDefault();--}}
{{--                if(x < max_fields){ //max input box allowed--}}
{{--                    x++; //text box increment--}}
{{--                    $(wrapper).append('<div class="form-group">' +--}}
{{--                        '<label>{{ __('Title') }}</label><span class="star"> * </span>'+--}}
{{--                        '<input type="text" name="authors[]" class="form-control" placeholder="Enter another title" required/>' +--}}
{{--                        '<br>'+--}}
{{--                        '<label>{{ __('Content') }}</label><span class="star"> * </span>' +--}}
{{--                        '<textarea name="content" class="form-control"  rows="10" required></textarea>'+--}}
{{--                        '<br>'+--}}
{{--                        '<button style="border-radius: 10px; background-color: #8fbcb5" type="button" class="remove_field" data-dismiss="alert">×</button>' +--}}
{{--                        '</div>'); //add input box--}}
{{--                }--}}
{{--            });--}}
{{--            CKEDITOR.replace( 'content' );--}}
{{--            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text--}}
{{--                e.preventDefault(); $(this).parent('div').remove(); x--;--}}
{{--            })--}}
{{--        });--}}
{{--    </script>--}}


@endsection



