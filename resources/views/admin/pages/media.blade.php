@extends('layouts.app', ['page' => __('All Pictures'), 'pageSlug' => 'media'])

@section('content')

    <div class="content">
        <div class="row">
            <div class="col-sm-12">
{{--                {{ Form::open(['method'=>'DELETE', 'action'=>'PageContoller@destroy', 'class'=>'form-inline']) }}--}}
                <div class="card ">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8">
                                <h4 class="card-title">Pictures</h4>
                            </div>
                        </div>
                    </div>

{{--                    <div class="form-group">--}}
{{--                        <select class="form-control" name="checkBoxArray" id="">--}}
{{--                            <option class="back-color" value="delete">Delete</option>--}}
{{--                        </select>--}}
{{--                        <input style="margin-left: 5px" type="submit" class="btn-sm btn-primary">--}}
{{--                    </div>--}}

                    <div class="card-body">

                        @include('alerts.success')

                        <div class="">
                            <table class="table table-striped">
                                <thead class=" text-primary">
                                <tr>
{{--                                    <th scope="col">--}}
{{--                                        <input type="checkbox" id="options">--}}
{{--                                    </th>--}}
                                <th scope="col">Photo</th>
                                <th scope="col">Path</th>
                                <th scope="col">Upload Date</th>
                                <th scope="col"></th>
                                </tr></thead>
                                <tbody>

                                @foreach($photos as $photo)
                                    <tr>
{{--                                        <td>--}}
{{--                                            <input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="{{$photo->id}}">--}}
{{--                                        </td>--}}
                                        <td><img style="height: 80px;" src="{{ asset('black/img/'.$photo->file) ?? asset('black').'/img/gravatar.png'  }}" >
                                        <td>{{$photo->file}}</td>
                                        <td>{{$photo->created_at->diffForHumans() ?? 'No date available'}}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <form action="{{route('media.delete')}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="photo_id" value="{{ $photo->id }}">
                                                            <input style="cursor: pointer" type="submit" value="Delete" class="dropdown-item">
                                                        </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
{{--                            {{ Form::close() }}--}}
                        </div>
                        <div style="padding-left: 50%">{{$photos->render()}}</div>
                    </div>
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
