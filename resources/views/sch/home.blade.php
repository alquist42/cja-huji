@extends('layouts.app')

@section('content')
    <h1 class="text-center my-5">{{ $header['h1'] }}</h1>
    <div class="row">
        <div class="col-md-8">
            <div class="row justify-content-center">
                @foreach($categories as $index => $category)
                    <div class="col-md-3 mb-4">
                        <a href="{{ url("{$header['prefix']}/items?text={$category['search']}") }}"
                           class="link-reset">
                            <div class="wpc-block rounded shadow {{ "background-" . ($index+2) }}">
                                <h2 class="wpc-title">{{ $category['title'] }}</h2>
                                <div class="wpc-image"
                                     style="background-image: url('{{"http://cja.huji.ac.il/sch/pics/{$category['image']}"}}')"></div>
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
                        <p>The Kurt and Ursula Schubert Archive is one of the sections comprising the Bezalel Narkiss
                            Index of Jewish Art.<br>
                            The late Profs. Kurt and Dr. Ursula Schubert from Vienna University, established an
                            extensive collection of photographs of Hebrew illuminated manuscripts... During the 1980s
                            and 1990s, their collection grew into an impressive archive which became the Schuberts’
                            major research tool.
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
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-left">
                                        <p>The Kurt and Ursula Schubert Archive is one of the sections comprising
                                            the Bezalel Narkiss Index of Jewish Art.</p>
                                        <p>The late Profs. Kurt and Dr. Ursula Schubert from Vienna University,
                                            established an extensive collection of photographs of Hebrew illuminated
                                            manuscripts. For many years the Schuberts had traveled to libraries and
                                            manuscript collections all over Europe, Israel, and the USA, examined
                                            and catalogued manuscripts and established contacts with manuscript
                                            keepers and curators. Several grants from the Austrian Fonds zur
                                            Förderung der Wissenschaften Forschung allowed them to acquire full sets
                                            of photographs of many manuscripts they had researched. During the 1980s
                                            and 1990s, their collection grew into an impressive archive which became
                                            the Schuberts’ major research tool.</p>
                                        <p>In the last joint visit of Ursula and Kurt Schubert to Jerusalem in 1998,
                                            Prof. Aliza Cohen-Mushlin, then the director of the Center for Jewish
                                            Art and herself a researcher of illuminated manuscripts, approached them
                                            and proposed that their collection of photographs would be transferred
                                            to the Center for Jewish Art at the Hebrew University of Jerusalem. The
                                            Schuberts agreed, and in the summer of 1999 the archive was shipped to
                                            Israel, with the help of the Austrian Foreign Ministry.</p>
                                        <p>The archives arrived to Jerusalem on 15 August, 1999, but two weeks later
                                            Ursula passed away. She never saw their archive in its new home on the
                                            Mount Scopus campus. Kurt Schubert visited Jerusalem once more, in
                                            February 2005, and participated in the opening ceremony. He then wrote
                                            in Hebrew the following in the visitors’ book:<br>
                                            למה שאספנו וריכזנו ועיבדנו בוינה
                                            אני מאחל הצלחה שלמה לעתיד בירושלים
                                            קורט שוברט<br>
                                            22.II.2005<br>
                                            (To what we have collected, merged and researched in Vienna, I wish full
                                            success in the future in Jerusalem. 22 February 2005. Kurt Schubert)</p>
                                        <p>The Schubert Archive includes 8,151 photographs of illuminations from 327
                                            Hebrew manuscripts which are kept in 38 libraries and museums.</p>
                                        <p>The Archive was scanned as part of the digitization project of the Center
                                            for Jewish Art, generously supported by the Rothschild Foundation
                                            (Hanadiv) Europe, "Landmarks" Program of the Israeli Prime Minister’s
                                            Office, and Judaica Division of Harvard University Library (Judaica Book
                                            Fund endowments established by David B. Keidan).</p>
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
                    <a class="link-reset" href="{{ url($header['prefix'] . '/browse/origins') }}">
                        <div class="browse-block medium shadow artist">
                            <div class="label">Browse by:</div>
                            <div class="value text-center">Artist</div>
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
