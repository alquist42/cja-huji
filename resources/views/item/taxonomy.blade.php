<div class="card mb-4">
    <div class="card-header">
        <h5 class="d-flex justify-content-between align-items-center">
            <span>Category</span>
            <span>{{ $item->category_object->name}}</span>
        </h5>
    </div>

    <div class="card-body">

        <ul class="list-group list-group-flush">

            @if ((count($item->getObjects()) > 0) || $item->object_detail())
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Object</span>
                    <span class="text-right">
                        @foreach ($item->getObjects() as $object)
                            <a href="/{{ request()->project }}/browse/objects/{{ $object->id }}">{{ $object->name }}</a> @if(!$loop->last) <br> @endif
                        @endforeach
                        @if($item->object_detail()) <br> {{$item->object_detail()}} @endif
                    </span>
                </li>
            @endif

            @if((count($item->getMakers()) > 0) || $item->maker_detail())
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Artist/ Maker</span>
                    <span class="text-right">
                        @foreach ($item->getMakers() as $maker)
                            @if($maker->artist->id != -1)
                                <a class="text-white" href="/{{ request()->project }}/browse/artists/{{ $maker->artist->id }}">{{ $maker->artist->name }}</a> @if(!$loop->last), @endif
                            @endif
                        @endforeach
                        @if($item->makersHasProfession())
                            @foreach ($item->makers as $maker)
                                @if($maker->profession->id != -1)
                                    <a class="text-white" href="/{{ request()->project }}/browse/professions/{{ $maker->profession->id }}">{{ $maker->profession->name }}</a> @if(!$loop->last), @endif
                                @endif
                            @endforeach
                        @endif
                        @if($item->maker_detail()) <br> {{$item->maker_detail()}} @endif
                    </span>
                </li>
            @endif

            @if ((count($item->getSubjects()) > 0) || $item->subject_detail())
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Iconographic Subject</span>
                    <span class="text-right">
                        @foreach ($item->getSubjects() as $subject)
                            <a href="/{{ request()->project }}/browse/subjects/{{ $subject->id }}">{{ $subject->name }}</a> @if(!$loop->last) <br> @endif
                        @endforeach
                        @if($item->subject_detail()) <br> {{$item->subject_detail()}} @endif
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

            @if (count($item->getPeriods()) > 0 || $item->period_detail())
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Period</span>
                    <span class="text-right">
                        @foreach ($item->getPeriods() as $period)
                            <a href="/{{ request()->project }}/browse/periods/{{ $period->id }}">{{ $period->name }}</a> @if(!$loop->last) <br> @endif
                        @endforeach
                        @if($item->period_detail()) <br> {{$item->period_detail()}} @endif
                    </span>
                </li>
            @endif

            @if ((count($item->getOrigins()) > 0) || $item->origin_detail())
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Origin</span>
                    <span class="text-right">
                        @foreach ($item->getOrigins() as $origin)
                            @foreach ($origin-> getAncestors() as $anc)
                                <a href="/{{ request()->project }}/browse/origins/{{ $anc->id }}">{{ $anc->name }}</a> <br>
                            @endforeach
                            <a href="/{{ request()->project }}/browse/origins/{{ $origin->id }}">{{ $origin->name }}</a> @if(!$loop->last) <br/> @endif
                        @endforeach
                        @if($item->origin_detail()) <br> {{$item->origin_detail()}} @endif
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

            @if(count($item->getCommunities()) > 0)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Community</span>
                    <span class="text-right">
                        @foreach ($item->getCommunities() as $community)
                            @foreach ($community-> getAncestors() as $comm)
                                <a href="/{{ request()->project }}/browse/communities/{{ $comm->id }}">{{ $comm->name }}</a> <br>
                            @endforeach
                            <a href="/{{ request()->project }}/browse/communities/{{ $community->id }}">{{ $community->name }}</a>
                            @if(!$loop->last) <br/> @endif
                        @endforeach
                        @if($item->community_detail()) <br> {{$item->community_detail()}} @endif
                    </span>
                </li>
            @endif

            @if (count($item->getCollections()) > 0 || $item->collection_detail())
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Collection</span>
                    <span class="text-right">
                        @foreach ($item->getCollections() as $collection)
                            @foreach ($collection-> getAncestors() as $anc)
                                <a href="/{{ request()->project }}/browse/collections/{{ $anc->id }}">{{ $anc->name }}</a> <br>
                            @endforeach
                            <a href="/{{ request()->project }}/browse/collections/{{ $collection->id }}">{{ $collection->name }}</a> @if(!$loop->last) <br/> @endif
                        @endforeach
                        @if($item->collection_detail()) <br> {{$item->collection_detail()}} @endif
                    </span>
                </li>
            @endif

            @if(count($item->getLocations()) > 0)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Location</span>
                    <span class="text-right">
                        @foreach ($item->getLocations() as $location)
                            @foreach ($location-> getAncestors() as $anc)
                                <a href="/{{ request()->project }}/browse/origins/{{ $anc->id }}">{{ $anc->name }}</a> <br>
                            @endforeach
                            <a href="/{{ request()->project }}/browse/locations/{{ $location->id }}">{{ $location->name }}</a>
                            @if(!$loop->last) <br/> @endif
                        @endforeach
                        @if($item->location_detail()) <br> {{$item->location_detail()}} @endif
                    </span>
                </li>
            @endif

            @if(count($item->getSchools()) > 0)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>School / Style</span>
                    <span class="text-right">
                        @foreach ($item->getSchools() as $school)
                            <a href="/{{ request()->project }}/browse/schools/{{ $school->id }}">{{ $school->name }}</a> @if(!$loop->last) <br> @endif
                        @endforeach
                        @if($item->school_detail()) <br> {{$item->school_detail()}} @endif
                    </span>
                </li>
            @endif
        </ul>

        {{--Properties--}}
        @foreach ($item->properties as $property)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{ $property->verbose_name }}</span>
                <span class="text-right">{!!  $property->pivot->value !!}</span>
            </li>
        @endforeach
    </div>
</div>