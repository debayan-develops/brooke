<aside class="aside is-placed-left is-expanded">
  <div class="aside-tools">
    <div>
      Admin <b class="font-black">Brooke</b>
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
      {{-- <li class="--set-active-tables-html {{ request()->routeIs('admin.homes') ? 'active' : '' }}">
        <a href="{{ route('admin.homes') }}">
          <span class="icon"><i class="mdi mdi-home"></i></span>
          <span class="menu-item-label">Homes</span>
        </a>
      </li> --}}
      <li class="--set-active-forms-html {{ request()->routeIs('admin.pages') ? 'active' : '' }}">
        <a href="{{ route('admin.pages') }}">
          <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
          <span class="menu-item-label">Pages</span>
        </a>
      </li>

      {{-- 
          UPDATED LOGIC:
          We use request()->is('admin/novels*') to check if the URL starts with /admin/novels.
          This ensures the menu stays open for Edit, Add, and Chapter pages.
      --}}
      <li class="--set-active-content-manager-html {{ (request()->routeIs('admin.contentCategory*') || request()->routeIs('admin.tags*') || request()->routeIs('admin.character*') || request()->is('admin/novels*') || request()->is('admin/blogs*') || request()->is('admin/shortStories*') || request()->is('admin/short-stories*')) ? 'active' : '' }}">
        <a class="dropdown">
          <span class="icon"><i class="mdi mdi-view-list"></i></span>
          <span class="menu-item-label">Content Manager</span>
          <span class="icon"><i class="mdi {{ (request()->routeIs('admin.contentCategory*') || request()->routeIs('admin.tags*') || request()->routeIs('admin.character*') || request()->is('admin/novels*') || request()->is('admin/blogs*') || request()->is('admin/shortStories*') || request()->is('admin/short-stories*')) ? 'mdi-minus' : 'mdi-plus' }}"></i></span>
        </a>
        <ul>
          <li class="{{ request()->routeIs('admin.contentCategory*') ? 'active' : '' }}">
            <a href="{{ route('admin.contentCategory') }}">
              <span>Category</span>
            </a>
          </li>
          <li class="{{ request()->routeIs('admin.tags*') ? 'active' : '' }}">
            <a href="{{ route('admin.tags') }}">
              <span>Tags</span>
            </a>
          </li>
          <li class="{{ request()->routeIs('admin.character*') ? 'active' : '' }}">
            <a href="{{ route('admin.character') }}">
              <span>Characters</span>
            </a>
          </li>
          
          <li class="{{ request()->is('admin/novels*') ? 'active' : '' }}">
            <a href="{{ route('admin.novels') }}">
              <span>Novels</span>
            </a>
          </li>
          
          <li class="{{ request()->is('admin/blogs*') ? 'active' : '' }}">
            <a href="{{ route('admin.blogs') }}">
              <span>Blog</span>
            </a>
          </li>
          
          <li class="{{ request()->is('admin/shortStories*') || request()->is('admin/short-stories*') ? 'active' : '' }}">
            <a href="{{ route('admin.shortStories') }}">
              <span>Short Stories</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="--set-active-profile-html">
        <a href="#">
          <span class="icon"><i class="mdi mdi-cog"></i></span>
          <span class="menu-item-label">Settings</span>
        </a>
      </li>
    </ul>
    
  </div>
</aside>