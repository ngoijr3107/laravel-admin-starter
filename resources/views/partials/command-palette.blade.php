<div class="command-palette-overlay" id="commandPaletteOverlay">
  <div class="command-palette">
    <div class="command-palette-input-wrap">
      <i class="bi bi-search"></i>
      <input type="text" id="commandPaletteInput" placeholder="Search pages, actions..." autocomplete="off">
      <kbd>Esc</kbd>
    </div>
    <ul class="command-palette-list" id="commandPaletteList">
      <li data-href="{{ route('dashboard') }}" data-keywords="dashboard home overview analytics">
        <i class="bi bi-grid-1x2-fill"></i><span>Dashboard</span><span class="cp-hint">Go to page</span>
      </li>
      <li data-href="{{ route('tables') }}" data-keywords="tables data customers orders records">
        <i class="bi bi-table"></i><span>Tables</span><span class="cp-hint">Go to page</span>
      </li>
      <li data-href="{{ route('components') }}" data-keywords="components ui kit buttons forms elements">
        <i class="bi bi-grid-3x3-gap"></i><span>Components</span><span class="cp-hint">Go to page</span>
      </li>
      <li data-action="toggle-theme" data-keywords="dark light theme mode appearance">
        <i class="bi bi-moon-stars"></i><span>Toggle dark mode</span><span class="cp-hint">Action</span>
      </li>
      <li data-action="toggle-sidebar" data-keywords="sidebar collapse expand menu">
        <i class="bi bi-layout-sidebar"></i><span>Toggle sidebar</span><span class="cp-hint">Action</span>
      </li>
      @auth
        <li data-action="logout" data-keywords="sign out log out logout exit">
          <i class="bi bi-box-arrow-right"></i><span>Sign out</span><span class="cp-hint">Action</span>
        </li>
      @else
        <li data-href="{{ route('login') }}" data-keywords="sign in log in login">
          <i class="bi bi-box-arrow-in-right"></i><span>Sign in</span><span class="cp-hint">Go to page</span>
        </li>
      @endauth
    </ul>
    <div class="command-palette-empty" id="commandPaletteEmpty">No matches found.</div>
  </div>
</div>

@auth
  <form method="POST" action="{{ route('logout') }}" id="commandPaletteLogoutForm" class="d-none">
    @csrf
  </form>
@endauth
