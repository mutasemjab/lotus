@php
    $u = auth('admin')->user();
@endphp

<aside class="sidebar" id="sidebar">

    {{-- Brand --}}
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="bi bi-mortarboard-fill"></i></div>
        <span class="brand-text">{{ __('messages.edu_platform') }}</span>
    </div>

    <nav class="sidebar-nav">

        {{-- ── Main ─────────────────────────────────────────── --}}
        <div class="nav-label">{{ __('messages.main') }}</div>
        <ul>
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-speedometer2"></i>
                    <span>{{ __('messages.dashboard') }}</span>
                </a>
            </li>
        </ul>

        {{-- ── Website Content ──────────────────────────────── --}}
        <div class="nav-label">Website Content</div>
        <ul>
            <li class="nav-item">
                <a href="{{ route('admin.website.hero.edit') }}"
                   class="nav-link {{ request()->routeIs('admin.website.hero.*') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-badge-ad"></i>
                    <span>Hero Section</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.website.marquee.index') }}"
                   class="nav-link {{ request()->routeIs('admin.website.marquee.*') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-arrow-repeat"></i>
                    <span>Marquee Strip</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.website.about.edit') }}"
                   class="nav-link {{ request()->routeIs('admin.website.about.*') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-info-circle"></i>
                    <span>About Section</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.website.services.index') }}"
                   class="nav-link {{ request()->routeIs('admin.website.services.*') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-grid-3x2-gap"></i>
                    <span>Services</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.website.process.index') }}"
                   class="nav-link {{ request()->routeIs('admin.website.process.*') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-list-ol"></i>
                    <span>Process Steps</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.website.trust.index') }}"
                   class="nav-link {{ request()->routeIs('admin.website.trust.*') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-shield-check"></i>
                    <span>Trust Band</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.website.team.index') }}"
                   class="nav-link {{ request()->routeIs('admin.website.team.*') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-people"></i>
                    <span>Team</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.website.contact.index') }}"
                   class="nav-link {{ request()->routeIs('admin.website.contact.*') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-telephone"></i>
                    <span>Contact</span>
                </a>
            </li>
        </ul>


    </nav>

    {{-- Sidebar Footer --}}
    <div class="sidebar-footer">
        <ul>
            <li class="nav-item">
                <a href="{{ route('admin.login.edit', auth('admin')->id()) }}" class="nav-link">
                    <i class="nav-icon bi bi-gear"></i>
                    <span>{{ __('messages.settings') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"
                   onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                    <i class="nav-icon bi bi-box-arrow-right"></i>
                    <span>{{ __('messages.sign_out') }}</span>
                </a>
            </li>
        </ul>
        <button class="sidebar-collapse-btn" id="sidebarCollapseBtn" title="{{ __('messages.collapse_sidebar') }}">
            <i class="bi bi-arrow-bar-left"></i>
        </button>
    </div>

</aside>
