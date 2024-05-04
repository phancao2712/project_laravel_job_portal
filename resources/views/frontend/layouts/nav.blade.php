<nav class="nav-main-menu">
    <ul class="main-menu">
        <li class="has-children"><a class="active" href="{{ url('/') }}">Home</a></li>
        <li class="has-children"><a href="{{ route('jobs.index') }}">Find a Job</a></li>
        <li class="has-children"><a href="{{ route('companies.index') }}">Recruiters</a></li>
        <li class="has-children"><a href="{{ route('candidates.index') }}">Candidates</a></li>
        <li class="has-children"><a href="blog-grid.html">Pages</a>
            <ul class="sub-menu">
                <li><a href="{{ route('about-page.index') }}">About Us</a></li>
                <li><a href="{{ route('pricing.index') }}">Pricing Plan</a></li>
                <li><a href="{{ route('contact.index') }}">Contact Us</a></li>
            </ul>
        </li>
        <li class="has-children"><a href="{{ route('blogs.index') }}">Blog</a></li>
    </ul>
</nav>
