@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row mt-5">
                <div class="card mx-1">
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
                                            <!--Google map-->
                                            <div id="map-container-google-9" class="z-depth-1-half map-container-5" style="height: 300px">
                                                <iframe src="https://maps.google.com/maps?q=Madryt&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
                                                        style="border:0" allowfullscreen></iframe>
                                            </div>
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

                <hr style="margin-top: 50px; width: 100%; color: blue; height: 1px; background-color:blue;" />
                <p class="h3 text-center">Object's Images</p>

                @include('images')

            </div>
        </div>
    </div>
@endsection
