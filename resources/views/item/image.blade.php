<div id="item-carousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false">
    <button type="button" class="py-3 btn btn-light btn-block preview" onclick="window.gallery.show()">Preview</button>
    <div class="carousel-inner images-gallery">
        @forelse ($item->images as $slide => $image)
            <div
                class="carousel-item  @if($image->id === $item->images[0]->id) {{ 'active' }} @endif"
                data-slide-number="{{ $slide }}"
            >
                <div class="card">
                    <img class="img-fluid card-img-top lazyload" src="/images/{{ $item->id }}-{{ $image->id }}-medium.png" alt="{{ $item->name }}">
                    @include('item.image-details', [ 'image' => $image ])
                </div>
            </div>
        @empty
            <div></div>
        @endforelse
    </div>

    @if(count($item->images) > 1)
        <a class="carousel-control-prev" href="#item-carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#item-carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

        <ul class="carousel-indicators list-inline">
            @foreach ($item->images as $slide => $image)
                <li data-target="#item-carousel" data-slide-to="{{ $slide  }}" class="list-inline-item @if($image->id === $item->images[0]->id) {{ 'active' }} @endif" >
                    <img class="d-block" style="width: 125px;" src="/images/{{ $item->id }}-{{ $image->id }}-small.png" class="img-fluid">
                </li>
            @endforeach
        </ul>
    @endif
</div>
