<header>
    <div class="container px-3 my-2">
        <div class="row">
            <div class="col-6">
                <div class="text-center">
                    <a target="_blank" href="http://www.foundationforjewishheritage.com">
                        <img src="http://cja.huji.ac.il/mhs/pics/Foundation_For_Jewish_Heritage.png"
                             alt="Foundation for Jewish Heritage" height="70px"/>
                    </a>
                </div>
            </div>
            <div class="col-6">
                <div class="text-center">
                    <a href="{{ url('/') }}">
                        <img src="http://cja.huji.ac.il/mhs/pics/cja_hu.png"
                             height="70px"/>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="mx-auto py-2 text-center" width="500">
                <h1 class="main-title">Historic Synagogues of Europe</h1>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-light">
        <!--Navbar -->
        <nav class="mb-1 navbar navbar-expand-lg navbar-light bg-light text-white row">

            <!-- Branding Image -->
            {{--        <a class="navbar-brand" href="{{ url('/') }}">--}}
            {{--            The Bezalel Narkiss Index of Jewish Art--}}
            {{--        </a>--}}

            <button class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#main-menu"
                    aria-controls="main-menu"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main-menu">
                <ul class="navbar-nav mx-auto">
                    @foreach ($menu['mhs'] as $index => $item)
                        <li class="nav-item">
                            <a class="nav-link {{ isset($item['disabled']) ? 'disabled' : '' }} {{ request()->is("*{$item['url']}") ? 'active' : '' }}"
                               href="{{ request()->is("*{$item['url']}") ? '#' : url($header['prefix'] . $item['url'])  }}">
                                {{ $item['title'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>
    </div>
</header>
