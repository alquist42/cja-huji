<div class="container-fluid bg-light">
    <!--Navbar -->
    <nav class="mb-1 navbar navbar-expand-lg navbar-dark bg-dark text-white">

        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ url('/') }}">
            The Bezalel Narkiss Index of Jewish Art
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
                aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-4">

            @includeWhen(Auth::user(), 'layouts._admin_menu')

            <ul class="navbar-nav ml-auto">
                @if (Auth::guest())
                    <li class="nav-item"><a class="text-white" href="{{ route('login') }}">Login</a></li>
                    <span class="mx-1">|</span>
                    <li class="nav-item"><a class="text-white" href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span> </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
                            <a class="dropdown-item" href="#">My account</a>
                            <a class="dropdown-item" href="#">Log out</a>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</div>
