@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">

            @include('partials.search')

            @if ($items instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="my-5 pagination-wrapper">
                    {{ $items->appends(request()->query())->links('partials.pagination') }}
                </div>
            @endif

            <div class="row">
                @forelse ($items as $item)
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12 mb-4">
                        <div class="card">
                            <img class="card-img-top" src="http://placeimg.com/640/480/arch" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ str_limit($item->name, $limit = 50, $end = '...') }}</h5>
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
                <div class="mt-3 mb-5 pagination-wrapper">
                    {{ $items->appends(request()->query())->links('partials.pagination') }}
                </div>
            @endif
        </div>
    </div>
@endsection
