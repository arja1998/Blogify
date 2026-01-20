<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex align-items-center">
        <a class="navbar-brand brand-logo" href="{{ route('admin.dashboard') }}">
            Blogify
        </a>
    </div>

    <div class="navbar-menu-wrapper d-flex align-items-center ms-auto">
        <ul class="navbar-nav navbar-nav-right">

            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    {{ auth()->user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right navbar-dropdown">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item">
                            Logout
                        </button>
                    </form>
                </div>
            </li>

        </ul>
    </div>
</nav>
