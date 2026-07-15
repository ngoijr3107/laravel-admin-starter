/* ============================================
   THEME ENGINE — persistent + system detect
   ============================================ */
const root = document.documentElement;
const themeToggle = document.getElementById('themeToggle');
const themeIcon = document.getElementById('themeIcon');

function applyTheme(theme){
  root.setAttribute('data-theme', theme);
  themeIcon.className = theme === 'dark' ? 'bi bi-moon-stars-fill' : 'bi bi-sun-fill';
  localStorage.setItem('creativepro-theme', theme);
  // Chart re-render is a "nice to have" — never let it block theme switching itself.
  try { if(typeof renderCharts === 'function') renderCharts(); }
  catch(err){ console.warn('Chart re-render skipped:', err); }
}
const savedTheme = localStorage.getItem('creativepro-theme');
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
    localStorage.setItem('creativepro-sidebar-collapsed', sidebar.classList.contains('collapsed') ? '1' : '0');
  }
});
overlay.addEventListener('click', () => { sidebar.classList.remove('mobile-open'); overlay.classList.remove('show'); });

function toggleSubmenu(e, id){
  e.preventDefault();
  document.getElementById(id).classList.toggle('open');
}

/* ============================================
   COLLAPSED SIDEBAR — hover tooltips
   ============================================ */
const sidebarTooltip = document.getElementById('sidebarTooltip');
document.querySelectorAll('.sidebar .nav-link').forEach(link => {
  const labelEl = link.querySelector('.nav-label');
  if(!labelEl) return;
  // Links that own a submenu get the flyout below instead of a plain tooltip
  if(link.parentElement.querySelector(':scope > .submenu')) return;
  const label = labelEl.textContent.trim();

  link.addEventListener('mouseenter', () => {
    if(!sidebar.classList.contains('collapsed')) return;
    const rect = link.getBoundingClientRect();
    sidebarTooltip.textContent = label;
    sidebarTooltip.style.top = (rect.top + rect.height / 2) + 'px';
    sidebarTooltip.style.left = (rect.right + 14) + 'px';
    sidebarTooltip.classList.add('show');
  });
  link.addEventListener('mouseleave', () => {
    sidebarTooltip.classList.remove('show');
  });
});
sidebar.addEventListener('mouseleave', () => {
  sidebarTooltip.classList.remove('show');
});

/* ============================================
   COLLAPSED SIDEBAR — submenu flyout
   (e.g. "Data Views" -> All Tables / Advanced Tables / Exports)
   ============================================ */
const sidebarFlyout = document.createElement('div');
sidebarFlyout.className = 'sidebar-flyout';
sidebarFlyout.id = 'sidebarFlyout';
document.body.appendChild(sidebarFlyout);

let flyoutCloseTimer = null;

document.querySelectorAll('.sidebar .nav-item').forEach(item => {
  const submenu = item.querySelector(':scope > .submenu');
  const link = item.querySelector(':scope > .nav-link');
  if(!submenu || !link) return;
  const labelEl = link.querySelector('.nav-label');
  const label = labelEl ? labelEl.textContent.trim() : '';

  function showFlyout(){
    if(!sidebar.classList.contains('collapsed')) return;
    clearTimeout(flyoutCloseTimer);
    sidebarTooltip.classList.remove('show');
    const linksHtml = Array.from(submenu.querySelectorAll('a')).map(a =>
      `<a href="${a.getAttribute('href')}" class="${a.classList.contains('active') ? 'active' : ''}">${a.textContent.trim()}</a>`
    ).join('');
    sidebarFlyout.innerHTML = `<div class="flyout-title">${label}</div>${linksHtml}`;
    const rect = link.getBoundingClientRect();
    sidebarFlyout.style.top = (rect.top + rect.height / 2) + 'px';
    sidebarFlyout.style.left = (rect.right + 14) + 'px';
    sidebarFlyout.classList.add('show');
  }
  function scheduleHideFlyout(){
    flyoutCloseTimer = setTimeout(() => sidebarFlyout.classList.remove('show'), 150);
  }

  item.addEventListener('mouseenter', showFlyout);
  item.addEventListener('mouseleave', scheduleHideFlyout);
});
sidebarFlyout.addEventListener('mouseenter', () => clearTimeout(flyoutCloseTimer));
sidebarFlyout.addEventListener('mouseleave', () => {
  flyoutCloseTimer = setTimeout(() => sidebarFlyout.classList.remove('show'), 150);
});
sidebar.addEventListener('mouseleave', () => {
  clearTimeout(flyoutCloseTimer);
  sidebarFlyout.classList.remove('show');
});

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

/* ============================================
   COMMAND PALETTE (Ctrl/Cmd + K)
   ============================================ */
