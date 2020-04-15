@extends('layouts.app', ['page' => __('All equipments'), 'pageSlug' => 'equipments_trash'])

@section('styles')
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

    <style type="text/css">

    </style>
@endsection

@section('content')

    <div class="content">
        <div class="row">
            <div class="col-sm-12">
                {{ Form::open(['method'=>'DELETE', 'action'=>'EquipmentController@trash_process', 'class'=>'form-inline']) }}
                <div class="card ">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8">
                                <h4 class="card-title">Equipments - Trash <i class="fas fa-trash-alt"></i></h4>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{route('equipments.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Equipment</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-4">
                        <a href="{{ route('equipments.index') }}" class="upper_links"><i class="far fa-check-circle"></i> Published ({{ $equipmentsCount }})</a> |
                        <a href="{{ route('equipment.trash') }}" class="upper_links"><i class="fas fa-trash-alt"></i> Trash ({{ $trashCount }})</a>
                    </div>

                    <div class="card-body">

                        @include('alerts.success')

                        <div class="form-group">
                            <select class="back-color form-control" name="select" id="">
                                <option value="">Select action...</option>
                                <option value="restore">Resore</option>
                                <option value="delete">Delete Permanently</option>
                            </select>
                            <input style="margin-left: 5px" type="submit" class="btn-sm btn-primary">
                        </div>
                        <div class="">
                            <table class="table table-striped">
                                <thead class=" text-primary">
                                <tr><th scope="col">
                                        <input type="checkbox" id="options">
                                    </th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Professorship</th>
                                    <th scope="col">Deleted Date</th>
                                </tr></thead>
                                <tbody>

                                @foreach($equipments as $equipment)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="{{$equipment->id}}">
                                        </td>
                                        <td>{{ $equipment->title }}</td>
                                        <td>
                                            {{--                                            <span class="article">{{ $publication->content }}</span>--}}
                                            @if(strlen($equipment->content) > 50)
                                                {{substr($equipment->content,0,50)}}
                                                <span class="read-more-show hide_content">Read More</span>
                                                <span class="read-more-content"> {{substr($equipment->content,100,strlen($equipment->content))}}
                                                <span class="read-more-hide hide_content">Read Less</span> </span>
                                            @else
                                                {{$equipment->content}}
                                            @endif
                                        </td>
                                        <td>{{ $equipment->professorship->name ?? 'Not Available' }}</td>
                                        <td>{{ $equipment->deleted_at->diffForHumans() ?? 'No date' }}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            {{ Form::close() }}
                        </div>
                        <div style="padding-left: 50%">{{$equipments->render()}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script type="text/javascript">
        // Hide the extra content initially, using JS so that if JS is disabled, no problemo:
        $('.read-more-content').addClass('hide_content')
        $('.read-more-show, .read-more-hide').removeClass('hide_content')

        // Set up the toggle effect:
        $('.read-more-show').on('click', function(e) {
            $(this).next('.read-more-content').removeClass('hide_content');
            $(this).addClass('hide_content');
            e.preventDefault();
        });

        // Changes contributed by @diego-rzg
        $('.read-more-hide').on('click', function(e) {
            var p = $(this).parent('.read-more-content');
            p.addClass('hide_content');
            p.prev('.read-more-show').removeClass('hide_content'); // Hide only the preceding "Read More"
            e.preventDefault();
        });
    </script>

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
