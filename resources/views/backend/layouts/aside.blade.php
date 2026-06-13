        <!-- Menu -->


        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">

                <a href="" class="app-brand-link">
                    <span class=" demo menu-text fw-bolder ms-2 fs-3"><span class="text-primary">Print</span>ifyIt
                </a>


                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
                <!-- Dashboard -->
                <li class="menu-item  {{ Route::is('admin') ? 'active' : '' }}">
                    <a href="/admin/" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Analytics">Dashboard</div>
                    </a>
                </li>

                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Category and reservation</span>
                </li>
                <li class="menu-item {{ Route::is('categories.index') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                        <div data-i18n="Account Settings" class="ms-1">Categories</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('categories.index') }}" class="menu-link">
                                <div data-i18n="Notifications">Manage</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">File and Resources</span>
                </li>
                <li class="menu-item {{ Route::is('files.index') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="fa fa-folder" aria-hidden="true"></i>
                        <div data-i18n="Account Settings" class="ms-1">Files</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('files.index') }}" class="menu-link">
                                <div data-i18n="Notifications">Manage</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item {{ Route::is('services.index') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <div data-i18n="Account Settings" class="ms-1">service</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('services.index') }}" class="menu-link">
                                <div data-i18n="Notifications">Manage</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item {{ Route::is('events.index') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="fa fa-picture-o" aria-hidden="true"></i>
                        <div data-i18n="Account Settings" class="ms-1">event</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('events.index') }}" class="menu-link">
                                <div data-i18n="Notifications">Manage</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Log out</span>
                </li>
                <li class="menu-item">
                    <a href="{{ route('logout') }}" class="menu-link "
                        onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp;
                        <div class="ms-1">Logout</div>
                    </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
        </aside>
        <!-- / Menu -->
