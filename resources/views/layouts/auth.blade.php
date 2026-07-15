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
<title>@yield('title', 'Sign in') &mdash; CreativePro</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">

<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@stack('styles')
</head>
<body>

<div class="auth-shell">

  <!-- BRAND / STORY PANEL -->
  <div class="brand-panel">
    <div class="d-flex align-items-center gap-2">
      <div class="brand-mark-lg">N</div>
      <div class="brand-name">CreativePro</div>
    </div>

    <div class="floaty-card d-none d-lg-block">
      <div class="fc-label">Today's Revenue</div>
      <div class="fc-val">$18,204</div>
      <div style="font-size:.72rem; color:#86efac; margin-top:4px;"><i class="bi bi-arrow-up-short"></i> 9.2% vs yesterday</div>
    </div>

    <div class="brand-quote">
      <h2>@yield('brand-heading', 'Run your entire business from one calm, uncluttered screen.')</h2>
      <p>@yield('brand-subtext', 'CreativePro brings your revenue, orders, customers and team into a single workspace built for speed.')</p>
      <div class="stat-strip">
        <div><div class="num">12k+</div><div class="lbl">Teams</div></div>
        <div><div class="num">99.98%</div><div class="lbl">Uptime</div></div>
        <div><div class="num">4.9/5</div><div class="lbl">Rating</div></div>
      </div>
    </div>

    <div class="brand-footer">&copy; {{ date('Y') }} CreativePro Enterprise Suite. All rights reserved.</div>
  </div>

  <!-- FORM PANEL -->
  <div class="form-panel position-relative">
    <div class="theme-toggle-mini" id="themeToggle" role="button" aria-label="Toggle dark mode"><i class="bi bi-sun-fill" id="themeIcon"></i></div>

    @yield('form')
  </div>
</div>

<script>
const root = document.documentElement;
const themeToggle = document.getElementById('themeToggle');
const themeIcon = document.getElementById('themeIcon');
function applyTheme(t){ root.setAttribute('data-theme', t); themeIcon.className = t==='dark' ? 'bi bi-moon-stars-fill':'bi bi-sun-fill'; localStorage.setItem('creativepro-theme', t); }
applyTheme(localStorage.getItem('creativepro-theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark':'light'));
themeToggle.addEventListener('click', () => applyTheme(root.getAttribute('data-theme')==='dark' ? 'light':'dark'));
</script>

@stack('scripts')

</body>
</html>
