<div class="container-fluid">
    <div class="row">
{{--        <div class="card-deck">--}}
{{--            @foreach ($item->items()->chunk(4) as $chunk)--}}
                @foreach($item->items() as $obj)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12 mb-4 px-2">
                        <a href="/{{ $obj->url() }}" class="card-link">
                            <div class="card">
                                <img class="card-img-top lazyload" src="/images/{{ $obj->id }}-{{ $obj->images->first()->id }}-small.png" alt="{{ $item->name() }}">
                                <div class="card-img-overlay" style="opacity: 0.6;">
                                    <h5 class="card-title text-white bg-secondary p-3">ID: {{ $obj->id }}</h5>
                                </div>
                                <div class="card-footer text-muted">
                                        {{ $obj->name() }}
                                        @foreach ($obj->collections as $collection){{$collection->name}}
                                        @if($collection->details) <span>, {{ $collection->details }}</span> @endif
                                        @endforeach

                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
{{--            @endforeach--}}
{{--        </div>--}}
    </div>
</div>
