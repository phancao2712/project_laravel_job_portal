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
        <li class="{{ setSideBarActive(['admin.dashboard']) }}">
          <a href="{{ route('admin.dashboard') }}" class="nav-link"><span>Dashboard</span></a>
        </li>

        {{-- ATTRIBUTES --}}
        <li class="menu-header">Attributes</li>
        <li class="dropdown {{ setSideBarActive(['admin.industry-types.*', 'admin.organization-types.*', 'languagues.*']) }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i><span>Attributes</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link {{ setSideBarActive(['admin.industry-types.*']) }}" href="{{ route('admin.industry-types.index') }}">Industry Type</a></li>
            <li><a class="nav-link {{ setSideBarActive(['admin.organization-types.*']) }}" href="{{ route('admin.organization-types.index') }}">Organization Type</a></li>
            <li><a class="nav-link {{ setSideBarActive(['admin.languages.*']) }}" href="{{ route('admin.languages.index') }}">Language</a></li>
          </ul>
        </li>

        {{-- LOCATION --}}
        <li class="menu-header">Location</li>
        <li class="dropdown {{ setSideBarActive(['admin.country.*','admin.province.*','admin.district.*']) }}">
            <a href="#" class="nav-link has-dropdown " data-toggle="dropdown"><i class="fas fa-map-marker-alt"></i><span>Location</span></a>
            <ul class="dropdown-menu">
              <li class="{{ setSideBarActive(['admin.country.*']) }}"><a class="nav-link " href="{{ route('admin.country.index') }}">Countries</a></li>
              <li class="{{ setSideBarActive(['admin.province.*']) }}"><a class="nav-link " href="{{ route('admin.province.index') }}">Provinces</a></li>
              <li class="{{ setSideBarActive(['admin.district.*']) }}"><a class="nav-link " href="{{ route('admin.district.index') }}">Districts</a></li>
            </ul>
          </li>

      </ul>

             </aside>
  </div>
