@extends('layouts.app', ['page' => __('Edit Publication'), 'pageSlug' => 'edit_publication'])

@section('styles')
    <script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
@endsection

@section('content')
    <form method="post" action="{{ route('publications.update', $publication->id) }}">
    @csrf
        @method('put')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Edit Publication') }}</h5>
                </div>

                <div class="card-body">

                    @include('alerts.success')

                    <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                        <label>{{ __('Title') }}</label><span class="star"> * </span>
                        <input type="text" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Enter title') }}" value="{{ old('title', $publication->title) }}" required >
                        @include('alerts.feedback', ['field' => 'title'])
                    </div>

                    <div class="form-group{{ $errors->has('content') ? ' has-danger' : '' }}">
                        <label>{{ __('Content') }}</label><span class="star"> * </span>
                        <textarea name="content" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" placeholder="{{ __('Enter content') }}" rows="10" required>{{ old('content', $publication->content) }}</textarea>
                        <script>CKEDITOR.replace( 'content' );</script>
                        @include('alerts.feedback', ['field' => 'content'])
                    </div>

                    <div class="input_fields_wrap form-group{{ $errors->has('authors') ? ' has-danger' : '' }}">

                        @foreach($publication->authors as $author)
                            <label>{{ __('Authors') }}</label><span class="star"> * </span>
                            <input type="hidden" name="author_ids[]" value="{{ $author->id }}">
                            <input type="text" name="authors[]" class="form-control{{ $errors->has('authors') ? ' is-invalid' : '' }}" placeholder="{{ __('Enter author') }}" value="{{ old('authors', $author->name) }}" >
                            @include('alerts.feedback', ['field' => 'authors'])
                        @endforeach
                    </div>

                    <div class="form-group{{ $errors->has('year') ? ' has-danger' : '' }}">
                        <label>{{ __('Publication Year') }}</label><span class="star"> * </span>
                        <input type="number" name="year" class="form-control{{ $errors->has('year') ? ' is-invalid' : '' }}" value="{{ old('year', $publication->year) }}" required >
                        @include('alerts.feedback', ['field' => 'year'])
                    </div>
                    <hr>

                    <div class="card-footer">
                        <input type="submit" value="Save" class="btn btn-primary">
                        <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    </form>
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

