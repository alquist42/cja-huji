@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">

            @include('partials.search')
            {{--{!! html_entity_decode($links) !!} --}}
            @if ($pagination instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="my-5 pagination-wrapper">
                    {{ $pagination->appends(request()->query())->links('partials.pagination') }}
                </div>
            @endif
           {{-- @if ($items instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="my-5 pagination-wrapper">
                    {{ $items->appends(request()->query())->links('partials.pagination') }}
                </div>
            @endif--}}
            <div class="my-5">{{$setsCount}} items found</div>

            <div class="row">
                @forelse ($items as $item)

                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12 mb-4">

                            <div class="card">
                              {{--  <img class="card-img-top image-fluid" src="http://cja.huji.ac.il/{{ $item->images[0]->url() }}" alt=" {{ $item->name() }}">--}}
                                @if(count($item->images))
                                    <img class="card-img-top image-fluid" src="/images/{{ $item->id }}-{{ $item->images->first()->id }}-small.png" alt=" {{ $item->name() }}">
                                @else
                                    <img class="card-img-top image-fluid" src="/not_uploaded.jpg" alt="no image">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title {{--text-truncate--}}">
                                        <a href="/{{ $item->url() }}">
                                            {{ $item->name() }}<br/>
                                         </a>
                                        @foreach ($item->collections as $collection)@if($collection->id!=-1){{$collection->name}}@endif @endforeach
                                        @foreach ($item->collection_details as $collection_detail), {{$collection_detail->details}}@endforeach
                                        (ID:{{ $item->id }})
                                    </h5>
                                </div>
                            </div>
                    </div>

                @empty
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <H5 class="card-title">No Objects Found...</H5>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            {{--@if ($items instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="mt-3 mb-5 pagination-wrapper">
                    {{ $items->appends(request()->query())->links('partials.pagination') }}
                </div>
            @endif--}}
            @if ($pagination instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="my-5 pagination-wrapper">
                    {{ $pagination->appends(request()->query())->links('partials.pagination') }}
                </div>
            @endif
        </div>
    </div>
@endsection
