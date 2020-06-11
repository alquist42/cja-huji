<div class="container">
    @forelse ($item->items() as $obj)
        <div class="row mt-5">
            <div class="card mx-1">
                <div class="card-header" data-toggle="collapses" data-target="#collapseExample{{ $obj->id }}" aria-expanded="false" aria-controls="collapseExample{{ $obj->id }}">
                    <a href="/{{ $obj->url() }}">ID: {{ $obj->id }} {{ $obj->ntl }}</a>
                </div>
                <div class="container collapses" id="collapseExample{{ $obj->id }}">
                    <div class="row mt-5">
                        {{--<div class="col-md-8">
                            <div class="container">
                                <dl class="row my-3">

                                    @if(count($obj->getObjects()))
                                        <dt class="col-sm-4">Object</dt>
                                        <dd class="col-sm-8">
                                            @foreach ($obj->getObjects() as $object)
                                                <a href="/{{ request()->project }}/browse/objects/{{ $object->id }}">{{ $object->name }}</a> @if(!$loop->last) | @endif
                                            @endforeach
                                        </dd>
                                    @endif

                                    @if(count($obj->getMakers()))
                                        <dt class="col-sm-4">Artist/ Maker</dt>
                                        <dd class="col-sm-8">
                                            @foreach ($obj->getMakers() as $maker)
                                                @if($maker->artist->id != -1)
                                                    <a href="/{{ request()->project }}/browse/artists/{{ $maker->artist->id }}">{{ $maker->artist->name }}</a> @if(!$loop->last), @endif
                                                @endif
                                            @endforeach
                                            @if($obj->makersHasProfession())
                                                (
                                                @foreach ($obj->getMakers() as $maker)
                                                    @if($maker->profession->id != -1)
                                                        <a href="/{{ request()->project }}/browse/professions/{{ $maker->profession->id }}">{{ $maker->profession->name }}</a> @if(!$loop->last), @endif
                                                    @endif
                                                @endforeach
                                             )
                                            @endif
                                        </dd>
                                    @endif


                                    @if($obj->creation_date || $item->creation_date)
                                        <dt class="col-sm-4">Date</dt>
                                        <dd class="col-sm-8">
                                            @if($obj->creation_date)
                                                {{$obj->creation_date->name}}
                                            @else
                                                {{$item->creation_date->name}}
                                            @endif
                                        </dd>
                                    @endif

                                    @if(count($obj->getSubjects()))
                                        <dt class="col-sm-4">Subject</dt>
                                        <dd class="col-sm-8">
                                            @foreach ($obj->getSubjects() as $subject)
                                                <a href="/{{ request()->project }}/browse/subjects/{{ $subject->id }}">{{ $subject->name }}</a> @if(!$loop->last) | @endif
                                            @endforeach
                                        </dd>
                                    @endif

                                        @if(count($obj->getOrigins()))
                                            <dt class="col-sm-4">Origin</dt>
                                            <dd class="col-sm-8">
                                                @foreach ($obj->getOrigins() as $origin)
                                                    <a href="/{{ request()->project }}/browse/origins/{{ $origin->id }}">{{ $origin->name }}</a> @if(!$loop->last) | @endif
                                                @endforeach
                                            </dd>
                                        @endif

                                        @if(count($obj->getCollections()))
                                            <dt class="col-sm-4">Collection</dt>
                                            <dd class="col-sm-8">
                                                @foreach ($obj->getCollections() as $collection)
                                                    <a href="/{{ request()->project }}/browse/collections/{{ $collection->id }}">{{ $collection->name }}</a> @if(!$loop->last) | @endif
                                                @endforeach
                                            </dd>
                                        @endif

                                        @if(count($obj->getCommunities()))
                                            <dt class="col-sm-4">Community</dt>
                                            <dd class="col-sm-8">
                                                @foreach ($obj->getCommunities() as $community)
                                                    <a href="/{{ request()->project }}/browse/communities/{{ $community->id }}">{{ $community->name }}</a> @if(!$loop->last) | @endif
                                                @endforeach
                                            </dd>
                                        @endif

                                        @if(count($obj->getLocations()))
                                            <dt class="col-sm-4">Location</dt>
                                            <dd class="col-sm-8">
                                                @foreach ($obj->getLocations() as $location)
                                                    <a href="/{{ request()->project }}/browse/locations/{{ $location->id }}">{{ $location->name }}</a> @if(!$loop->last) | @endif
                                                @endforeach
                                            </dd>
                                        @endif

                                        @if(count($obj->getScools()))
                                            <dt class="col-sm-4">School / Style</dt>
                                            <dd class="col-sm-8">
                                                @foreach ($obj->getScools() as $school)
                                                    <a href="/{{ request()->project }}/browse/schools/{{ $school->id }}">{{ $school->name }}</a> @if(!$loop->last) | @endif
                                                @endforeach
                                            </dd>
                                        @endif

                                </dl>

                                <div class="collapses multi-collapse" id="multiCollapseExample2">
                                    <dl class="row my-1">
                                        @foreach ($obj->properties as $property)
                                            <dt class="col-sm-3">{{ $property->verbose_name }}</dt>
                                            <dd class="col-sm-9">{!! $property->pivot->value !!}</dd>
                                        @endforeach
                                    </dl>
                                </div>
                            </div>
                        </div>--}}
                        <div class="col-md-4">
                            @if (!empty($obj->images[0]))
                                <a href="/{{ $obj->url() }}">
                                    <img class="card-img-top img-fluid img-thumbnail preview" src="http://cja.huji.ac.il/{{ $obj->images[0]->url() }}" alt="Card image cap">
                                </a>
                            @endif
                            <dl class="row my-1">
                                <dt class="col-sm-4">Photograph Copyright</dt>
                                <dd class="col-sm-8">{{ array_get($item->images,'0.copyright.name') }}</dd>

                                <dt class="col-sm-4">Photographer</dt>

                                <dd class="col-sm-8">
                                    @foreach (array_get($item->images,'0.photographers',[]) as $photographer)
                                        <a href="/{{ request()->project }}/browse/photographers/{{ $photographer->id }}">{{ $photographer->name }}</a> @if(!$loop->last) | @endif
                                    @endforeach
                                </dd>

                                <dt class="col-sm-4">Photograph Date</dt>
                                <dd class="col-sm-8">{{ array_get($item->images,'0.date') }}</dd>

                                <dt class="col-sm-4">Negative / Photo. No.</dt>
                                <dd class="col-sm-8">{{ array_get($item->images,'0.negative') }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="panel panel-default">
            <div class="panel-heading">Not Found!!</div>

            <div class="panel-body">
                <p>Sorry! No images found for this object.</p>
            </div>
        </div>
    @endforelse

</div>
