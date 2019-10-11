<div class="container">
    @forelse ($item->images as $image)
        <div class="row mt-5">
{{--            <p>--}}
{{--                <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample{{ $image->id }}" role="button" aria-expanded="false" aria-controls="collapseExample">--}}
{{--                    {{ $image->name }}--}}
{{--                </a>--}}
{{--            </p>--}}
            <div class="collapsse" id="collapseExample{{ $image->id }}">
                <div class="card border-danger bg-light mx-1">
                    <div class="card-header">
                        Synagogue in Mediaș - Women's section, photos of 2019,Mediaș (Mediasch, Medgyes), 1896.
                    </div>
                    <div class="container">
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <div class="container">
                                    <dl class="row my-3">
                                        <dt class="col-sm-3">Name / Title</dt>
                                        <dd class="col-sm-9">Synagogue in Mediaș - Women's section, photos of 2019</dd>

                                        <dt class="col-sm-3">Object</dt>
                                        <dd class="col-sm-9"><a href="/catalog/browse#object/123">Synagogue</a></dd>

                                        <dt class="col-sm-3">Date</dt>
                                        <dd class="col-sm-9">1896</dd>

                                        <dt class="col-sm-3">Origin</dt>
                                        <dd class="col-sm-9">
                                            <a href="/catalog/browse#origin/123">Romania</a> |
                                            <a href="/catalog/browse#origin/234">Transylvania</a> |
                                            <a href="/catalog/browse#origin/345">Mediaș (Mediasch, Medgyes)</a>
                                        </dd>

                                        <dt class="col-sm-3">Location</dt>
                                        <dd class="col-sm-9">
                                            <a href="/catalog/browse#location/123">Romania</a> |
                                            <a href="/catalog/browse#location/234">Transylvania</a> |
                                            <a href="/catalog/browse#location/345">Sibiu județ</a> |
                                            <a href="/catalog/browse#location/345">Mediaș</a> |
                                            45 Kogalniceanu St.
                                        </dd>

                                        <dt class="col-sm-3">School / Style</dt>
                                        <dd class="col-sm-9">
                                            <a href="/catalog/browse#shcoll/123">Neo-Moorish</a> |
                                            <a href="/catalog/browse#shcoll/234">Neo-Romanesque</a>
                                        </dd>

                                        <dt class="col-sm-3">Photograph Copyright</dt>
                                        <dd class="col-sm-9">Center for Jewish Art</dd>

                                        <dt class="col-sm-3">Photographer</dt>
                                        <dd class="col-sm-9"> <a href="/catalog/browse#photographer/123">Levin, Vladimir</a></dd>

                                        <dt class="col-sm-3">Photograph Date</dt>
                                        <dd class="col-sm-9">9.2019</dd>

                                        <dt class="col-sm-3">Negative / Photo. No.</dt>
                                        <dd class="col-sm-9">digital</dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img class="card-img-top img-fluid img-thumbnail" src="{{ $image->medium }}" alt="Card image cap">
                            </div>
                            <div class="col-12">___</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @empty
        <div class="panel panel-default">
            <div class="panel-heading">Not Found!!</div>

            <div class="panel-body">
                <p>Sorry! No comment found for this post.</p>
            </div>
        </div>
    @endforelse

</div>
