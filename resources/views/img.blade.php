@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-md-7">
                    <div class="card mx-1 mb-4">
                        <div class="card-header">
                            {{ $item->name() }}
                        </div>
                        <div class="container">
                            <div class="row mt-2">

                                <div class="col-md-12">
                                    <dl class="row my-1">
                                        <dt class="col-sm-3 lead">Category</dt>
                                        <dd class="col-sm-9 lead">
                                            {{ $item->category_object->name}}
                                        </dd>
                                    </dl>
                                    @include('item.image')
                                    @include('item.image-details')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mx-1 mb-4">
                        <div class="card-body">
                            @include('item.properties')
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

                    .middle {
                        transition: .5s ease;
                        opacity: 0;
                        position: absolute;
                        bottom: 0;
                        left: 50%;
                        width: 100%;
                        height: 40px;
                        transform: translate(-50%, -50%);
                        -ms-transform: translate(-50%, -50%);
                        text-align: center;
                        background-color: #ffffff;
                    }

                    /*.card:hover .image-fluid {*/
                    /*    opacity: 0.3;*/
                    /*}*/

                    .card:hover .middle {
                        opacity: 1;
                    }

                    .text {
                        background-color: #4CAF50;
                        color: white;
                        font-size: 16px;
                        padding: 16px 32px;
                    }
                </style>

                <div class="col-md-5">
                    <div class="card mx-1 mb-4">
                        <div class="card-header">
                            Description
                        </div>
                        <div class="card-body">
                            <dl class="row my-1">
                                <dt class="col-sm-3 lead">Parent</dt>
                                <dd class="col-sm-9 lead">
                                    <a href="/{{ request()->project }}/items/{{ $item->set->id }}">{{ $item->set->name() }}</a>
                                </dd>
                            </dl>
                            @include('image.taxonomy')
                        </div>
                    </div>

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
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row mt-5 images-gallery">
                @forelse ($item->set->items as $sibling)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mb-4">
                            <div class="card">
                                <img class="card-img-top image-fluid" src="{{ $sibling->image_url() }}-original.png" alt=" {{ $sibling->name() }}">
                                <div class="middle">
                                    <div><a href="/{{ request()->project }}/images/{{ $sibling->id }}">{{ $sibling->name() }} (id: {{ $sibling->id }})</a></div>
                                </div>
                            </div>
                    </div>
                @empty
                    <div></div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
