<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">Stisla</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="active">
          <a href="{{ route('admin.dashboard') }}" class="nav-link"><span>Dashboard</span></a>
        </li>
        {{-- <li class="menu-header">Starter</li>
        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Layout</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
            <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
            <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
          </ul>
        </li> --}}
        {{-- ATTRIBUTES --}}
        <li class="menu-header">Attributes</li>
        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i><span>Attributes</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('admin.industry-types.index') }}">Industry Type</a></li>
            <li><a class="nav-link" href="{{ route('admin.organization-types.index') }}">Organization Type</a></li>
          </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i><span>Location</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ route('admin.country.index') }}">Country</a></li>
              <li><a class="nav-link" href="{{ route('admin.organization-types.index') }}">Organization Type</a></li>
            </ul>
          </li>

      </ul>

             </aside>
  </div>
