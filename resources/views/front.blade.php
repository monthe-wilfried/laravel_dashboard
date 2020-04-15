@extends('layouts.app', ['page' => __('Equipments'), 'pageSlug' => 'front'])

@section('content')

    <div class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        @foreach($equipments as $equipment)
                            <hr>
                            <h4>{{$equipment->title}}</h4>
                            <hr>
                            <p>{!! $equipment->content !!} </p>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
