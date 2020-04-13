@extends('layouts.app', ['page' => __('Professorships'), 'pageSlug' => 'professorships'])

@section('content')

    <div class="row">
        <div style="padding-top: 50px; padding-left: 30px" class="col-sm-4">
            <div class="add-category">
                <a class="btn btn-primary btn-add" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa fa-plus"></i> Add Professorship
                </a>
                <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">

                        {!! Form::open(['method'=>'POST', 'action'=>'ProfessorshipController@store'])  !!}
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label>{{ __('Name') }}</label><span class="star"> * </span>
                            {!! Form::text('name', null, ['class'=> "form-control {{ $errors->has('name') ? ' has-error' : '' }}"]) !!}
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>

                        <div class="form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
                            <label>{{ __('Code') }}</label><span class="star"> * </span>
                            {!! Form::number('code', null, ['class'=> "form-control {{ $errors->has('code') ? ' has-error' : '' }}"]) !!}
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


        <div class="col-sm-8">
            {{ Form::open(['method'=>'DELETE', 'action'=>'ProfessorshipController@delete', 'class'=>'form-inline']) }}
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Professorships</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    @include('alerts.success')

                    <div class="form-group">
                        <select class="form-control" name="checkBoxArray" id="">
                            <option class="back-color" value="delete">Delete</option>
                        </select>
                        <input style="margin-left: 5px" type="submit" class="btn-sm btn-primary">
                    </div>

                    <div class="">
                        <table class="table table-striped">
                            <thead class=" text-primary">
                            <tr>
                                <th scope="col">
                                    <input type="checkbox" id="options">
                                </th>
                                <th scope="col">Name</th>
                                <th scope="col">Code</th>
                                <th scope="col">Creation Date</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($professorships as $professorship)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="{{$professorship->id}}">
                                    </td>
                                    <td>{{$professorship->name}}</td>
                                    <td>{{$professorship->code}}</td>
                                    <td>{{$professorship->created_at->diffForHumans() ?? 'no date available'}}</td>
                                    <td class="text-right">

                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="{{route('professorships.edit', $professorship->id)}}">Edit</a>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ Form::close() }}
                    </div>
                    <div style="padding-left: 50%">{{$professorships->render()}}</div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#options').click(function () {
                if (this.checked){
                    $('.checkBoxes').each(function () {
                        this.checked = true;
                    });
                }
                else{
                    $('.checkBoxes').each(function () {
                        this.checked = false;
                    });
                }
            });
        });
    </script>
@endsection
