@extends('layouts.app', ['page' => __('All Publications'), 'pageSlug' => 'publications'])

@section('content')

    <div class="content">
        <div class="row">
            <div class="col-sm-12">
                {{ Form::open(['method'=>'DELETE', 'action'=>'PublicationController@delete', 'class'=>'form-inline']) }}
                <div class="card ">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8">
                                <h4 class="card-title">Publications</h4>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{route('publications.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Publication</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        @include('alerts.success')

                        <div class="form-group">
                            <select name="checkBoxArray" id="">
                                <option value="delete">Delete</option>
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
                                    <th scope="col">Authors</th>
                                    <th scope="col">Publication Year</th>
                                    <th scope="col">Created Date</th>
                                    <th scope="col"></th>
                                </tr></thead>
                                <tbody>

                                @foreach($publications as $publication)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="{{$publication->id}}">
                                        </td>
                                        <td>{{ $publication->title }}</td>
                                        <td>{!! Str::limit($publication->content, 100) !!} </td>
                                        <td>
                                            @if($publication->authors)
                                                @foreach($publication->authors as $author)
                                                    <a href="">{{ $author->name }}</a>
                                                    @if(count($publication->authors) > 1)
                                                        |
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{ $publication->year }}</td>
                                        <td>{{ $publication->created_at->diffForHumans() ?? 'No date' }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{route('publications.edit', $publication->id)}}">Edit</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            {{ Form::close() }}
                        </div>
                        <div style="padding-left: 50%">{{$publications->render()}}</div>
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
