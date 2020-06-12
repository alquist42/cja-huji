@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            Obj. ID: {{ $item->id }} {{ $item->name() }}
                            @if($item->object_detail()), {{$item->object_detail()}} @endif
                            @foreach ($item->origins as $origin), {{ $origin->name }}
                            @endforeach
                            @if($item->origin_detail()) | {{$item->origin_detail()}} @endif
                            @if($item->creation_date), {{$item->creation_date->name}} @endif
                        </div>

                        @include('item.image')
                    </div>

                    @if($item->addenda())
                        <div class="card mt-4">
                            <div class="card-body small">
                                <p>Temp: Addenda</p>
                                <?php
                                    parse_str(urldecode($item->addenda()), $out);
                                ?>
                                <p>{{ $out }}</p>
                            </div>
                        </div>
                    @endif

                    @if(count($item->items()))
                        <h3 class="text-center mt-5">Related Items ({{ count($item->items()) }})</h3>
                        @include('images')
                    @endif
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

                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">

                    @include('item.taxonomy')

                    @if(!empty($item->description))
                        @include('item.description')
                    @endif

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
            </div>
        </div>
    </div>
@endsection
