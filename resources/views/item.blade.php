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
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <div class="container">
                                        <dl class="row my-3">
                                            <dt class="col-sm-3">Name / Title</dt>
                                            <dd class="col-sm-9">{{ $item->name }}</dd>

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
                                                    <iframe src="https://maps.google.com/maps?q=Madryt&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
                                                            style="border:0" allowfullscreen></iframe>
                                                </div>
                                            </dd>

                                            <dt class="col-sm-3">School / Style</dt>
                                            <dd class="col-sm-9">
                                                @foreach ($item->schools as $school)
                                                    <a href="/{{ request()->project }}/browse/schools/{{ $school->id }}">{{ $school->name }}</a> |
                                                @endforeach
                                            </dd>

                                            <dt class="col-sm-3">Photograph Copyright</dt>
                                            <dd class="col-sm-9">Center for Jewish Art</dd>

                                            <dt class="col-sm-3">Photographer</dt>
                                            <dd class="col-sm-9"> <a href="/{{ request()->project }}/browse/photographers/123">Levin, Vladimir</a></dd>

                                            <dt class="col-sm-3">Photograph Date</dt>
                                            <dd class="col-sm-9">9.2019</dd>

                                            <dt class="col-sm-3">Negative / Photo. No.</dt>
                                            <dd class="col-sm-9">digital</dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            @forelse ($item->images as $image)
                                                <div class="carousel-item  @if($image->id === $item->images()->first()->id) {{ 'active' }} @endif">
                                                    <img class="d-block w-100" src="{{ $image->medium }}" alt="First slide">
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
                                    <dt class="col-sm-3">Temp: Sys. Number / Doc. Name</dt>
                                    <dd class="col-sm-9">{{ $item->name }}</dd>

                                    <dt class="col-sm-3">Temp: Addenda</dt>
                                    <dd class="col-sm-9">OVRPO=ntl%3Atrue%2Cntl_localname%3Atrue%2Csubject%3A%2Csubject_detail%3A%2Cobject%3Atrue%2Cobject_detail%3A%2Cmaker_profession%3Atrue%2Cmaker_name%3Atrue%2Cmaker_detail%3Atrue%2Cdate%3Atrue%2Cperiod%3Atrue%2Cperiod_detail%3Atrue%2Cphotographer%3A%2Cphoto_date%3A%2Cphotographer_copyright%3A%2Corigin%3Atrue%2Corigin_detail%3Atrue%2Chistorical_origin%3Atrue%2Cschool%3Atrue%2Cschool_detail%3Atrue%2Ccommunity%3Atrue%2Ccommunity_detail%3Atrue%2Ccollection%3Atrue%2Ccollection_detail%3Atrue%2Ccopyright%3Atrue%2Csite%3Atrue%2Csite_detail%3Atrue%2Clocation%3Atrue%2Clocation_detail%3Atrue%2Cdescription%3A%2C&</dd>
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
                                        <img src="http://placeimg.com/640/480/arch.jpg" alt="Snow" style="width:100%;">
                                        <div class="centered">
                                            <a href="/{{ request()->project }}/items/{{ $subitem->id }}">{{ $subitem->name }}</a>
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
