@extends('layouts.app', ['page' => __('Create Publication'), 'pageSlug' => 'create_publication'])

@section('content')
    {!! Form::open(['method'=>'POST', 'action'=>'PublicationController@store', 'files'=>true]) !!}

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Create Publication') }}</h5>
                </div>

                <div class="card-body">

                    @include('alerts.success')


                    <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                        <label>{{ __('Title') }}</label>
                        <input type="text" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Enter title') }}" value="{{ old('title') }}" required >
                        @include('alerts.feedback', ['field' => 'title'])
                    </div>

                    <div class="form-group{{ $errors->has('content') ? ' has-danger' : '' }}">
                        <label>{{ __('Content') }}</label>
                        <textarea name="content" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" placeholder="{{ __('Enter content') }}" rows="10" required>{{ old('content') }}</textarea>
                        @include('alerts.feedback', ['field' => 'content'])
                    </div>

                    <div class="input_fields_wrap form-group{{ $errors->has('authors') ? ' has-danger' : '' }}">
                        <button class="add_field_button btn btn-default">Add More Authors</button>
                        <input type="text" name="authors[]" class="form-control{{ $errors->has('authors') ? ' is-invalid' : '' }}" placeholder="{{ __('Enter author') }}" value="{{ old('authors') }}" >
                        @include('alerts.feedback', ['field' => 'authors'])
                    </div>

                    <div class="form-group{{ $errors->has('year') ? ' has-danger' : '' }}">
                        <label>{{ __('Publication Year') }}</label>
                        <input type="number" name="year" class="form-control{{ $errors->has('year') ? ' is-invalid' : '' }}" value="{{ old('year') }}" required >
                        @include('alerts.feedback', ['field' => 'year'])
                    </div>
                    <hr>

                    <div class="card-footer">
                        <input type="submit" value="create" class="btn btn-primary">
                    </div>

                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
@endsection

@section('scripts')

    <script>
        $(document).ready(function() {
            var max_fields      = 10; //maximum input boxes allowed
            var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
            var add_button      = $(".add_field_button"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div class="form-group">' +
                        '<input type="text" name="authors[]" class="form-control" placeholder="Enter another author" required/>' +
                        '<button style="border-radius: 10px; background-color: #8fbcb5" type="button" class="remove_field" data-dismiss="alert">×</button>' +
                        '</div>'); //add input box
                }
            });

            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })
        });
    </script>

@endsection