const cpOverlay = document.getElementById('commandPaletteOverlay');
const cpInput = document.getElementById('commandPaletteInput');
const cpList = document.getElementById('commandPaletteList');
const cpItems = cpList ? Array.from(cpList.querySelectorAll('li')) : [];
const cpEmpty = document.getElementById('commandPaletteEmpty');

function openCommandPalette(){
  if(!cpOverlay) return;
  cpOverlay.classList.add('show');
  document.body.style.overflow = 'hidden';
  cpInput.value = '';
  filterCommandPalette('');
  setTimeout(() => cpInput.focus(), 10);
}
function closeCommandPalette(){
  if(!cpOverlay) return;
  cpOverlay.classList.remove('show');
  document.body.style.overflow = '';
}
function filterCommandPalette(query){
  const q = query.trim().toLowerCase();
  const visible = [];
  cpItems.forEach(item => {
    const haystack = (item.dataset.keywords || '') + ' ' + item.textContent.toLowerCase();
    const match = q === '' || haystack.toLowerCase().includes(q);
    item.classList.toggle('hidden', !match);
    item.classList.remove('active');
    if(match) visible.push(item);
  });
  if(visible.length) visible[0].classList.add('active');
  if(cpEmpty) cpEmpty.classList.toggle('show', visible.length === 0);
  return visible;
}
function activateCommandItem(item){
  if(!item) return;
  if(item.dataset.href){
    startPageLoader();
    window.location.href = item.dataset.href;
  } else if(item.dataset.action === 'toggle-theme'){
    themeToggle.click();
    closeCommandPalette();
  } else if(item.dataset.action === 'toggle-sidebar'){
    document.getElementById('sidebarToggle').click();
    closeCommandPalette();
  } else if(item.dataset.action === 'logout'){
    const form = document.getElementById('commandPaletteLogoutForm');
    if(form){ startPageLoader(); form.submit(); }
  }
}

if(cpOverlay){
  const searchTrigger = document.getElementById('topbarSearchTrigger');
  if(searchTrigger) searchTrigger.addEventListener('click', openCommandPalette);

  cpOverlay.addEventListener('click', (e) => { if(e.target === cpOverlay) closeCommandPalette(); });
  cpInput.addEventListener('input', () => filterCommandPalette(cpInput.value));

  cpItems.forEach(item => {
    item.addEventListener('click', () => activateCommandItem(item));
    item.addEventListener('mouseenter', () => {
      cpItems.forEach(i => i.classList.remove('active'));
      item.classList.add('active');
    });
  });

  cpInput.addEventListener('keydown', (e) => {
    const visible = cpItems.filter(i => !i.classList.contains('hidden'));
    const currentIndex = visible.findIndex(i => i.classList.contains('active'));
    if(e.key === 'ArrowDown'){
      e.preventDefault();
      const next = visible[Math.min(currentIndex + 1, visible.length - 1)];
      visible.forEach(i => i.classList.remove('active'));
      if(next){ next.classList.add('active'); next.scrollIntoView({block:'nearest'}); }
    } else if(e.key === 'ArrowUp'){
      e.preventDefault();
      const prev = visible[Math.max(currentIndex - 1, 0)];
      visible.forEach(i => i.classList.remove('active'));
      if(prev){ prev.classList.add('active'); prev.scrollIntoView({block:'nearest'}); }
    } else if(e.key === 'Enter'){
      e.preventDefault();
      activateCommandItem(visible[currentIndex] || visible[0]);
    } else if(e.key === 'Escape'){
      closeCommandPalette();
    }
  });
}

document.addEventListener('keydown', (e) => {
  if((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 'k'){
    e.preventDefault();
    openCommandPalette();
  }
  if(e.key === 'Escape') closeCommandPalette();
});

/* ============================================
   PAGE LOADER BAR — shown on same-origin nav
   clicks and form submits to soften full reloads
   ============================================ */
const pageLoaderBar = document.getElementById('pageLoaderBar');
function startPageLoader(){
  if(!pageLoaderBar) return;
  pageLoaderBar.style.width = '0%';
  pageLoaderBar.classList.add('active');
  requestAnimationFrame(() => { pageLoaderBar.style.width = '70%'; });
}
document.addEventListener('click', (e) => {
  const link = e.target.closest('a[href]');
  if(!link) return;
  const href = link.getAttribute('href');
  if(!href || href.startsWith('#') || href.startsWith('javascript:')) return;
  if(link.target === '_blank' || link.hasAttribute('data-bs-toggle') || link.hasAttribute('data-bs-dismiss')) return;
  if(e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
  startPageLoader();
});
document.querySelectorAll('form').forEach(form => {
  form.addEventListener('submit', () => startPageLoader());
});
