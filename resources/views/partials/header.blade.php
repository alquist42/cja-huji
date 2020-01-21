<header>
    <div class="container px-3 my-2">
        <div class="row">
            <div class="float-left">
                <a target="_blank" href="/huji/eng/index_e.htm">
                    <img src="http://cja.huji.ac.il/home/pics/HUJI_Logo-2.png" alt="The Hebrew University of Jerusalem"
                         height="70px"/>
                </a>
            </div>
            <div class="mx-auto py-2 text-center" width="500">
                <h3 class="main-title">The Center for Jewish Art</h3>
                <h5 class="main-subtitle text-muted">The Hebrew University of Jerusalem ({{ request()->project }})</h5>
            </div>
            <div class="float-right">
                <a href="/">
                    <img src="http://cja.huji.ac.il/home/pics/cja-lion-new.png" alt="The Hebrew University of Jerusalem"
                         height="70px"/>
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-light">
        <!--Navbar -->
        <nav class="mb-1 navbar navbar-expand-lg navbar-dark bg-dark text-white row">

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
                <ul class="navbar-nav mr-auto">
                    @foreach ($menu as $index => $item)
                        <li class="nav-item {{ isset($item['children']) ? 'dropdown' : '' }}">
                            <a class="nav-link {{ isset($item['disabled']) ? 'disabled' : '' }} {{ isset($item['children']) ? 'dropdown-toggle' : '' }}"
                               @isset($item['children'])
                               id="navbarDropdownMenuLink{{ $index }}" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false"
                               @endisset
                               href="{{ url($item['url']) }}">
                                {{ $item['title'] }}
                            </a>
                            @isset($item['children'])
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink{{ $index }}">
                                    @foreach ($item['children'] as $child)
                                        <a class="dropdown-item"
                                           href="{{ url($item['url'] . $child['url']) }}">{{ $child['title'] }}</a>
                                    @endforeach
                                </div>
                            @endisset
                        </li>
                    @endforeach
                    @if (!empty(request()->project))
                        <li class="nav-item">
                            <a class="nav-link" href="/{{ request()->project }}/items">Search</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/{{ request()->project }}/browse/origins">Browse</a>
                        </li>
                    @endif
                </ul>
                <ul class="navbar-nav">
                    @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link disabled" href="{{ route('login') }}">{{ Auth::user()->name }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="{{ route('logout') }}">Logout</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link disabled" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="{{ route('register') }}">Register</a>
                        </li>
                    @endif
                </ul>


                {{-- needs design
                @if (Auth::guest())
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @else
                    {{ Auth::user()->name }}
                    <a href="{{ route('logout') }}">Logout</a>
                @endif
                --}}

                {{--                @includeWhen(Auth::user(), 'layouts._admin_menu')--}}

                {{--                <ul class="navbar-nav float-right">--}}
                {{--                    @if (Auth::guest())--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a class="text-white" href="{{ route('login') }}">Login</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a class="text-white" href="{{ route('register') }}">Register</a>--}}
                {{--                        </li>--}}
                {{--                    @else--}}
                {{--                        <li class="nav-item dropdown">--}}
                {{--                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                {{--                                <i class="fas fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>--}}
                {{--                            </a>--}}
                {{--                            <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">--}}
                {{--                                <a class="dropdown-item" href="#">My account</a>--}}
                {{--                                <a class="dropdown-item" href="#">Log out</a>--}}
                {{--                            </div>--}}
                {{--                        </li>--}}
                {{--                    @endif--}}
                {{--                </ul>--}}
            </div>
        </nav>
    </div>
</header>
