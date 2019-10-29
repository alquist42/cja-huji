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
                                <dl class="row my-3">
                                    <dt class="col-sm-4">Object</dt>
                                    <dd class="col-sm-8">
                                        @if(!empty($obj->objects))
                                            @foreach ($obj->objects as $object)
                                                <a href="/{{ request()->project }}/browse/objects/{{ $object->id }}">{{ $object->name }}</a> |
                                            @endforeach
                                        @else
                                            @foreach ($item->objects as $object)
                                                <a href="/{{ request()->project }}/browse/objects/{{ $object->id }}">{{ $object->name }}</a> |
                                            @endforeach
                                        @endif
                                    </dd>

                                    <dt class="col-sm-4">Date</dt>
                                    <dd class="col-sm-8">1896</dd>

                                    <dt class="col-sm-4">Subject</dt>
                                    <dd class="col-sm-8">
                                        @foreach ($obj->subjects as $subject)
                                            <a href="/{{ request()->project }}/browse/subjects/{{ $subject->id }}">{{ $subject->name }}</a> |
                                        @endforeach
                                    </dd>

                                    <dt class="col-sm-4">Origin</dt>
                                    <dd class="col-sm-8">
                                        @foreach ($obj->origins as $origin)
                                            <a href="/{{ request()->project }}/browse/origins/{{ $origin->id }}">{{ $origin->name }}</a> |
                                        @endforeach
                                    </dd>

                                    <dt class="col-sm-4">Location</dt>
                                    <dd class="col-sm-8">
                                        @foreach ($obj->locations as $location)
                                            <a href="/{{ request()->project }}/browse/locations/{{ $location->id }}">{{ $location->name }}</a> |
                                        @endforeach
                                    </dd>

                                    <dt class="col-sm-4">School / Style</dt>
                                    <dd class="col-sm-8">
                                        @foreach ($obj->schools as $school)
                                            <a href="/{{ request()->project }}/browse/schools/{{ $school->id }}">{{ $school->name }}</a> |
                                        @endforeach
                                    </dd>

                                    @if(!empty($obj->images()->first()->copyright))
                                        <dt class="col-sm-4">Photograph Copyright</dt>
                                        <dd class="col-sm-8">{{ $item->images()->first()->copyright->name }}</dd>
                                    @endif

                                    <dt class="col-sm-4">Photographer</dt>

                                    <dd class="col-sm-8">
                                        @foreach ($obj->images()->first()->photographers as $photographer)
                                            <a href="/{{ request()->project }}/browse/photographers/{{ $photographer->id }}">{{ $photographer->name }}</a> |
                                        @endforeach
                                    </dd>

                                    <dt class="col-sm-4">Photograph Date</dt>
                                    <dd class="col-sm-8">{{ $obj->images()->first()->date }}</dd>

                                    <dt class="col-sm-4">Negative / Photo. No.</dt>
                                    <dd class="col-sm-8">{{ $obj->images()->first()->negative }}</dd>
                                </dl>

                                <h4>Properties:</h4>
                                <dl>
                                    @foreach ($obj->properties as $property)
                                        <dt class="col-sm-3">{{ $property->verbose_name }}</dt>
                                        <dd class="col-sm-9">{{ $property->pivot->value }}</dd>
                                    @endforeach
                                </dl>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img class="card-img-top img-fluid img-thumbnail" src="http://cja.huji.ac.il/{{ $obj->images()->first()->url() }}" alt="Card image cap">
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
