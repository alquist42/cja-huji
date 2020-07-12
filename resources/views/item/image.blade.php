<div class="container-fluid">
    <div class="row">
        <div class="col col-md-8 offset-md-2">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @forelse ($item->images as $image)
                        <div class="carousel-item  @if($image->id === $item->images[0]->id) {{ 'active' }} @endif">
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
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>
    </div>
</div>
