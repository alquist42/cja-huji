<div class="container">
    @forelse ($item->items as $obj)
        <div class="row mt-5">
            <div class="card bg-light mx-1">
                <div class="card-header" data-toggle="collapses" data-target="#collapseExample{{ $obj->id }}" aria-expanded="false" aria-controls="collapseExample{{ $obj->id }}">
                    {{ $obj->ntl }}
                </div>
                <div class="container collapses" id="collapseExample{{ $obj->id }}">
                    <div class="row mt-5">
                        <div class="col-md-8">
                            <div class="container">
                                <h4 class="lead">Taxonomy</h4>
                                <dl class="row my-3">
                                    <dt class="col-sm-4">Object</dt>
                                    <dd class="col-sm-8">
                                        @if(!$obj->objects)
                                            @foreach ($obj->objects as $object)

                                                <a href="/{{ request()->project }}/browse/objects/{{ $object->id }}">{{ $object->name }}</a> @if(!$loop->last) | @endif
                                            @endforeach
                                        @else
                                            @foreach ($item->objects as $object)
                                                <a href="/{{ request()->project }}/browse/objects/{{ $object->id }}">{{ $object->name }}</a> @if(!$loop->last) | @endif
                                            @endforeach
                                        @endif
                                    </dd>

                                    <dt class="col-sm-4">Date</dt>
                                    <dd class="col-sm-8">1896</dd>

                                    <dt class="col-sm-4">Subject</dt>
                                    <dd class="col-sm-8">
                                        @if(!$obj->subjects)
                                            @foreach ($obj->subjects as $subject)
                                                <a href="/{{ request()->project }}/browse/subjects/{{ $subject->id }}">{{ $subject->name }}</a> @if(!$loop->last) | @endif
                                            @endforeach
                                        @else
                                            @foreach ($item->subjects as $subject)
                                                <a href="/{{ request()->project }}/browse/subjects/{{ $subject->id }}">{{ $subject->name }}</a> @if(!$loop->last) | @endif
                                            @endforeach
                                        @endif

                                    </dd>

                                    <dt class="col-sm-4">Origin</dt>
                                    <dd class="col-sm-8">
                                        @if(!$obj->origins)
                                            @foreach ($obj->origins as $origin)
                                                <a href="/{{ request()->project }}/browse/origins/{{ $origin->id }}">{{ $origin->name }}</a> @if(!$loop->last) | @endif
                                            @endforeach
                                        @else
                                            @foreach ($item->origins as $origin)
                                                <a href="/{{ request()->project }}/browse/origins/{{ $origin->id }}">{{ $origin->name }}</a> @if(!$loop->last) | @endif
                                            @endforeach
                                        @endif

                                    </dd>

                                    <dt class="col-sm-4">Collection</dt>
                                    <dd class="col-sm-8">
                                        @if(!$obj->collections)
                                            @foreach ($obj->collections as $collection)
                                                <a href="/{{ request()->project }}/browse/collections/{{ $collection->id }}">{{ $collection->name }}</a> @if(!$loop->last) | @endif
                                            @endforeach
                                        @else
                                            @foreach ($item->collections as $collection)
                                                <a href="/{{ request()->project }}/browse/collections/{{ $collection->id }}">{{ $collection->name }}</a> @if(!$loop->last) | @endif
                                            @endforeach
                                        @endif
                                    </dd>

                                    <dt class="col-sm-4">Community</dt>
                                    <dd class="col-sm-8">
                                        @if(!$obj->communities)
                                            @foreach ($obj->communities as $community)
                                                <a href="/{{ request()->project }}/browse/communities/{{ $community->id }}">{{ $community->name }}</a> @if(!$loop->last) | @endif
                                            @endforeach
                                        @else
                                            @foreach ($item->communities as $community)
                                                <a href="/{{ request()->project }}/browse/communities/{{ $community->id }}">{{ $community->name }}</a> @if(!$loop->last) | @endif
                                            @endforeach
                                        @endif

                                    <dt class="col-sm-4">Location</dt>
                                    <dd class="col-sm-8">
                                        @if(!$obj->locations)
                                            @foreach ($obj->locations as $location)
                                                <a href="/{{ request()->project }}/browse/locations/{{ $location->id }}">{{ $location->name }}</a> @if(!$loop->last) | @endif
                                            @endforeach
                                        @else
                                            @foreach ($item->locations as $location)
                                                <a href="/{{ request()->project }}/browse/locations/{{ $location->id }}">{{ $location->name }}</a> @if(!$loop->last) | @endif
                                            @endforeach
                                        @endif

                                    </dd>

                                    <dt class="col-sm-4">School / Style</dt>
                                    <dd class="col-sm-8">
                                        @if(!$obj->schools)
                                            @foreach ($obj->schools as $school)
                                                <a href="/{{ request()->project }}/browse/schools/{{ $school->id }}">{{ $school->name }}</a> @if(!$loop->last) | @endif
                                            @endforeach
                                        @else
                                            @foreach ($item->schools as $school)
                                                <a href="/{{ request()->project }}/browse/schools/{{ $school->id }}">{{ $school->name }}</a> @if(!$loop->last) | @endif
                                            @endforeach
                                        @endif

                                    </dd>

                                    @if(!empty($obj->images[0]->copyright))
                                        <dt class="col-sm-4">Photograph Copyright</dt>
                                        <dd class="col-sm-8">{{ $item->images[0]->copyright->name }}</dd>
                                    @endif

                                    <dt class="col-sm-4">Photographer</dt>

                                    <dd class="col-sm-8">
                                        @foreach ($obj->images[0]->photographers as $photographer)
                                            <a href="/{{ request()->project }}/browse/photographers/{{ $photographer->id }}">{{ $photographer->name }}</a> @if(!$loop->last) | @endif
                                        @endforeach
                                    </dd>

                                    <dt class="col-sm-4">Photograph Date</dt>
                                    <dd class="col-sm-8">{{ $obj->images[0]->date }}</dd>

                                    <dt class="col-sm-4">Negative / Photo. No.</dt>
                                    <dd class="col-sm-8">{{ $obj->images[0]->negative }}</dd>
                                </dl>

                                <h4 class="mt-5 lead" data-toggle="collapses" data-target="#multiCollapseExample2" aria-expanded="true" aria-controls="multiCollapseExample2">Properties</h4>
                                <div class="collapses multi-collapse" id="multiCollapseExample2">
                                    <dl class="row my-1">
                                        @foreach ($obj->properties as $property)
                                            <dt class="col-sm-3">{{ $property->verbose_name }}</dt>
                                            <dd class="col-sm-9">{{ $property->pivot->value }}</dd>
                                        @endforeach
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img class="card-img-top img-fluid img-thumbnail" src="http://cja.huji.ac.il/{{ $obj->images[0]->url() }}" alt="Card image cap">
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
