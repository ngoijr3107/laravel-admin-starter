<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
<meta charset="UTF-8">
<script>
/* Set theme before first paint to avoid a light-mode flash on reload */
(function(){
  var t = localStorage.getItem('creativepro-theme');
  if(!t){ t = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'; }
  document.documentElement.setAttribute('data-theme', t);
})();
</script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'CreativePro') &mdash; Admin Dashboard</title>

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

<!-- Bootstrap 5.3 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">

<!-- CreativePro design system -->
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

@stack('styles')
</head>
<body>

<div class="page-loader-bar" id="pageLoaderBar"></div>

<div class="mobile-overlay" id="mobileOverlay"></div>
<div class="sidebar-tooltip" id="sidebarTooltip"></div>
@include('partials.command-palette')

<div class="app-shell">

  @include('partials.sidebar')
  <script>
  /* Restore collapsed sidebar state before first paint — CDN stylesheets
     are still render-blocking at this point, so this never flashes. */
  if (localStorage.getItem('creativepro-sidebar-collapsed') === '1') {
    document.getElementById('sidebar').classList.add('collapsed');
  }
  </script>

  <div class="main-wrap">

    @include('partials.topnav')

    <main class="content">
      @yield('content')
    </main>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
@stack('vendor-scripts')

<script src="{{ asset('js/app.js') }}"></script>

@stack('scripts')

</body>
</html>
