@extends('layouts.app')

@section('content')
    <h1 class="text-center my-5">{{ $header['h1'] }}</h1>
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                @foreach($countries as $index => $country)
                    <div class="col-md-4 mb-4">
                        <a href="{{ url("{$header['prefix']}/items?locations[]={$country->id}") }}"
                           class="link-reset">
                            <div class="wpc-block rounded shadow {{ "background-" . ($index+2) }}">
                                <h2 class="wpc-title">{{ $country->name }}</h2>
                                <div class="wpc-image"
                                     style="background-image: url('{{"http://cja.huji.ac.il/wpc/pics/$country->image"}}')"></div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <div class="row mb-5">
                <div class="col">
                    <div class="background-quote p-5 shadow rounded text-center">
                        <h5 class="mb-4">Boris Khaimovich<br></h5>
                        <h6><em>Catalogue of Wall Paintings in Central and East European Synagogues</em>
                            edited by Vladimir Levin
                        </h6>
                        <p>
                            The <em>Catalogue</em> represents one of the modules comprising the Bezalel Narkiss
                            Index of
                            Jewish Art. It includes murals created within the framework of traditional Jewish folk
                            culture
                            (while omitting decorative paintings belonging to historicist building design).
                        </p>
                        <a href="#" class="btn btn-link" data-toggle="modal" data-target="#modal">
                            Read more
                        </a>

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
            <div class="row justify-content-center">
                <div class="col-lg-6 mb-4 align-center">
                    <a class="link-reset" href="{{ url($header['prefix'] . '/browse/subjects') }}">
                        <div class="browse-block medium shadow subject">
                            <span class="label">Browse by:</span>
                            <span class="value text-center">Iconographical Subject</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 mb-4">
                    <a class="link-reset" href="{{ url($header['prefix'] . '/browse/origins') }}">
                        <div class="browse-block medium shadow origin">
                            <span class="label">Browse by:</span>
                            <span class="value text-center">Origin</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 mb-4">
                    <a class="link-reset" href="{{ url($header['prefix'] . '/browse/artists') }}">
                        <div class="browse-block medium shadow artist">
                            <span class="label">Browse by:</span>
                            <span class="value text-center">Artist</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 mb-4">
                    <a class="link-reset" href="{{ url($header['prefix'] . '/browse/collections') }}">
                        <div class="browse-block medium shadow collection">
                            <span class="label">Browse by:</span>
                            <span class="value text-center">Collection</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 mb-4">
                    <a class="link-reset" href="#">
                        <div class="browse-block medium shadow map">
                            <span class="value text-center">Map</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
