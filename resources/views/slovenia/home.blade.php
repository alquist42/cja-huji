@extends('layouts.app')

@section('content')
    <h1 class="text-center my-5">{{ $header['h1'] }}</h1>
    <div class="row">
        <div class="col-md-8">
            <div class="row justify-content-center">
                @foreach($categories as $index => $category)
                    <div class="col-md-6 mb-4">
                        <a href="{{ url("{$header['prefix']}/items?categories[]={$category['slug']}") }}"
                           class="link-reset">
                            <div class="wpc-block rounded shadow {{ "background-" . ($index+2) }}">
                                <h2 class="wpc-title">{{ $category['name'] }}</h2>
                                <div class="wpc-image"
                                     style="background-image: url('{{"http://cja.huji.ac.il/slovenia/pics/{$category['image']}"}}')"></div>
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
                        <h5>Slovenian Jewish Heritage</h5>

                        <p>Web portal “Slovenian Jewish Heritage” presents the entire multifaceted Jewish heritage of
                            Slovenia. It includes synagogues, cemeteries, tombstones and their fragments, cemetery
                            chapels, Holocaust memorials, medieval Jewish quarters, ritual objects, and manuscripts
                            preserved in the territory of the Republic of Slovenia.</p>

                        <a href="#" class="btn btn-link" data-toggle="modal" data-target="#modal">
                            Read more
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-left">
                                        <div class="PicDivIntroP">
                                            <h6>Slovenian Jewish Heritage</h6>
                                            <p>Web portal “Slovenian Jewish Heritage” presents the entire multifaceted
                                                Jewish heritage of Slovenia. It includes synagogues, cemeteries,
                                                tombstones and their fragments, cemetery chapels, Holocaust memorials,
                                                medieval Jewish quarters, ritual objects, and manuscripts preserved in
                                                the territory of the Republic of Slovenia. The web portal “Slovenian
                                                Jewish Heritage” is a division of the Bezalel Narkiss Index of Jewish
                                                Art; integration of documentation of Slovenian Jewish heritage in the
                                                Index enables its contextualization and placement within the broader
                                                context of European and global Jewish heritage.</p>
                                            <p>Web portal “Slovenian Jewish Heritage” was created in the framework of a
                                                bilateral Slovenian-Israeli research project "Digitization of the Jewish
                                                Heritage in Slovenia," conducted by the Center for Jewish Art at the
                                                Hebrew University of Jerusalem and the University of Maribor. The
                                                funding for the project was provided by the Israel Ministry of Science
                                                and Technology and the Slovenian Research Agency.</p>

                                        </div>
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
