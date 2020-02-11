@extends('layouts.app')

@section('content')
    <h1 class="text-center my-5">{{ $header['h1'] }}</h1>
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-md-4 col-6 mb-4">
                        <a href="{{ $header['prefix'] }}/items?categories[]={{ $category->slug }}"
                           class="link-reset">
                            <div class="catalogue-block rounded shadow {{ $category->slug }} p-3">
                                <h5 class="w-100 text-center">{{ $category->name }}</h5>
                            </div>
                        </a>

                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-lg-6 mb-4 align-center">
                    <a class="link-reset" href="{{ url($header['prefix'] . '/browse/subjects') }}">
                        <div class="browse-block big shadow">
                            <span class="label">Browse by:</span>
                            <span class="value text-center">Iconographical Subject</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 mb-4 align-center">
                    <a class="link-reset" href="{{ url($header['prefix'] . '/browse/origins') }}">
                        <div class="browse-block big shadow">
                            <span class="label">Browse by:</span>
                            <span class="value text-center">Origin</span>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-lg-6 mb-4">
                    <a class="link-reset" href="{{ url($header['prefix'] . '/browse/artists') }}">
                        <div class="browse-block medium shadow artist">
                            <span class="label">Browse by:</span>
                            <span class="value text-center">Artist</span>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-lg-6 mb-4">
                    <a class="link-reset" href="{{ url($header['prefix'] . '/browse/objects') }}">
                        <div class="browse-block medium shadow object">
                            <span class="label">Browse by:</span>
                            <span class="value text-center">Object</span>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-lg-6 mb-4">
                    <a class="link-reset" href="{{ url($header['prefix'] . '/browse/communities') }}">
                        <div class="browse-block medium shadow community">
                            <span class="label">Browse by:</span>
                            <span class="value text-center">Community</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 mb-4">
                    <a class="link-reset" href="{{ url($header['prefix'] . '/browse/collections') }}">
                        <div class="browse-block medium shadow collection">
                            <span class="label">Browse by:</span>
                            <span class="value text-center">Collection</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 mb-4">
                    <a class="link-reset" href="{{ url($header['prefix'] . '/browse/locations') }}">
                        <div class="browse-block medium shadow location">
                            <span class="label">Browse by:</span>
                            <span class="value text-center">Location</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
