@extends('layouts.app')

@section('content')
    <h1 class="text-center my-5">Activities</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-5">
                <a href="/updates"
                   class="link-reset">
                    <div class="wpc-block rounded shadow background-2">
                        <h2 class="wpc-title">Updates</h2>
                        <div class="wpc-image"
                             style="background-image: url('http://cja.huji.ac.il/Home_Page/dubno.jpg')"></div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 mb-5">
                <a href="/updates"
                   class="link-reset">
                    <div class="wpc-block rounded shadow background-7">
                        <h2 class="wpc-title">Projects & Expeditions</h2>
                        <div class="wpc-image"
                             style="background-image: url('http://cja.huji.ac.il/home/pics/events/Siberia_2015.jpg')"></div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 mb-5">
                <a href="/updates"
                   class="link-reset">
                    <div class="wpc-block rounded shadow background-9">
                        <h2 class="wpc-title">Events</h2>
                        <div class="wpc-image"
                             style="background-image: url('http://cja.huji.ac.il/home/pics/new_site.jpg')"></div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 mb-5">
                <a href="/updates"
                   class="link-reset">
                    <div class="wpc-block rounded shadow background-5">
                        <h2 class="wpc-title">Narkiss Prize</h2>
                        <div class="wpc-image"
                             style="background-image: url('http://cja.huji.ac.il/home/pics/Daisy.png')"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection