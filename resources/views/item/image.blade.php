<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @forelse ($item->images as $image)
            <div class="carousel-item  @if($image->id === $item->images[0]->id) {{ 'active' }} @endif">
                {{--<img class="d-block w-100 preview" src="http://cja.huji.ac.il/{{ $image->url() }}" alt="First slide">--}}
                <img class="d-block w-100 preview" src="/images/{{ $item->images[0]->id }}" alt="First slide">

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
