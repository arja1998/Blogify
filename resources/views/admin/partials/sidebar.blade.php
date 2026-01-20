<nav class="sidebar sidebar-offcanvas">
    <ul class="nav">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

       <li class="nav-item">
       <a class="nav-link" href="{{ route('admin.users.index') }}">
        <span class="menu-title">Users</span>
       </a>
       </li>

        <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.blogs.index') }}">
        <span class="menu-title">Blogs</span>
        </a>
         </li>

       <li class="nav-item">
       <a class="nav-link" href="{{ route('admin.comments.index') }}">
        <span class="menu-title">Comments</span>
       </a>
       </li>

       <li class="nav-item">
       <a class="nav-link" href="{{ route('admin.categories.index') }}">
        <span class="menu-title">Categories</span>
       </a>
       </li>

       <li class="nav-item">
       <a class="nav-link" href="{{ route('admin.tags.index') }}">
        <span class="menu-title">Tags</span>
       </a>
       </li>

    </ul>
</nav>
