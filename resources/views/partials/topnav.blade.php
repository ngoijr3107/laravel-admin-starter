<header class="topnav">
  <button class="icon-btn" id="sidebarToggle" aria-label="Toggle sidebar"><i class="bi bi-list"></i></button>

  <div class="search-pill" id="topbarSearchTrigger" role="button" aria-label="Open command palette">
    <i class="bi bi-search"></i>
    <input type="text" placeholder="Search anything..." readonly style="cursor:pointer;">
    <kbd>⌘K</kbd>
  </div>

  <div class="d-flex align-items-center gap-2 ms-auto">
    <button class="icon-btn d-none d-md-flex" id="fullscreenToggle" title="Fullscreen" aria-label="Toggle fullscreen"><i class="bi bi-arrows-fullscreen" id="fullscreenIcon"></i></button>
    <button class="icon-btn" title="Messages"><i class="bi bi-envelope"></i><span class="dot"></span></button>
    <button class="icon-btn" title="Notifications"><i class="bi bi-bell"></i><span class="dot"></span></button>

    <div class="theme-toggle" id="themeToggle" role="button" aria-label="Toggle dark mode">
      <div class="knob"><i class="bi bi-sun-fill" id="themeIcon"></i></div>
    </div>

    <div class="dropdown">
      <div class="avatar-btn" data-bs-toggle="dropdown">
        <div class="avatar-img">{{ Auth::check() ? Str::of(Auth::user()->name)->explode(' ')->map(fn($p) => Str::substr($p, 0, 1))->implode('') : 'AK' }}</div>
        <div class="d-none d-lg-block">
          <div style="font-size:.82rem; font-weight:600; line-height:1.1;">{{ Auth::check() ? Auth::user()->name : 'Amara Kessler' }}</div>
          <div style="font-size:.7rem; color:var(--text-secondary);">Administrator</div>
        </div>
        <i class="bi bi-chevron-down text-secondary-c d-none d-lg-block" style="font-size:.7rem;"></i>
      </div>
      <ul class="dropdown-menu dropdown-menu-end mt-2">
        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
        <li><a class="dropdown-item" href="#"><i class="bi bi-credit-card me-2"></i>Billing</a></li>
        <li><hr class="dropdown-divider"></li>
        <li>
          @if (Route::has('logout'))
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Sign out</button>
            </form>
          @else
            <a class="dropdown-item text-danger" href="{{ route('login') }}"><i class="bi bi-box-arrow-right me-2"></i>Sign out</a>
          @endif
        </li>
      </ul>
    </div>
  </div>
</header>
