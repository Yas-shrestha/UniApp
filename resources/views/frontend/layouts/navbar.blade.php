<body class="index-page">
    <!-- Header -->
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div
            class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto me-xl-0">
                <h1 class="sitename">Grandview</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li>
                        <a href="{{ route('services') }}"
                            class="{{ request()->routeIs('services') || request()->routeIs('services.detail') ? 'active' : '' }}">
                            Services
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('our-story') }}"
                            class="{{ request()->routeIs('our-story') ? 'active' : '' }}">
                            Our Story
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">
                            About us
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('events.index') }}"
                            class="{{ request()->routeIs('events.index') || request()->routeIs('events.show') ? 'active' : '' }}">
                            Events
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('blogs') }}"
                            class="{{ request()->routeIs('blogs') || request()->routeIs('blogs.show') ? 'active' : '' }}">
                            Blog
                        </a>
                    </li>
                </ul>

                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="{{ route('contact') }}" style="background: #997122; border-color: #997122">
                Contact US
            </a>
        </div>
    </header>
@if(session('success'))
<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999;">
    <div class="toast show" role="alert">
        <div class="toast-header bg-success text-white">
            <i class="bi bi-check-circle-fill me-2"></i>
            <strong class="me-auto">Review Submitted</strong>
            <button type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="toast"></button>
        </div>

        <div class="toast-body">
            {{ session('success') }}
        </div>
    </div>
</div>
@endif