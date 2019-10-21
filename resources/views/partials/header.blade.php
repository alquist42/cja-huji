<header>
    <div class="container px-3 my-2">
        <div class="row">
            <div class="float-left">
                <a target="_blank" href="/huji/eng/index_e.htm">
                    <img src="http://cja.huji.ac.il/home/pics/HUJI_Logo-2.png" alt="The Hebrew University of Jerusalem" height="70px"/>
                </a>
            </div>
            <div class="mx-auto py-2 text-center" width="500">
                <h3 class="main-title">The Center for Jewish Art</h3>
                <h5 class="main-subtitle text-muted">The Hebrew University of Jerusalem ({{ request()->project }})</h5>
            </div>
            <div class="float-right">
                <a href="/">
                    <img src="http://cja.huji.ac.il/home/pics/cja-lion-new.png" alt="The Hebrew University of Jerusalem" height="70px" />
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

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
                    aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/catalogue/items">Main</a>
                    </li>
                    @if (!empty(request()->project))
                        <li class="nav-item">
                            <a class="nav-link" href="/{{ request()->project }}/items">Search</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/{{ request()->project }}/browse/origins">Browse</a>
                        </li>
                    @endif
                </ul>


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
