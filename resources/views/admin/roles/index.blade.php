@extends('layouts.app', ['page' => __('Roles'), 'pageSlug' => 'roles'])

@section('content')

    <div class="row">
        <div style="padding-top: 50px;" class="col-sm-2">
            <div class="add-category">
                <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
            </div>
        </div>


        <div class="col-sm-10">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Roles</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="">
                        <table class="table table-striped">
                            <thead class=" text-primary">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Creation Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{$role->id}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->created_at->diffForHumans() ?? 'no date available'}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
