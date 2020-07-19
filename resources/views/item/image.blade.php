<div id="item-carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner images-gallery">
        @forelse ($item->images as $slide => $image)
            <div
                class="carousel-item  @if($image->id === $item->images[0]->id) {{ 'active' }} @endif"
                data-slide-number="{{ $slide }}"
            >
                <div class="card">
                    <div class="placeholder" style="width:100%;min-height:250px;">
                        <img class="d-block w-100 preview" src="/images/{{ $item->id }}-{{ $image->id }}-medium.png" alt="First slide">
                    </div>
                    <div class="card-body">
                        @include('item.image-details', [ 'image' => $image ])
                    </div>
                </div>
            </div>
        @empty
            <div></div>
        @endforelse
    </div>



    <a class="carousel-control-prev" href="#item-carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#item-carousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

    <ul class="carousel-indicators">
        @foreach ($item->images as $slide => $image)
            <li data-target="#item-carousel" data-slide-to="{{ $slide  }}" @if($image->id === $item->images[0]->id) {{ 'class="active"' }} @endif>
                <img class="d-block" style="width: 125px;" src="/images/{{ $item->id }}-{{ $image->id }}-thumb.png" class="img-fluid">
            </li>
        @endforeach
    </ul>

</div>
