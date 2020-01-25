@extends('layouts.app')

@section('content')
    <div class="row my-5">
        <div class="col-md-8">
            <div class="col-12 mb-5">
                <div class="banner bni-banner rounded shadow">
                    <a href="{{ url($projects['cja']['url']) }}"
                       class="banner-link background-bezalel link-reset">
                        <h3 class="banner-title">The Bezalel Narkiss Index of Jewish Art</h3>
                        <p class="banner-description">Read more</p>
                    </a>
                </div>
            </div>
            <div class="col-12 mb-5">
                <div class="w-100 p-20 background-2 shadow rounded mb-4">
                    <h3 class="text-white">Divisions of the Index of Jewish Art</h3>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <a href="{{ url($projects['mhs']['url']) }}"
                           class="link-reset">
                            <div class="welcome-divisions rounded shadow background-8">
                                <h4 class="welcome-title">{{ $projects['mhs']['title'] }}</h4>
                                <div class="welcome-image"
                                     style="background-image: url('{{"http://cja.huji.ac.il/home/pics/mhs.jpg"}}')"></div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 mb-4">
                        <a href="{{ url($projects['wpc']['url']) }}"
                           class="link-reset">
                            <div class="welcome-divisions rounded shadow background-3">
                                <h4 class="welcome-title">{{ $projects['wpc']['title'] }}</h4>
                                <div class="welcome-image"
                                     style="background-image: url('{{"http://cja.huji.ac.il/home/pics/wpc.jpg"}}')"></div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 mb-4">
                        <a href="{{ url($projects['sch']['url']) }}"
                           class="link-reset">
                            <div class="welcome-divisions rounded shadow background-4">
                                <h4 class="welcome-title">{{ $projects['sch']['title'] }}</h4>
                                <div class="welcome-image"
                                     style="background-image: url('{{"http://cja.huji.ac.il/home/pics/Schubert.jpg"}}')"></div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 mb-4">
                        <a href="{{ url($projects['slovenia']['url']) }}"
                           class="link-reset">
                            <div class="welcome-divisions rounded shadow background-5">
                                <h4 class="welcome-title">{{ $projects['slovenia']['title'] }}</h4>
                                <div class="welcome-image"
                                     style="background-image: url('{{"http://cja.huji.ac.il/slovenia/pics/Maribor-Keystone.jpg"}}')"></div>
                            </div>
                        </a>
                    </div>
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
@endsection
