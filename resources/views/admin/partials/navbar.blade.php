 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex align-items-center">
        <a class="navbar-brand brand-logo" href="{{ route('admin.dashboard') }}">
            Blogify
        </a>
    </div>

    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end ms-auto">

    <!-- Admin Name -->
    <span class="me-3 fw-semibold">
        {{ auth()->user()->name }}
    </span>

    <!-- Notifications -->
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('author'))
        <div class="dropdown me-3">

            <a href="#"
               class="nav-link position-relative"
               id="adminNotificationDropdown"
               role="button"
               data-bs-toggle="dropdown"
               aria-expanded="false"
               onclick="markNotificationsRead()">

                <i class="fa-solid fa-bell"></i>

                @if(auth()->user()->unreadNotifications->count() > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </span>
                @endif
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow"
                aria-labelledby="adminNotificationDropdown"
                style="min-width: 320px">

                @forelse(auth()->user()->unreadNotifications as $notification)
                    <li>
                        <a class="dropdown-item small"
                           href="{{ route('admin.comments.index') }}">
                            {{ $notification->data['message'] }}
                        </a>
                    </li>
                @empty
                    <li class="dropdown-item text-muted small">
                        No new notifications
                    </li>
                @endforelse

            </ul>
        </div>
    @endif

    <!-- Fullscreen -->
    <a href="#" class="nav-link me-3" onclick="toggleFullScreen()">
        <i class="bi bi-arrows-fullscreen fs-5"></i>
    </a>

    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}" class="mb-0">
        @csrf
        <button type="submit" class="btn btn-link nav-link p-0 text-decoration-none">
            Logout
        </button>
    </form>

</div>



</nav>
