@extends('layouts.app')

@section('content')
    <div class="row my-5">
        <div class="col-md-8">
            <div class="col-12 mb-5">
                <div class="banner bni-banner rounded shadow">
                    <a href="{{ url('catalogue') }}"
                       class="banner-link background-bezalel link-reset">
                        <h3 class="banner-title">The Bezalel Narkiss Index of Jewish Art</h3>
                        <p class="banner-description">Read more</p>
                    </a>
                </div>
            </div>
            <div class="col-12 mb-5">
                <div id="carouselExampleIndicators" class="carousel slide shadow" data-ride="false">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-header background-mhs">
                            <h3>Divisions of the Index of Jewish Art</h3>
                        </div>
                        <div class="carousel-item active height-500">
                            <img class="d-block img-fluid w-100" src="{{ asset($prefix_url . 'pics/mhs.jpg') }}">
                            <div class="caption-head background-mhs d-none d-md-block">
                                <a class="link-reset" href="{{ url('mhs') }}">
                                    <h4>Historic Synagogues of Europe</h4>
                                </a>
                            </div>
                        </div>
                        <div class="carousel-item height-500">
                            <img class="d-block w-100" src="{{ asset($prefix_url . 'pics/wpc.jpg') }}">
                            <div class="caption-head background-mhs d-none d-md-block">
                                <a class="link-reset" href="{{ url('wpc') }}">
                                    <h4>A Catalogue of Wall Paintings in Central and East European Synagogues</h4>
                                    <p>Boris Khaimovich <br> Edited by Vladimir Levin</p>
                                </a>
                            </div>
                        </div>
                        <div class="carousel-item height-500">
                            <img class="d-block w-100" src="{{ asset($prefix_url . 'pics/Schubert.jpg') }}">
                            <div class="caption-head background-mhs d-none d-md-block">
                                <a class="link-reset" href="{{ url('sch') }}">
                                    <h4>Ursula and Kurt Schubert Archive</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                       data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                       data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-12">
                <div class="w-100 p-20 background-media rounded shadow mb-4">
                    <h3 class="font-weight-bold text-white">Media</h3>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    @for ($i=0; $i<12; $i++)
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                {{--<iframe width="100%" src="https://www.youtube.com/embed/xItkombbAqs" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>--}}

                                <div class="card-body">
                                    <p class="card-text">
                                        Help Us Save the Great Synagogue of Ashmiany
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">Jun 21, 2018</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                    @for ($i=0; $i<18; $i++)
                        <div class="col-md-3 col-6">
                            <a href="#" class="btn btn-outline-secondary mb-4">Jewish Heritage Europe
                                <br>
                                (August 11,2017)
                            </a>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col-12 mb-5">
                <div class="banner narkiss-price-banner rounded shadow">
                    <a href="{{ url('activities') }}"
                       class="banner-link background-narkiss-price link-reset">
                        <h3 class="banner-title">Narkiss Prize</h3>
                        <p>Sacred Mystery: Visual Kabbalah
                            <br>
                            William L. Gross
                            <br>
                            25 December 2019 18:30
                        </p>
                        <p><b>Click to read more Activities</b></p>
                    </a>
                </div>
            </div>
            <div class="col-12 mb-5">
                <div class="banner publications-banner rounded shadow">
                    <a href="{{ url('publications') }}"
                       class="banner-link background-publications link-reset">
                        <h3 class="banner-title">Publications</h3>
                        <p>Synagogues in Ukraine: Volhynia By Sergey R. Kravtsov and Vladimir Levin Jerusalem, 2017.
                            Zalman Shazar Center and Center for Jewish Art
                        </p>
                    </a>
                </div>
            </div>
            <div class="col-12">
                <div class="w-100 p-20 background-media shadow rounded mb-4">
                    <h3 class="font-weight-bold text-white">News from Jewish Heritage Europe</h3>
                </div>
            </div>
            <div class="col-12">
                {{--<iframe id="fw-iframe9677522028" name="fw-iframe9677522028" height="150" width="150"
                        style="position: relative; width: 100%; height: 320px;" class="fw-iframe" scrolling="no"
                        frameborder="0"
                        src="http://feed.mikle.com/widget/v2/82996/?id=fw-iframe9677522028null"></iframe>--}}
            </div>
            <div class="col-12 mb-5">
                <div class="banner about-banner rounded shadow">
                    <a href="{{ url('about') }}"
                       class="banner-link background-about link-reset">
                        <h3 class="banner-title">About</h3>
                        <p>Researchers and Staff</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row ">
        @foreach($projects as $slug => $project)
            <div class="col-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url($slug . ($project['sub_project'] ? '' : '/items')) }}">{{ $project['title'] }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
