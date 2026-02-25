
<nav class="navbar navbar-expand-sm navbar-dark bg-secondary shadow-sm">
    <div class="container px-2">

        {{-- Brand --}}
        <a class="navbar-brand fw-semibold" href="{{ route('owner.dashboard') }}">
            Parking App
        </a>

        {{-- Toggle mobile --}}
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">

            <div class="ms-auto d-flex flex-column flex-sm-row align-items-start align-items-sm-center">

                {{-- Menu --}}
                <ul class="navbar-nav me-2 py-3">
                    <li class="nav-item">
                        <a class="nav-link nav-strip {{ request()->routeIs('owner.dashboard') ? 'active fw-semibold' : '' }}"
                        href="{{ route('owner.dashboard') }}">
                           Home
                        </a>
                    </li>
                </ul>

                {{-- User Dropdown --}}
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center"
                        href="#"
                        role="button"
                        data-bs-toggle="dropdown">

                            <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center"
                                style="width: 40px; height: 40px;">
                                <span>{{ substr(Auth::user()->username ?? 'U', 0, 1) }}</span>
                            </div>

                            <span class="ms-2">
                                {{ Auth::user()->username ?? 'User' }}
                            </span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>

        </div>
    </div>
</nav>