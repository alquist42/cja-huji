@extends('layouts.app')

@section('content')
    <h1 class="text-center my-5">{{ $header['h1'] }}</h1>
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card text-center">
                        <div class="card-body" style="min-height: 150px">
                            <h5 class="card-title">All Categories</h5>
                        </div>
                        <div class="card-footer">
                            <a href="/catalogue/items" class="btn btn-primary">Browse</a>
                        </div>
                    </div>
                </div>
                @foreach($categories as $category)
                    <div class="col-md-4 mb-4">
                        <div class="card text-center">
                            <div class="card-body" style="min-height: 150px">
                                <h5 class="card-title">{{ $category->name }}</h5>

                            </div>
                            <div class="card-footer">
                                <a href="/catalogue/items?categories[]={{ $category->slug }}"
                                   class="btn btn-primary">Browse</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-3">
            <div class="row">
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Browse By
                        </div>
                        <div class="card-body">
                            <div class="btn-group-vertical w-100">
                                <a href="{{ url('/sch/browse/subject') }}" class="btn btn-secondary">Iconographical
                                    Subject</a>
                                <a href="{{ url('/sch/browse/origin') }}" class="btn btn-secondary">Origin</a>
                                <a href="{{ url('/sch/browse/artist') }}" class="btn btn-secondary">Artist</a>
                                <a href="{{ url('/sch/browse/collection') }}" class="btn btn-secondary">Collection</a>
                            </div>
                            <a href="{{ url('/sch/browse/collection') }}" class="btn btn-secondary w-100 mt-3">Map</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection