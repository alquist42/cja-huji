@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            Obj. ID: {{ $item->id }} {{ $item->name() }}
                            @if($item->object_detail()) ,{{$item->object_detail()}} @endif
                            @foreach ($item->origins as $origin)
                                ,{{ $origin->name }}
                            @endforeach
                            @if($item->origin_detail()) | {{$item->origin_detail()}} @endif
                            @if($item->creation_date) ,{{$item->creation_date->name}} @endif
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">

                                    <div class="col-md-6">
                                        @include('item.image')
                                        @include('item.image-details')
                                    </div>

                                    <div class="col-md-6">
                                        <div class="container">
                                            <dl class="row">
                                                <dt class="col-sm-3 lead">Category</dt>
                                                <dd class="col-sm-9 lead">
                                                    {{ $item->category_object->name}}
                                                </dd>
                                            </dl>
                                            <dl class="row">
                                                <dt class="col-sm-3">Name/Title</dt>
                                                <dd class="col-sm-9">
                                                    {{ $item->name()}}
                                                </dd>
                                            </dl>
                                            @include('item.taxonomy')

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mx-1 mb-4">
                        <div class="card-body">
                            @include('item.properties')
                        </div>
                    </div>
                    <div class="card mx-1">
                        <div class="card-body">
                            <p>Temp: Addenda</p>
                            <p>{{ $item->addenda }}</p>
                        </div>
                    </div>
                </div>

                <style>
                    .map-responsive{
                        overflow:hidden;
                        padding-bottom:50%;
                        position:relative;
                        height:0;
                    }
                    .map-responsive iframe{
                        left:0;
                        top:0;
                        height:100%;
                        width:100%;
                        position:absolute;
                    }
                </style>

                <div class="col-md-4">
                    @include('item.description')

                    @if(!empty($item->geo_lat) && !empty($item->geo_lng))
                        <div class="card mx-1 mb-4">
                            <div class="container-fluid card">
                                <div class="row map-responsive">
                                    <iframe src="https://maps.google.com/maps?q={{ $item->geo_lat }},{{ $item->geo_lng }}&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                            frameborder="0"
                                            width="600"
                                            height="450"
                                            style="border:0" allowfullscreen
                                    >
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    @endif

                    @include('item.tree')
                </div>

                <div class="col-md-12">

                    <hr style="margin-top: 50px; width: 100%; color: grey; height: 1px; background-color:grey;" />
                    <p class="h3 text-center">Object's Images ({{ count($item->items) }})</p>

                    @include('images')
                </div>
            </div>
        </div>
    </div>
@endsection
