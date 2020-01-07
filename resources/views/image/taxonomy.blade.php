<dl class="row my-1">
    @if(count($item->objects) > 0)
    <dt class="col-sm-3">Object</dt>
    <dd class="col-sm-9">
        @foreach ($item->objects as $object)
            <a href="/{{ request()->project }}/browse/objects/{{ $object->id }}">{{ $object->name }}</a> @if(!$loop->last) | @endif
        @endforeach
    </dd>
    @endif

    @if(count($item->makers) > 0)
    <dt class="col-sm-3">Maker</dt>
    <dd class="col-sm-9">
        @foreach ($item->makers as $maker)
            @if($maker->artist->id != -1)
                <a href="/{{ request()->project }}/browse/artists/{{ $maker->artist->id }}">{{ $maker->artist->name }}</a> @if(!$loop->last), @endif
            @endif
        @endforeach
        @if($item->makersHasProfession())
            (
            @foreach ($item->makers as $maker)
                @if($maker->profession->id != -1)
                    <a href="/{{ request()->project }}/browse/professions/{{ $maker->profession->id }}">{{ $maker->profession->name }}</a> @if(!$loop->last), @endif
                @endif
            @endforeach
         )
        @endif
    </dd>
    @endif
    @if($item->creation_date)
    <dt class="col-sm-3">Date</dt>
    <dd class="col-sm-9">
        @if($item->creation_date)
            {{$item->creation_date->name}}
        @endif
    </dd>
    @endif

    @if(count($item->subjects) > 0)
    <dt class="col-sm-3">Subject</dt>
    <dd class="col-sm-9">
        @foreach ($item->subjects as $subject)
            <a href="/{{ request()->project }}/browse/subjects/{{ $subject->id }}">{{ $subject->name }}</a> @if(!$loop->last) | @endif
        @endforeach
    </dd>
    @endif

    @if(count($item->periods) > 0)
    <dt class="col-sm-3">Period</dt>
    <dd class="col-sm-9">
        @foreach ($item->periods as $period)
            <a href="/{{ request()->project }}/browse/periods/{{ $period->id }}">{{ $period->name }}</a> @if(!$loop->last) | @endif
        @endforeach
    </dd>
        @endif
        @if(count($item->origins) > 0)
    <dt class="col-sm-3">Origin</dt>
    <dd class="col-sm-9">
        @foreach ($item->origins as $origin)
            @foreach ($origin-> getAncestors() as $anc)
                <a href="/{{ request()->project }}/browse/origins/{{ $anc->id }}">{{ $anc->name }}</a> |
            @endforeach
            <a href="/{{ request()->project }}/browse/origins/{{ $origin->id }}">{{ $origin->name }}</a> @if(!$loop->last) <br/> @endif
        @endforeach
        @if($item->origin_detail()) | {{$item->origin_detail()}} @endif
    </dd>
        @endif

        @if(count($item->collections) > 0)
    <dt class="col-sm-3">Collection</dt>
    <dd class="col-sm-9">
        @foreach ($item->collections as $collection)
            @foreach ($collection-> getAncestors() as $anc)
                <a href="/{{ request()->project }}/browse/collections/{{ $anc->id }}">{{ $anc->name }}</a> |
            @endforeach
            <a href="/{{ request()->project }}/browse/collections/{{ $collection->id }}">{{ $collection->name }}</a> @if(!$loop->last) <br/> @endif
        @endforeach
        @if($item->collection_detail()) | {{$item->collection_detail()}} @endif
    </dd>
        @endif
        @if($item->copyright)
    <dt class="col-sm-3">Object Copyright</dt>
    <dd class="col-sm-9">
        @if($item->copyright)
            {{$item->copyright->name}}
        @endif
    </dd>
        @endif
        @if(count($item->communities) > 0)
    <dt class="col-sm-3">Community</dt>
    <dd class="col-sm-9">
        @foreach ($item->communities as $community)
            @foreach ($community-> getAncestors() as $comm)
                <a href="/{{ request()->project }}/browse/communities/{{ $comm->id }}">{{ $comm->name }}</a> |
            @endforeach
            <a href="/{{ request()->project }}/browse/communities/{{ $community->id }}">{{ $community->name }}</a>
            @if(!$loop->last) <br/> @endif
        @endforeach
    </dd>
        @endif
        @if(count($item->locations) > 0)
    <dt class="col-sm-3">Location</dt>
    <dd class="col-sm-9">
        @foreach ($item->locations as $location)
            @foreach ($location-> getAncestors() as $anc)
                <a href="/{{ request()->project }}/browse/origins/{{ $anc->id }}">{{ $anc->name }}</a> |
            @endforeach
            <a href="/{{ request()->project }}/browse/locations/{{ $location->id }}">{{ $location->name }}</a>
            @if(!$loop->last) <br/> @endif
        @endforeach
        @if($item->location_detail()) | {{$item->location_detail()}} @endif
    </dd>
        @endif
        @if(count($item->schools) > 0)
    <dt class="col-sm-3">School / Style</dt>
    <dd class="col-sm-9">
        @foreach ($item->schools as $school)
            <a href="/{{ request()->project }}/browse/schools/{{ $school->id }}">{{ $school->name }}</a> @if(!$loop->last) | @endif
        @endforeach
    </dd>
        @endif

</dl>
