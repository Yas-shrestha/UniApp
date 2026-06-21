<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="" class="app-brand-link">
            <span class="demo menu-text fw-bolder ms-2 fs-3"><span class="text-primary">UniApp</span></span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ Route::is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Category and Reservation</span>
        </li>

        <li class="menu-item {{ Route::is('admin.categories.*') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="fa-solid fa-layer-group"></i>
                <div data-i18n="Account Settings" class="ms-1">Categories</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.categories.index') }}" class="menu-link">
                        <div data-i18n="Notifications">Manage</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.categories.create') }}" class="menu-link">
                        <div>Add New</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ Route::is('admin.registrations.*') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="fa-solid fa-plus"></i>
                <div data-i18n="Account Settings" class="ms-1">Event Reservation</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.registrations.index') }}" class="menu-link">
                        <div data-i18n="Notifications">Manage</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ Route::is('admin.contact.*') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="fa-solid fa-phone"></i>
                <div data-i18n="Account Settings" class="ms-1">Contact</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.contact.index') }}" class="menu-link">
                        <div data-i18n="Notifications">Contact</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Events & Services</span>
        </li>

        <li class="menu-item {{ Route::is('admin.services.*') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="fa-solid fa-screwdriver-wrench"></i>
                <div data-i18n="Account Settings" class="ms-1">Services</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.services.index') }}" class="menu-link">
                        <div data-i18n="Notifications">Manage</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.services.create') }}" class="menu-link">
                        <div>Add New</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ Route::is('admin.events.*') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="fa fa-picture-o" aria-hidden="true"></i>
                <div data-i18n="Account Settings" class="ms-1">Events</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.events.index') }}" class="menu-link">
                        <div data-i18n="Notifications">Manage</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.events.create') }}" class="menu-link">
                        <div>Add New</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Blogs</span>
        </li>

        <li class="menu-item {{ Route::is('admin.blogs.*') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="fa-solid fa-blog"></i>
                <div data-i18n="Account Settings" class="ms-1">Blogs</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.blogs.index') }}" class="menu-link">
                        <div>Manage</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.blogs.create') }}" class="menu-link">
                        <div>Add New</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Account</span>
        </li>

     
        <li class="menu-item">
            <a href="{{ route('logout') }}" class="menu-link"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-right-from-bracket"></i>
                <div class="ms-1">Logout</div>
            </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </ul>
</aside>