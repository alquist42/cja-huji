@extends('layouts.app')

@section('content')
    <h1 class="text-center my-5">A Catalogue of Wall Paintings in Central and East European Synagogues</h1>
    <div class="py-5 row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card text-center">
                        <div class="card-body" style="min-height: 150px">
                            <h5 class="card-title">All The Catalogue</h5>
                        </div>
                        <div class="card-footer">
                            <a href="/wpc/items" class="btn btn-primary">Browse</a>
                        </div>
                    </div>
                </div>
                @foreach($countries as $country)
                    <div class="col-md-4 mb-4">
                        <div class="card text-center">
                            <div class="card-body" style="min-height: 150px">
                                <h5 class="card-title">{{ $country->name }}</h5>

                            </div>
                            <div class="card-footer">
                                <a href="/wpc/items?locations[]={{ $country->id }}"
                                   class="btn btn-primary">Browse</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-4">
            <div class="col">
                <div class="card text-center" style="background-color:#FFF8DF">
                    <div class="card-header">
                        <h5>Boris Khaimovich<br>
                            <em>
                                <h6>Catalogue of Wall Paintings in Central and East European Synagogues</h6>
                            </em>
                            edited by Vladimir Levin
                        </h5>
                    </div>
                    <div class="card-body">
                        The <em>Catalogue</em> represents one of the modules comprising the Bezalel Narkiss
                        Index of
                        Jewish Art. It includes murals created within the framework of traditional Jewish folk
                        culture
                        (while omitting decorative paintings belonging to historicist building design).
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modal">
                            Read more
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Boris Khaimovich
                                            Catalogue of Wall Paintings in Central and East European Synagogues
                                            edited by Vladimir Levin</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-left">
                                        The <em>Catalogue</em> represents one of the modules comprising the Bezalel
                                        Narkiss Index of Jewish Art. It includes murals created within the framework
                                        of traditional Jewish folk culture (while omitting decorative paintings
                                        belonging to historicist building design).<p></p>
                                        <p>The Center for Jewish Art intends the <em>Catalogue</em> to include
                                            records of all known murals from both extant and non-extant synagogues.
                                            In the latter case, surviving photographs and verbal descriptions bear
                                            witness to the destroyed works of art. The records of all paintings
                                            furnish information about creators, dates, iconographical subjects, and
                                            inscriptions.</p>
                                        <p>Synagogue murals constitute a historical and cultural phenomenon that
                                            first spread through Central and Eastern Europe in the late sixteenth
                                            and early seventeenth centuries. This early development reached its high
                                            point in the seventeenth and eighteenth centuries with artwork painted
                                            on the walls and ceilings of wooden synagogues. The murals of this
                                            period are characterized by original artistic language, an established
                                            composition program, and a variety of symbolic and decorative motifs. In
                                            the late nineteenth century European art genres exerted a definite
                                            influence on the decoration programs of synagogues. Subsequently, the
                                            first half of the twentieth century saw a new peak in the popularity of
                                            synagogue paintings. Even after the Holocaust some surviving communities
                                            continued this tradition and tried to observe the traditional “canon” in
                                            the decoration of their synagogues. Notwithstanding the manifest
                                            influence of European art, the synagogue murals have no counterpart in
                                            the sacred buildings of the surrounding Christian culture.</p>
                                        <p>The <em>Catalogue</em> is based primarily on materials collected by the
                                            Center for Jewish Art during expeditions undertaken from 1994 to 2015,
                                            as well as archival photographs from several collections in Europe and
                                            Israel.</p>
                                        <p>We believe that the <em>Catalogue</em> will provide a new basis for
                                            scholarly study of the iconography and symbolism of Jewish folk art,
                                            serve as a convenient starting point for restorers of extant synagogues,
                                            and help expose the broader public to the richness and diversity of
                                            Jewish symbolism and the Jewish heritage as a whole.</p>
                                        <p align="right">Dr. Boris Khaimovich<br>
                                            Dr. Vladimir Levin<br>
                                            Jerusalem, February 2017</p>
                                        <p></p>
                                        <p>We thank the following participants of the project:<br>
                                            Dipl.-Ing. Zoya Arshavsky, architectural drafter<br>
                                            Alla Kucherenko, Hebrew inscriptions editor<br>
                                            Karina Kordiukova, research assistant<br>
                                            Dr. Yeshayahu Gruber, language editor<br>
                                            Carmen Echevarria, language editor<br>
                                            Mark Gondelman, Programmer<br>
                                            Gilad Hemed, Digitization, Web Master, Graphic Designer and
                                            Administration Director</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col mt-5">
                <div class="card text-center">
                    <div class="card-header">
                        Browse By
                    </div>
                    <div class="card-body">
                        <div class="btn-group-vertical w-100">
                            <a href="{{ url('/wpc/browse/subject') }}" class="btn btn-secondary">Iconographical Subject</a>
                            <a href="{{ url('/wpc/browse/origin') }}" class="btn btn-secondary">Origin</a>
                            <a href="{{ url('/wpc/browse/artist') }}" class="btn btn-secondary">Artist</a>
                            <a href="{{ url('/wpc/browse/collection') }}" class="btn btn-secondary">Collection</a>
                        </div>
                        <a href="{{ url('/wpc/browse/collection') }}" class="btn btn-secondary w-100 mt-3">Map</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection