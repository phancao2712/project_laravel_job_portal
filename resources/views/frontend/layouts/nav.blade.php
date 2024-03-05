<nav class="nav-main-menu">
    <ul class="main-menu">
      <li class="has-children"><a class="active" href="index.html">Home</a></li>
      <li class="has-children"><a href="jobs-list.html">Find a Job</a></li>
      <li class="has-children"><a href="{{ route('companies.index') }}">Recruiters</a></li>
      <li class="has-children"><a href="{{ route('candidates.index') }}">Candidates</a></li>
      <li class="has-children"><a href="blog-grid.html">Pages</a>
        <ul class="sub-menu">
          <li><a href="page-about.html">About Us</a></li>
          <li><a href="page-pricing.html">Pricing Plan</a></li>
          <li><a href="page-contact.html">Contact Us</a></li>
          <li><a href="page-register.html">Register</a></li>
          <li><a href="{{ route('login') }}">Signin</a></li>
          <li><a href="page-reset-password.html">Reset Password</a></li>
          <li><a href="blog-details.html">Blog Single</a></li>
        </ul>
      </li>
      <li class="has-children"><a href="blog-grid.html">Blog</a></li>
    </ul>
  </nav>
