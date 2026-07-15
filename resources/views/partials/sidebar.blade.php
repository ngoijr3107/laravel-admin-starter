<aside class="sidebar" id="sidebar">
  <div class="brand">
    <div class="brand-mark">N</div>
    <div class="brand-text">Nimbus <small>Enterprise Suite</small></div>
  </div>

  <nav class="sidebar-scroll">
    <div class="nav-section-label">Overview</div>
    <ul class="list-unstyled">
      <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}" class="nav-link"><i class="bi bi-grid-1x2-fill"></i><span class="nav-label">Dashboard</span></a>
      </li>
      <li class="nav-item">
        <a href="{{ route('dashboard') }}#analytics" class="nav-link"><i class="bi bi-bar-chart-line"></i><span class="nav-label">Analytics</span></a>
      </li>
      <li class="nav-item">
        <a href="{{ route('dashboard') }}#reports" class="nav-link"><i class="bi bi-file-earmark-bar-graph"></i><span class="nav-label">Reports</span><span class="nav-badge">New</span></a>
      </li>
    </ul>

    <div class="nav-section-label">Business</div>
    <ul class="list-unstyled">
      <li class="nav-item">
        <a href="{{ route('dashboard') }}#customers" class="nav-link"><i class="bi bi-people"></i><span class="nav-label">Customers</span></a>
      </li>
      <li class="nav-item">
        <a href="{{ route('dashboard') }}#products" class="nav-link"><i class="bi bi-box-seam"></i><span class="nav-label">Products</span></a>
      </li>
      <li class="nav-item">
        <a href="{{ route('dashboard') }}#orders" class="nav-link"><i class="bi bi-receipt"></i><span class="nav-label">Orders</span><span class="nav-badge">12</span></a>
      </li>
      <li class="nav-item">
        <a href="{{ route('dashboard') }}#finance" class="nav-link"><i class="bi bi-cash-coin"></i><span class="nav-label">Finance</span></a>
      </li>
      <li class="nav-item">
        <a href="{{ route('dashboard') }}#projects" class="nav-link"><i class="bi bi-kanban"></i><span class="nav-label">Projects</span></a>
      </li>
    </ul>

    <div class="nav-section-label">Workspace</div>
    <ul class="list-unstyled">
      <li class="nav-item">
        <a href="{{ route('dashboard') }}#messages" class="nav-link"><i class="bi bi-chat-dots"></i><span class="nav-label">Messages</span></a>
      </li>
      <li class="nav-item">
        <a href="{{ route('dashboard') }}#calendar" class="nav-link"><i class="bi bi-calendar3"></i><span class="nav-label">Calendar</span></a>
      </li>
      <li class="nav-item">
        <a href="{{ route('dashboard') }}#files" class="nav-link"><i class="bi bi-folder2-open"></i><span class="nav-label">Files</span></a>
      </li>
      <li class="nav-item {{ request()->routeIs('tables') ? 'open' : '' }}" id="tablesGroup">
        <a href="#" class="nav-link" onclick="toggleSubmenu(event,'tablesGroup')"><i class="bi bi-table"></i><span class="nav-label">Data Views</span><i class="bi bi-chevron-right nav-caret"></i></a>
        <ul class="submenu">
          <li><a href="{{ route('tables') }}" class="{{ request()->routeIs('tables') ? 'active' : '' }}">All Tables</a></li>
          <li><a href="{{ route('tables') }}#advanced">Advanced Tables</a></li>
          <li><a href="{{ route('tables') }}#exports">Exports</a></li>
        </ul>
      </li>
    </ul>

    <div class="nav-section-label">UI Kit</div>
    <ul class="list-unstyled">
      <li class="nav-item {{ request()->routeIs('components') ? 'active' : '' }}">
        <a href="{{ route('components') }}" class="nav-link"><i class="bi bi-grid-3x3-gap"></i><span class="nav-label">Components</span><span class="nav-badge">36</span></a>
      </li>
    </ul>

    <div class="nav-section-label">System</div>
    <ul class="list-unstyled">
      <li class="nav-item">
        <a href="{{ route('dashboard') }}#settings" class="nav-link"><i class="bi bi-gear"></i><span class="nav-label">Settings</span></a>
      </li>
      <li class="nav-item {{ request()->routeIs('login') || request()->routeIs('register') || request()->routeIs('password.request') ? 'active' : '' }}">
        <a href="{{ route('login') }}" class="nav-link"><i class="bi bi-shield-lock"></i><span class="nav-label">Authentication</span></a>
      </li>
      <li class="nav-item">
        <a href="{{ route('dashboard') }}#help" class="nav-link"><i class="bi bi-question-circle"></i><span class="nav-label">Help Center</span></a>
      </li>
    </ul>
  </nav>

  <div class="sidebar-footer">
    <div class="storage-widget">
      <div class="d-flex justify-content-between mb-2 sidebar-footer-text">
        <span class="fw-semibold">Storage</span>
        <span class="text-secondary-c">68%</span>
      </div>
      <div class="progress-thin"><div class="bar" style="width:68%"></div></div>
    </div>
  </div>
</aside>
