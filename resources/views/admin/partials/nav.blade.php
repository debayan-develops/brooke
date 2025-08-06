<aside class="aside is-placed-left is-expanded">
  <div class="aside-tools">
    <div>
      Admin <b class="font-black">CHE</b>
    </div>
  </div>
  <div class="menu is-menu-main">
    <p class="menu-label">General</p>
    <ul class="menu-list">
      <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a href="{{ route('admin.dashboard') }}">
          <span class="icon"><i class="mdi mdi-desktop-classic"></i></span>
          <span class="menu-item-label">Dashboard</span>
        </a>
      </li>
      <li class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
        <a href="{{ route('admin.users') }}">
          <span class="icon"><i class="mdi mdi-account-circle"></i></span>
          <span class="menu-item-label">Users</span>
        </a>
      </li>
    </ul>
    <p class="menu-label">Utilities</p>
    <ul class="menu-list">
      <li class="--set-active-tables-html {{ request()->routeIs('admin.homes') ? 'active' : '' }}">
        <a href="{{ route('admin.homes') }}">
          <span class="icon"><i class="mdi mdi-home"></i></span>
          <span class="menu-item-label">Homes</span>
        </a>
      </li>
      <li class="--set-active-forms-html {{ request()->routeIs('admin.pages') ? 'active' : '' }}">
        <a href="{{ route('admin.pages') }}">
          <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
          <span class="menu-item-label">Pages</span>
        </a>
      </li>
      <li class="--set-active-profile-html">
        <a href="#">
          <span class="icon"><i class="mdi mdi-cog"></i></span>
          <span class="menu-item-label">Settings</span>
        </a>
      </li>
      {{-- <li>
        <a class="dropdown">
          <span class="icon"><i class="mdi mdi-view-list"></i></span>
          <span class="menu-item-label">Submenus</span>
          <span class="icon"><i class="mdi mdi-plus"></i></span>
        </a>
        <ul>
          <li>
            <a href="#void">
              <span>Sub-item One</span>
            </a>
          </li>
          <li>
            <a href="#void">
              <span>Sub-item Two</span>
            </a>
          </li>
        </ul>
      </li> --}}
    </ul>
    
  </div>
</aside>