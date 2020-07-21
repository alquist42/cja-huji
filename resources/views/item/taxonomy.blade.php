<?php
$locations = $item->getTaxonomy('locations');
$objects = $item->getTaxonomy('objects');
$makers = $item->getTaxonomy('makers');
$subjects = $item->getTaxonomy('subjects');
$periods = $item->getTaxonomy('periods');
$origins = $item->getTaxonomy('origins');
$communities = $item->getTaxonomy('communities');
$sites = $item->getTaxonomy('sites');
$collections = $item->getTaxonomy('collections');
$schools = $item->getTaxonomy('schools');
$bibliographies = $item->getTaxonomy('bibliography');


?>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="d-flex justify-content-between align-items-center">
            <span>Category</span>
            <span>{{ $item->category_object->name}}</span>
        </h5>
    </div>

    <div class="card-body">

        <ul class="list-group list-group-flush">

            @if (count($objects) > 0)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Object</span>
                    <span class="text-right">
                        @foreach ($objects as $object)
                            <a href="/{{ request()->project }}/browse/objects/{{ $object->id }}">{{ $object->name }}</a>
                            @if($object->details) <span>({{ $object->details }})</span> @endif
                            @if(!$loop->last) <br> @endif
                        @endforeach
                    </span>
                </li>
            @endif

            @if(count($makers))
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Artist/ Maker</span>
                    <span class="text-right">
                        @foreach ($makers as $maker)
                            @if($maker->artist->id != -1)
                                <a  href="/{{ request()->project }}/browse/artists/{{ $maker->artist->id }}">{{ $maker->artist->name }}</a>@if(!$loop->last), @endif
                            @endif
                        @endforeach
                        @foreach ($makers as $maker)
                            @if($maker->profession->id != -1){{ $maker->profession->name }}@if(!$loop->last), @endif
                            @endif
                        @endforeach
                        @foreach ($makers as $maker)
                            @if($maker->details) <span>({{ $maker->details }})</span> @endif
                        @endforeach
                    </span>
                </li>
            @endif

            @if (count($subjects) > 0)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Iconographic Subject</span>
                    <span class="text-right">
                        @foreach ($subjects as $subject)
                            <a href="/{{ request()->project }}/browse/subjects/{{ $subject->id }}">{{ $subject->name }}</a>
                            @if($subject->details) <span>({{ $subject->details }})</span> @endif
                            @if(!$loop->last) <br> @endif
                        @endforeach
                    </span>
                </li>
            @endif

            @if($item->creation_date)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Date</span>
                    <span class="text-right">
                        @if($item->creation_date) {{$item->creation_date->name}} @endif
                    </span>
                </li>
            @endif

            @if (count($periods) > 0)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Period</span>
                    <span class="text-right">
                        @foreach ($periods as $period)
                            <a href="/{{ request()->project }}/browse/periods/{{ $period->id }}">{{ $period->name }}</a>
                            @if($period->details) <span>({{ $period->details }})</span> @endif
                            @if(!$loop->last) <br> @endif
                        @endforeach
                    </span>
                </li>
            @endif

            @if ((count($origins) > 0))
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Origin</span>
                    <span class="text-right">
                        @foreach ($origins as $origin)
                            @foreach ($origin-> getAncestors() as $anc)
                                <a href="/{{ request()->project }}/browse/origins/{{ $anc->id }}">{{ $anc->name }}</a> <br>
                            @endforeach
                            <a href="/{{ request()->project }}/browse/origins/{{ $origin->id }}">{{ $origin->name }}</a>
                                @if($origin->details) <span>({{ $origin->details }})</span> @endif
                                @if(!$loop->last) <br/> @endif
                        @endforeach
                    </span>
                </li>
            @endif

            @if($item->copyright)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Object Copyright</span>
                    <span class="text-right">
                        @if($item->copyright){{$item->copyright->name}} @endif
                    </span>
                </li>
            @endif

            @if(count($communities))
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Community</span>
                    <span class="text-right">
                        @foreach ($communities as $community)
                            @foreach ($community-> getAncestors() as $comm)
                                <a href="/{{ request()->project }}/browse/communities/{{ $comm->id }}">{{ $comm->name }}</a> <br>
                            @endforeach
                            <a href="/{{ request()->project }}/browse/communities/{{ $community->id }}">{{ $community->name }}</a>
                            @if($community->details) <span>({{ $community->details }})</span> @endif
                            @if(!$loop->last) <br/> @endif
                        @endforeach
                    </span>
                </li>
            @endif

            @if (count($collections))
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Collection</span>
                    <span class="text-right">
                        @foreach ($collections as $collection)
                            @foreach ($collection-> getAncestors() as $anc)
                                <a href="/{{ request()->project }}/browse/collections/{{ $anc->id }}">{{ $anc->name }}</a> <br>
                            @endforeach
                            <a href="/{{ request()->project }}/browse/collections/{{ $collection->id }}">{{ $collection->name }}</a>
                            @if($collection->details) <span>({{ $collection->details }})</span> @endif
                            @if(!$loop->last) <br/> @endif
                        @endforeach
                    </span>
                </li>
            @endif

            @if (count($sites))
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Collection</span>
                    <span class="text-right">
                    @foreach ($sites as $site)
                            <a href="/{{ request()->project }}/browse/site/{{ $site->id }}">{{ $site->name }}</a>
                            @if($site->details) <span>({{ $site->details }})</span> @endif
                            @if(!$loop->last) <br> @endif
                        @endforeach
                </span>
                </li>
            @endif

            @if(count($locations) > 0)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Location</span>
                    <span class="text-right">
                        @foreach ($locations as $location)
                            @foreach ($location->getAncestors() as $anc)
                                <a href="/{{ request()->project }}/browse/locations/{{ $anc->id }}">{{ $anc->name }}</a> <br>
                            @endforeach
                            <a href="/{{ request()->project }}/browse/locations/{{ $location->id }}">{{ $location->name }}</a>
                            @if($location->details) <span>({{ $location->details }})</span> @endif
                            @if(!$loop->last) <br/> @endif
                        @endforeach

{{--                        @if($item->location_detail()) <br> {{$item->location_detail()}} @endif--}}
                    </span>
                </li>
            @endif

            @if(count($schools) > 0)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>School / Style</span>
                    <span class="text-right">
                        @foreach ($schools as $school)
                            <a href="/{{ request()->project }}/browse/schools/{{ $school->id }}">{{ $school->name }}</a>
                            @if($school->details) <span>({{ $school->details }})</span> @endif
                            @if(!$loop->last) <br> @endif
                        @endforeach

                    </span>
                </li>
            @endif
            @if (count($bibliographies))
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Bibliography</span>
                    <span class="text-right">
                @foreach ($bibliographies as $bibliography)
                            {{ $bibliography->name }}
                            @if(!$loop->last) <br> @endif
                        @endforeach
            </span>
                </li>
            @endif

            {{--Properties--}}
            @foreach ($item->properties as $property)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $property->verbose_name }}</span>
                    <span class="text-right">{!!  $property->pivot->value !!}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
