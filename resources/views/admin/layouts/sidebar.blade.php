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
                    'admin.job-types.*',
                    'admin.salary-types.*',
                    'admin.tags.*',
                    'admin.job-roles.*',
                    'admin.job-experiences.*',
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
                    <li class="{{ setSideBarActive(['admin.salary-types.*']) }}"><a class="nav-link "
                            href="{{ route('admin.salary-types.index') }}">Salary Type</a></li>
                    <li class="{{ setSideBarActive(['admin.tags.*']) }}"><a class="nav-link "
                            href="{{ route('admin.tags.index') }}">Tag</a></li>
                    <li class="{{ setSideBarActive(['admin.job-roles.*']) }}"><a class="nav-link "
                            href="{{ route('admin.job-roles.index') }}">Job Role</a></li>
                    <li class="{{ setSideBarActive(['admin.job-experiences.*']) }}"><a class="nav-link "
                            href="{{ route('admin.job-experiences.index') }}">Job Experience</a></li>
                </ul>
            </li>

            {{-- PLAN --}}
            <li class="{{ setSideBarActive(['admin.job-categories.*']) }}"><a class="nav-link"
                    href="{{ route('admin.job-categories.index') }}"><i class="far fa-square"></i> <span>Job
                        Categories</span></a>
            </li>
            <li class="{{ setSideBarActive(['admin.jobs.*']) }}"><a class="nav-link"
                    href="{{ route('admin.jobs.index') }}"><i class="far fa-square"></i> <span>
                        Job Post</span></a>
            </li>
            <li class="{{ setSideBarActive(['admin.blogs.*']) }}"><a class="nav-link"
                    href="{{ route('admin.blogs.index') }}"><i class="far fa-square"></i> <span>
                        Blogs</span></a>
            </li>

            {{-- LOCATION --}}
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

            {{-- Section --}}
            <li
                class="dropdown {{ setSideBarActive(['admin.heros.*', 'admin.whyChooseUs.*', 'admin.learnMores.*', 'admin.job-location.*']) }}">
                <a href="#" class="nav-link has-dropdown " data-toggle="dropdown"><i
                        class="fas fa-map-marker-alt"></i><span>Section</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setSideBarActive(['admin.heros.*']) }}"><a class="nav-link "
                            href="{{ route('admin.heros.index') }}">Hero Section</a></li>
                    <li class="{{ setSideBarActive(['admin.whyChooseUs.*']) }}"><a class="nav-link "
                            href="{{ route('admin.whyChooseUs.index') }}">Why Choose Us Section</a></li>
                    <li class="{{ setSideBarActive(['admin.learnMores.*']) }}"><a class="nav-link "
                            href="{{ route('admin.learnMores.index') }}">Learn More Section</a></li>
                    <li class="{{ setSideBarActive(['admin.job-location.*']) }}"><a class="nav-link "
                            href="{{ route('admin.job-location.index') }}">Job Location Section</a></li>

                </ul>
            </li>

            {{-- Page --}}
            <li class="dropdown {{ setSideBarActive(['admin.about-us.*']) }}">
                <a href="#" class="nav-link has-dropdown " data-toggle="dropdown"><i
                        class="fas fa-map-marker-alt"></i><span>Page</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setSideBarActive(['admin.about-us.*']) }}"><a class="nav-link "
                            href="{{ route('admin.about-us.index') }}">About us page</a></li>

                </ul>
            </li>

            {{-- PLAN --}}
            <li class="{{ setSideBarActive(['admin.plans.*']) }}"><a class="nav-link"
                    href="{{ route('admin.plans.index') }}"><i class="far fa-square"></i> <span>Price Plan</span></a>
            </li>
            {{-- PLAN --}}
            <li class="{{ setSideBarActive(['admin.menu-builder.*']) }}"><a class="nav-link"
                    href="{{ route('admin.menu-builder.index') }}"><i class="far fa-square"></i> <span>Menu Builder</span></a>
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

            <li class="{{ setSideBarActive(['admin.news-letter.index']) }}"><a class="nav-link"
                    href="{{ route('admin.news-letter.index') }}"><i class="far fa-square"></i>
                    Subscribe<span></span></a>
            </li>

        </ul>
    </aside>
</div>
