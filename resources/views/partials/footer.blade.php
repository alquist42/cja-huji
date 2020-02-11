<!-- Footer -->
<footer>
    <div class="container-fluid">
        <div class="card mt-4 row">
            <footer class="page-footer font-small blue pt-4">
                <div class="container text-center text-md-left">
                    <div class="row">
                        <div class="col-md-3 mb-md-0 mb-3">
                            <h5 class="text-uppercase">Pages</h5>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="/">Home</a>
                                </li>
                                <li>
                                    <a href="/activities">Activities</a>
                                </li>
                                <li>
                                    <a href="/publications">Publications</a>
                                </li>
                                <li>
                                    <a href="/about">About</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 mb-md-0 mb-3">
                            <h5 class="text-uppercase">Projects</h5>

                            <ul class="list-unstyled">
                                @foreach ($projects as $project)
                                    <li>
                                        <a href="{{ url("catalogue/" . $project['url']) }}">{{ $project['title'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-3 mt-md-0 mt-3">
                            <h5 class="text-uppercase">Contact Us</h5>
                            <p>Mount Scopus, Humanities Building, Jerusalem 9190501, Israel</p>
                            <p>
                                <a href="tel:+97225882281">phone: +972 2 5882281</a>
                                <br>
                                <a href="mailto:cja@mail.huji.ac.il">mail: cja@mail.huji.ac.il</a>
                                <br>
                                <a href="{{ url('/') }}">website: {{ url('/') }}</a>
                            </p>
                        </div>
                        <div class="col-md-3 mt-md-0 mt-3">
                            <h5 class="text-uppercase">Links</h5>
                            <p>
                                <a target="_blank" href="http://www.bet-tfila.org/">Bet-Tfila</a>
                                <br>
                                <a target="_blank" href="http://www.peterstern.co.uk/">Peter Stern, Architect and Designer</a>
                            </p>

                            <a class="text-dark" href="https://www.youtube.com/channel/UCA3sZQRWu-HInpJfFX119HQ" target="_blank">
                                <h5 class="text-uppercase">YouTube</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="footer-copyright text-center py-3">© {{ date('Y') }}. The Center for Jewish Art.
                    <a href="{{ url('copyrights') }}">Copyrights</a>
                </div>
            </footer>
        </div>
    </div>
</footer>
