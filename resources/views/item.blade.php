@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-md-8">
                    <div class="card mx-1">
                        <div class="card-header">
                            {{ $item->name() }}
                        </div>
                        <div class="container">
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="container">
                                        <h4 class="lead"><u>Taxonomy</u></h4>
                                        <dl class="row my-1">
                                            <dt class="col-sm-3">Object</dt>
                                            <dd class="col-sm-9">
                                                @foreach ($item->objects as $object)
                                                    <a href="/{{ request()->project }}/browse/objects/{{ $object->id }}">{{ $object->name }}</a> @if(!$loop->last) | @endif
                                                @endforeach
                                            </dd>

                                            <dt class="col-sm-3">Date</dt>
                                            <dd class="col-sm-9">{{ $item->date }}</dd>

                                            <dt class="col-sm-3">Subject</dt>
                                            <dd class="col-sm-9">
                                                @foreach ($item->subjects as $subject)
                                                    <a href="/{{ request()->project }}/browse/subjects/{{ $subject->id }}">{{ $subject->name }}</a> @if(!$loop->last) | @endif
                                                @endforeach
                                            </dd>

                                            <dt class="col-sm-3">Period</dt>
                                            <dd class="col-sm-9">
                                                @foreach ($item->periods as $period)
                                                    <a href="/{{ request()->project }}/browse/periods/{{ $period->id }}">{{ $period->name }}</a> @if(!$loop->last) | @endif
                                                @endforeach
                                            </dd>
                                            <dt class="col-sm-3">Origin</dt>
                                            <dd class="col-sm-9">
                                                @foreach ($item->origins as $origin)
                                                    @foreach ($origin-> getAncestors() as $anc)
                                                        <a href="/{{ request()->project }}/browse/origins/{{ $anc->id }}">{{ $anc->name }}</a>
                                                         |
                                                    @endforeach
                                                    <a href="/{{ request()->project }}/browse/origins/{{ $origin->id }}">{{ $origin->name }}</a> @if(!$loop->last) | @endif
                                                @endforeach
                                                    @if($item->origin_detail()) | {{$item->origin_detail()}} @endif
                                            </dd>



                                            <dt class="col-sm-3">Collection</dt>
                                            <dd class="col-sm-9">
                                                @foreach ($item->collections as $collection)
                                                    <a href="/{{ request()->project }}/browse/collections/{{ $collection->id }}">{{ $collection->name }}</a> @if(!$loop->last) | @endif
                                                @endforeach
                                            </dd>

                                            <dt class="col-sm-3">Community</dt>
                                            <dd class="col-sm-9">
                                                @foreach ($item->communities as $community)
                                                    <a href="/{{ request()->project }}/browse/communities/{{ $community->id }}">{{ $community->name }}</a> @if(!$loop->last) | @endif
                                                @endforeach
                                            </dd>

                                            <dt class="col-sm-3">School / Style</dt>
                                            <dd class="col-sm-9">
                                                @foreach ($item->schools as $school)
                                                    <a href="/{{ request()->project }}/browse/schools/{{ $school->id }}">{{ $school->name }}</a> @if(!$loop->last) | @endif
                                                @endforeach
                                            </dd>

                                            <dt class="col-sm-3">Location</dt>
                                            <dd class="col-sm-9">
                                                @foreach ($item->locations as $location)
                                                    @foreach ($location-> getAncestors() as $anc)
                                                        <a href="/{{ request()->project }}/browse/origins/{{ $anc->id }}">{{ $anc->name }}</a>
                                                        |
                                                    @endforeach
                                                    <a href="/{{ request()->project }}/browse/locations/{{ $location->id }}">{{ $location->name }}</a> @if(!$loop->last) | @endif
                                                @endforeach
                                            </dd>
                                            @if(!empty($item->geo_lat) && !empty($item->geo_lng))
                                            <!--Google map-->
                                                <div id="map-container-google-9" class="z-depth-1-half map-container-5" style="height: 130px">
                                                    <iframe src="https://maps.google.com/maps?q={{ $item->geo_lat }},{{ $item->geo_lng }}&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
                                                            style="border:0" allowfullscreen></iframe>
                                                </div>
                                            @endif

                                        </dl>
                                        <h4 class="mt-5 lead"><u>Photo / Image</u></h4>
                                        <dl class="row my-1">
                                            <dt class="col-sm-3">Copyright</dt>
                                            <dd class="col-sm-9">{{ array_get($item->images,'0.copyright.name') }}</dd>

                                            <dt class="col-sm-3">Photographer</dt>

                                            <dd class="col-sm-9">
                                                @foreach (array_get($item->images,'0.photographers', []) as $photographer)
                                                    <a href="/{{ request()->project }}/browse/photographers/{{ $photographer->id }}">{{ $photographer->name }}</a> @if(!$loop->last) | @endif
                                                @endforeach
                                            </dd>

                                            <dt class="col-sm-3">Date</dt>
                                            <dd class="col-sm-9">{{ array_get($item->images,'0.date') }}</dd>

                                            <dt class="col-sm-3">Negative / Photo. No.</dt>
                                            <dd class="col-sm-9">{{ array_get($item->images,'0.negative') }}</dd>
                                        </dl>
                                        <h4 class="mt-5 lead" data-toggle="collapses" data-target="#multiCollapseExample2" aria-expanded="true" aria-controls="multiCollapseExample2"><u>Properties</u></h4>
                                        <div class="collapses multi-collapse" id="multiCollapseExample2">
                                            <dl class="row my-1">
                                                @foreach ($item->properties as $property)
                                                    <dt class="col-sm-3">{{ $property->verbose_name }}</dt>
                                                    <dd class="col-sm-9">{{ $property->pivot->value }}</dd>
                                                @endforeach
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            @forelse ($item->images as $image)
                                                <div class="carousel-item  @if($image->id === $item->images[0]->id) {{ 'active' }} @endif">
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
                    <div class="card mx-1 mb-4">
                        <div class="card-header">
                            Description
                        </div>
                        <div class="card-body">
                            {!! preg_replace_callback("/\/\/\/ID\/(\d{1,9})\//", function ($matches) { return view('partials.thumb', [ 'id' => $matches[1]])->render(); }, $item->description) !!}
                        </div>
                    </div>
{{--                    <div class="card mx-1 mb-4">--}}
{{--                        <div class="card-header">--}}
{{--                            Child Items--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="row">--}}
{{--                            @foreach ($item->children as $subitem)--}}

{{--                                    <div class="col-6 my-2">--}}
{{--                                        <div class="card">--}}
{{--                                            <img class="card-img-top image-fluid" src="http://cja.huji.ac.il/{{ $subitem->images[0]->url() }}" alt=" {{ $subitem->name() }}">--}}
{{--                                            <div class="card-body">--}}
{{--                                                <h5 class="card-title text-truncate">--}}
{{--                                                    <a href="/{{ request()->project }}/items/{{ $subitem->id }}">--}}
{{--                                                        {{ $subitem->name() }}--}}
{{--                                                    </a>--}}
{{--                                                </h5>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                            @endforeach--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="card mx-1 mb-4">
                        <div class="card-header">
                            Item Tree
                        </div>
                        <div class="card-body">
                            @php
                                $nodes = $item->leaf();

                                $traverse = function ($categories, $prefix = '<li>', $suffix = '</li>') use (&$traverse, $item) {
                                    foreach ($categories as $category) {
                                        $me = $category->id === $item->id ? '[ME] ' : '';
                                        echo $prefix.'<a href="/'.request()->project.'/items/'.$category->id.'">'.$me.$category->name().'</a>'.$suffix;

                                        $hasChildren = (count($category->children) > 0);

                                        if($hasChildren) {
                                            echo('<ul>');
                                        }

                                        $traverse($category->children);

                                        if($hasChildren) {
                                            echo('</ul>');
                                        }
                                    }
                                };

                                $traverse($nodes);
                            @endphp
                        </div>
                    </div>
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
