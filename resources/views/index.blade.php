@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">

            @include('partials.search')

            <div class="row">
                @forelse ($items as $item)
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12 mb-4">
                        <div class="card">
                            <img class="card-img-top" src="http://placeimg.com/640/480/arch" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <p class="card-text">{!! $item->description !!}</p>
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
                <!-- /.team-img -->
            </div>
            @if ($items instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="row my-3 pagination-wrapper">
                    {{ $items->appends(request()->query())->links('partials.pagination') }}
                </div>
            @endif
        </div>
    </div>
@endsection
