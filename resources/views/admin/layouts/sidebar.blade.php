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

            <li class="{{ setSidebarActive(['admin.dashboard']) }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>

            </li>
            <li class="menu-header">Starter</li>
            @if (canAccess(['order index']))
                <li class="{{ setSidebarActive(['admin.orders.*']) }}"><a class="nav-link"
                        href="{{ route('admin.orders.index') }}"><i class="fas fa-cart-plus"></i>
                        <span>Orders</span></a></li>
            @endif

            @if (canAccess(['job category create', 'job category update', 'job category delete']))
                <li class="{{ setSidebarActive(['admin.job-categories.*']) }}"><a class="nav-link"
                        href="{{ route('admin.job-categories.index') }}"><i class="fas fa-list"></i> <span>Job
                            Category</span></a></li>
            @endif

            @if (canAccess(['job create', 'job update', 'job delete']))
                <li class="{{ setSidebarActive(['admin.jobs.*']) }}"><a class="nav-link"
                        href="{{ route('admin.jobs.index') }}"><i class="fas fa-briefcase"></i> <span>Job
                            Post</span></a></li>
            @endif

            @if (canAccess(['job role']))
                <li class="{{ setSidebarActive(['admin.job-roles.*']) }}"><a class="nav-link"
                        href="{{ route('admin.job-roles.index') }}"><i class="fas fa-user-md"></i> <span>Job
                            Roles</span></a></li>
            @endif

            @if (canAccess(['job attributes']))
                <li
                    class="dropdown {{ setSidebarActive([
                        'admin.industry-types.*',
                        'admin.organization-types.*',
                        'admin.languages.*',
                        'admin.professions.*',
                        'admin.skills.*',
                        'admin.education.*',
                        'admin.job-types.*',
                        'admin.salary-types.*',
                        'admin.tags.*',
                        'admin.job-experiences.*',
                    ]) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-columns"></i>
                        <span>Attributes</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.industry-types.*']) }}"><a class="nav-link"
                                href="{{ route('admin.industry-types.index') }}">Industry Type</a></li>
                        <li class="{{ setSidebarActive(['admin.organization-types.*']) }}"><a class="nav-link"
                                href="{{ route('admin.organization-types.index') }}">Orginization Type</a></li>

                        <li class="{{ setSidebarActive(['admin.languages.*']) }}"><a class="nav-link"
                                href="{{ route('admin.languages.index') }}">Languages</a></li>

                        <li class="{{ setSidebarActive(['admin.professions.*']) }}"><a class="nav-link"
                                href="{{ route('admin.professions.index') }}">Professions</a></li>

                        <li class="{{ setSidebarActive(['admin.skills.*']) }}"><a class="nav-link"
                                href="{{ route('admin.skills.index') }}">Skills</a></li>
                        <li class="{{ setSidebarActive(['admin.education.*']) }}"><a class="nav-link"
                                href="{{ route('admin.education.index') }}">Educations</a></li>
                        <li class="{{ setSidebarActive(['admin.job-types.*']) }}"><a class="nav-link"
                                href="{{ route('admin.job-types.index') }}">Job Types</a></li>
                        <li class="{{ setSidebarActive(['admin.salary-types.*']) }}"><a class="nav-link"
                                href="{{ route('admin.salary-types.index') }}">Salary Types</a></li>
                        <li class="{{ setSidebarActive(['admin.tags.*']) }}"><a class="nav-link"
                                href="{{ route('admin.tags.index') }}">Tags</a></li>
                        <li class="{{ setSidebarActive(['admin.job-experiences.*']) }}"><a class="nav-link"
                                href="{{ route('admin.job-experiences.index') }}">Experiences</a></li>
                    </ul>
                </li>
            @endif

            @if (canAccess(['job location']))
                <li class="dropdown {{ setSidebarActive(['admin.country.*', 'admin.province.*', 'admin.district.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-map"></i>
                        <span>Locations</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.country.*']) }}"><a class="nav-link"
                                href="{{ route('admin.country.index') }}">Countries</a></li>
                        <li class="{{ setSidebarActive(['admin.province.*']) }}"><a class="nav-link"
                                href="{{ route('admin.province.index') }}">Province</a></li>
                        <li class="{{ setSidebarActive(['admin.district.*']) }}"><a class="nav-link"
                                href="{{ route('admin.district.index') }}">District</a></li>


                    </ul>
                </li>
            @endif

            @if (canAccess(['sections']))
                <li
                    class="dropdown {{ setSidebarActive([
                        'admin.heros.index',
                        'admin.whyChooseUs.index',
                        'admin.learnMores.*',
                        'admin.job-location.*',
                    ]) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-puzzle-piece"></i>
                        <span>Sections</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.heros.index']) }}"><a class="nav-link"
                                href="{{ route('admin.heros.index') }}">Hero</a></li>
                        <li class="{{ setSidebarActive(['admin.whyChooseUs.*']) }}"><a class="nav-link"
                                href="{{ route('admin.whyChooseUs.index') }}">Why Choose Us</a></li>
                        <li class="{{ setSidebarActive(['admin.learnMores.*']) }}"><a class="nav-link"
                                href="{{ route('admin.learnMores.index') }}">Learn More</a></li>

                        <li class="{{ setSidebarActive(['admin.job-location.*']) }}"><a class="nav-link"
                                href="{{ route('admin.job-location.index') }}">Job Locations</a></li>
                    </ul>
                </li>
            @endif

            @if (canAccess(['site pages']))
                <li class="dropdown {{ setSidebarActive(['admin.about-us.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-file"></i>
                        <span>Pages</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.about-us.*']) }}"><a class="nav-link"
                                href="{{ route('admin.about-us.index') }}">About us</a></li>


                    </ul>
                </li>
            @endif

            @if (canAccess(['site footer']))
                <li class="dropdown {{ setSidebarActive(['admin.footer.*', 'admin.social-icons.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-shoe-prints"></i>
                        <span>Footer</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.footer.*']) }}"><a class="nav-link"
                                href="{{ route('admin.footer.index') }}">Footer Details</a></li>

                        <li class="{{ setSidebarActive(['admin.social-icons.*']) }}"><a class="nav-link"
                                href="{{ route('admin.social-icons.index') }}">Social Icons</a></li>
                    </ul>
                </li>
            @endif

            @if (canAccess(['blogs']))
                <li class="{{ setSidebarActive(['admin.blogs.*']) }}"><a class="nav-link"
                        href="{{ route('admin.blogs.index') }}"><i class="fab fa-blogger-b"></i>
                        <span>Blogs</span></a></li>
            @endif
            @if (canAccess(['price plan']))
                <li class="{{ setSidebarActive(['admin.plans.*']) }}"><a class="nav-link"
                        href="{{ route('admin.plans.index') }}"><i class="fas fa-box"></i> <span>Price
                            Plan</span></a></li>
            @endif

            @if (canAccess(['news letter']))
                <li class="{{ setSidebarActive(['admin.news-letter.*']) }}"><a class="nav-link"
                        href="{{ route('admin.news-letter.index') }}"><i class="fas fa-mail-bulk"></i>
                        <span>Newsletter</span></a></li>
            @endif

            @if (canAccess(['menu builder']))
                <li class="{{ setSidebarActive(['admin.menu-builder.*']) }}"><a class="nav-link"
                        href="{{ route('admin.menu-builder.index') }}"><i class="fas fa-shapes"></i> <span>Menu
                            Builder</span></a></li>
            @endif

            @if (canAccess(['access management']))
                <li class="dropdown {{ setSidebarActive(['admin.role-user.*', 'admin.role-permission.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-user-shield"></i>
                        <span>Access Management</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.role-user.*']) }}"><a class="nav-link"
                                href="{{ route('admin.role-user.index') }}">Role Users</a></li>
                        <li class="{{ setSidebarActive(['admin.role-permission.*']) }}"><a class="nav-link"
                                href="{{ route('admin.role-permission.index') }}">Roles</a></li>
                    </ul>
                </li>
            @endif

            @if (canAccess(['payment settings']))
                <li class="{{ setSidebarActive(['admin.payment-settings.index']) }}"><a class="nav-link"
                        href="{{ route('admin.payment-settings.index') }}"><i class="fas fa-wrench"></i>
                        <span>Payment Settings</span></a></li>
            @endif

            @if (canAccess(['site settings']))
                <li class="{{ setSidebarActive(['admin.payment-settings.index']) }}"><a class="nav-link"
                        href="{{ route('admin.site-settings.index') }}"><i class="fas fa-cog"></i> <span>Site
                            Settings</span></a></li>
            @endif

            @if (canAccess(['database clear']))
                <li class="{{ setSidebarActive(['admin.clear-database.index']) }}"><a class="nav-link"
                        href="{{ route('admin.clear-database.index') }}"><i class="fas fa-skull-crossbones"></i>
                        <span>Clear Database</span></a></li>
            @endif

        </ul>
    </aside>
</div>
