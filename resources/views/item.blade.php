@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-md-8">
                    <div class="card mx-1">
                        <div class="card-header">
                            {{ $item->name }}
                        </div>
                        <div class="container">
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="container">
                                        <dl class="row my-1">
                                            <dt class="col-sm-3">Object</dt>
                                            <dd class="col-sm-9">
                                                @foreach ($item->objects as $object)
                                                    <a href="/{{ request()->project }}/browse/objects/{{ $object->id }}">{{ $object->name }}</a> |
                                                @endforeach
                                            </dd>

                                            <dt class="col-sm-3">Date</dt>
                                            <dd class="col-sm-9">1896</dd>

                                            <dt class="col-sm-3">Subject</dt>
                                            <dd class="col-sm-9">
                                                @foreach ($item->subjects as $subject)
                                                    <a href="/{{ request()->project }}/browse/subjects/{{ $subject->id }}">{{ $subject->name }}</a> |
                                                @endforeach
                                            </dd>

                                            <dt class="col-sm-3">Origin</dt>
                                            <dd class="col-sm-9">
                                                @foreach ($item->origins as $origin)
                                                    <a href="/{{ request()->project }}/browse/origins/{{ $origin->id }}">{{ $origin->name }}</a> |
                                                @endforeach
                                            </dd>

                                            <dt class="col-sm-3">Location</dt>
                                            <dd class="col-sm-9">
                                                @foreach ($item->locations as $location)
                                                    <a href="/{{ request()->project }}/browse/locations/{{ $location->id }}">{{ $location->name }}</a> |
                                                @endforeach

                                                <!--Google map-->
                                                <div id="map-container-google-9" class="z-depth-1-half map-container-5" style="height: 300px">
                                                    <iframe src="https://maps.google.com/maps?q={{ $item->geo_lat }},{{ $item->geo_lng }}&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
                                                            style="border:0" allowfullscreen></iframe>
                                                </div>
                                            </dd>

                                            <dt class="col-sm-3">School / Style</dt>
                                            <dd class="col-sm-9">
                                                @foreach ($item->schools as $school)
                                                    <a href="/{{ request()->project }}/browse/schools/{{ $school->id }}">{{ $school->name }}</a> |
                                                @endforeach
                                            </dd>

                                            @if(!empty($item->images()->first()->copyright))
                                                <dt class="col-sm-3">Photograph Copyright</dt>
                                                <dd class="col-sm-9">{{ $item->images()->first()->copyright->name }}</dd>
                                            @endif

                                            <dt class="col-sm-3">Photographer</dt>

                                            <dd class="col-sm-9">
                                                @foreach ($item->images()->first()->photographers as $photographer)
                                                    <a href="/{{ request()->project }}/browse/photographers/{{ $photographer->id }}">{{ $photographer->name }}</a> |
                                                @endforeach
                                            </dd>

                                            <dt class="col-sm-3">Photograph Date</dt>
                                            <dd class="col-sm-9">{{ $item->images()->first()->date }}</dd>

                                            <dt class="col-sm-3">Negative / Photo. No.</dt>
                                            <dd class="col-sm-9">{{ $item->images()->first()->negative }}</dd>
                                        </dl>
                                        <h4>Properties:</h4>
                                        <dl>
                                            @foreach ($item->properties as $property)
                                                <dt class="col-sm-3">{{ $property->verbose_name }}</dt>
                                                <dd class="col-sm-9">{{ $property->pivot->value }}</dd>
                                            @endforeach
                                        </dl>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            @forelse ($item->images as $image)
                                                <div class="carousel-item  @if($image->id === $item->images()->first()->id) {{ 'active' }} @endif">
                                                    <img class="d-block w-100" src="http://cja.huji.ac.il/{{ $image->url() }}" alt="First slide">
                                                </div>
                                            @empty
                                                <div></div>
                                            @endforelse
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <dt class="col-sm-3">Temp: Addenda</dt>
                                    <dd class="col-sm-9">{{ $item->addenda }}</dd>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mx-1">
                        <div class="card-header">
                            Child Items
                        </div>
                        <div class="row">
                        @foreach ($item->children as $subitem)

                                <div class="col-4 my-2">
                                    <div class="container-fluid card">
                                        <img src="http://cja.huji.ac.il/{{ $subitem->images()->first()->url() }}" alt="Snow" style="width:100%;">
                                        <div class="centered">
                                            <a href="/{{ request()->project }}/items/{{ $subitem->id }}">{{ $subitem->ntl }}</a>
                                        </div>
                                    </div>
                                </div>



{{--                            <div class="col-12 mb-4">--}}

{{--                                <div class="card">--}}
{{--                                    <img class="card-img-top image-fluid" src="http://placeimg.com/640/480/arch" alt="Card image cap">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <h5 class="card-title text-truncate">--}}
{{--                                            <a href="/{{ request()->project }}/items/{{ $subitem->id }}">--}}
{{--                                                {{ $subitem->name }}--}}
{{--                                            </a>--}}
{{--                                        </h5>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr style="margin-top: 50px; width: 100%; color: blue; height: 1px; background-color:blue;" />
                    <p class="h3 text-center">Object's Images</p>

                    @include('images')
                </div>
            </div>
        </div>
    </div>
@endsection
