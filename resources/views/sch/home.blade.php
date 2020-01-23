@extends('layouts.app')

@section('content')
    <h1 class="text-center my-5">{{ $header['h1'] }}</h1>
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-md-4 mb-4">
                        <div class="card text-center">
                            <div class="card-body" style="min-height: 150px">
                                <h5 class="card-title">{{ $category['title'] }}</h5>

                            </div>
                            <div class="card-footer">
                                <a href="/sch/items?text={{ $category['search'] }}"
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
                    <div class="card-body">
                        <p>The Kurt and Ursula Schubert Archive is one of the sections comprising
                            the Bezalel Narkiss Index of Jewish Art.
                            <br>
                            The late Profs. Kurt and Dr. Ursula Schubert from Vienna University, established an
                            extensive collection of photographs of Hebrew illuminated manuscripts... During the
                            1980s and 1990s, their collection grew into an impressive archive which became the
                            Schuberts’ major research tool.
                        </p>
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
            <div class="col mt-5">
                <div class="card text-center">
                    <div class="card-header">
                        Browse By
                    </div>
                    <div class="card-body">
                        <div class="btn-group-vertical w-100">
                            <a href="{{ url('/sch/browse/subject') }}" class="btn btn-secondary">Iconographical Subject</a>
                            <a href="{{ url('/sch/browse/origin') }}" class="btn btn-secondary">Origin</a>
                            <a href="{{ url('/sch/browse/artist') }}" class="btn btn-secondary">Artist</a>
                            <a href="{{ url('/sch/browse/collection') }}" class="btn btn-secondary">Collection</a>
                        </div>
                        <a href="{{ url('/sch/browse/collection') }}" class="btn btn-secondary w-100 mt-3">Map</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection