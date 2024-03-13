<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ setSideBarActive(['admin.dashboard']) }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><span>Dashboard</span></a>
            </li>

            <li class="{{ setSideBarActive(['admin.payment-settings.index']) }}"><a class="nav-link"
                    href="{{ route('admin.payment-settings.index') }}"><i class="far fa-square"></i> <span>Payment
                        Setting</span></a>
            </li>

            {{-- ATTRIBUTES --}}
            <li class="menu-header">Attributes</li>
            <li
                class="dropdown {{ setSideBarActive([
                    'admin.industry-types.*',
                    'admin.organization-types.*',
                    'admin.languages.*',
                    'admin.professions.*',
                    'admin.skills.*',
                    'admin.education.*',
                    'admin.job-types.*'
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i><span>Attributes</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setSideBarActive(['admin.industry-types.*']) }}"><a class="nav-link "
                            href="{{ route('admin.industry-types.index') }}">Industry Type</a></li>
                    <li class="{{ setSideBarActive(['admin.organization-types.*']) }}"><a class="nav-link "
                            href="{{ route('admin.organization-types.index') }}">Organization Type</a></li>
                    <li class="{{ setSideBarActive(['admin.languages.*']) }}"><a class="nav-link "
                            href="{{ route('admin.languages.index') }}">Language</a></li>
                    <li class="{{ setSideBarActive(['admin.professions.*']) }}"><a class="nav-link "
                            href="{{ route('admin.professions.index') }}">Profession</a></li>
                    <li class="{{ setSideBarActive(['admin.skills.*']) }}"><a class="nav-link "
                            href="{{ route('admin.skills.index') }}">Skill</a></li>
                    <li class="{{ setSideBarActive(['admin.education.*']) }}"><a class="nav-link "
                            href="{{ route('admin.education.index') }}">Education</a></li>
                    <li class="{{ setSideBarActive(['admin.job-types.*']) }}"><a class="nav-link "
                            href="{{ route('admin.job-types.index') }}">Job Type</a></li>
                </ul>
            </li>

            {{-- PLAN --}}
            <li class="{{ setSideBarActive(['admin.job-categories.*']) }}"><a class="nav-link"
                    href="{{ route('admin.job-categories.index') }}"><i class="far fa-square"></i> <span>Job
                        Categories</span></a>
            </li>

            {{-- LOCATION --}}
            <li class="menu-header">Location</li>
            <li class="dropdown {{ setSideBarActive(['admin.country.*', 'admin.province.*', 'admin.district.*']) }}">
                <a href="#" class="nav-link has-dropdown " data-toggle="dropdown"><i
                        class="fas fa-map-marker-alt"></i><span>Location</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setSideBarActive(['admin.country.*']) }}"><a class="nav-link "
                            href="{{ route('admin.country.index') }}">Countries</a></li>
                    <li class="{{ setSideBarActive(['admin.province.*']) }}"><a class="nav-link "
                            href="{{ route('admin.province.index') }}">Provinces</a></li>
                    <li class="{{ setSideBarActive(['admin.district.*']) }}"><a class="nav-link "
                            href="{{ route('admin.district.index') }}">Districts</a></li>
                </ul>
            </li>

            {{-- PLAN --}}
            <li class="{{ setSideBarActive(['admin.plans.*']) }}"><a class="nav-link"
                    href="{{ route('admin.plans.index') }}"><i class="far fa-square"></i> <span>Price Plan</span></a>
            </li>

            {{-- Payment setting --}}
            <li class="{{ setSideBarActive(['admin.orders.index']) }}"><a class="nav-link"
                    href="{{ route('admin.orders.index') }}"><i class="far fa-square"></i><span>Orders</span></a>
            </li>

            {{-- Site setting --}}
            <li class="{{ setSideBarActive(['admin.site-settings.index']) }}"><a class="nav-link"
                    href="{{ route('admin.site-settings.index') }}"><i class="far fa-square"></i> <span>Site
                        Setting</span></a>
            </li>

        </ul>
    </aside>
</div>
