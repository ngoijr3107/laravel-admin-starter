/* ============================================
   THEME ENGINE — persistent + system detect
   ============================================ */
const root = document.documentElement;
const themeToggle = document.getElementById('themeToggle');
const themeIcon = document.getElementById('themeIcon');

function applyTheme(theme){
  root.setAttribute('data-theme', theme);
  themeIcon.className = theme === 'dark' ? 'bi bi-moon-stars-fill' : 'bi bi-sun-fill';
  localStorage.setItem('nimbus-theme', theme);
  // Chart re-render is a "nice to have" — never let it block theme switching itself.
  try { if(typeof renderCharts === 'function') renderCharts(); }
  catch(err){ console.warn('Chart re-render skipped:', err); }
}
const savedTheme = localStorage.getItem('nimbus-theme');
const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
applyTheme(savedTheme || (systemDark ? 'dark' : 'light'));

themeToggle.addEventListener('click', () => {
  const next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
  applyTheme(next);
});

/* ============================================
   SIDEBAR TOGGLE (desktop collapse / mobile overlay)
   ============================================ */
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('mobileOverlay');
document.getElementById('sidebarToggle').addEventListener('click', () => {
  if(window.innerWidth <= 991){
    sidebar.classList.toggle('mobile-open');
    overlay.classList.toggle('show');
  } else {
    sidebar.classList.toggle('collapsed');
  }
});
overlay.addEventListener('click', () => { sidebar.classList.remove('mobile-open'); overlay.classList.remove('show'); });

function toggleSubmenu(e, id){
  e.preventDefault();
  document.getElementById(id).classList.toggle('open');
}

/* ============================================
   FULLSCREEN TOGGLE
   ============================================ */
const fullscreenToggle = document.getElementById('fullscreenToggle');
const fullscreenIcon = document.getElementById('fullscreenIcon');
fullscreenToggle.addEventListener('click', () => {
  if(!document.fullscreenElement){
    document.documentElement.requestFullscreen().catch(err => console.warn('Fullscreen request denied:', err));
  } else {
    document.exitFullscreen();
  }
});
document.addEventListener('fullscreenchange', () => {
  fullscreenIcon.className = document.fullscreenElement ? 'bi bi-fullscreen-exit' : 'bi bi-arrows-fullscreen';
});
