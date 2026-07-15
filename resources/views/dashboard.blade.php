@extends('layouts.app')

@section('title', 'Dashboard')

@push('vendor-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.4/chart.umd.min.js"></script>
@endpush

@section('content')

<div class="page-header fade-up">
  <div>
    <div class="eyebrow mb-1">Overview</div>
    <h1 class="h3 mb-1">Good morning, {{ Auth::check() ? explode(' ', Auth::user()->name)[0] : 'Amara' }}</h1>
    <div class="breadcrumb-c"><a href="{{ route('dashboard') }}">Home</a> / <span>Dashboard</span></div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn btn-soft"><i class="bi bi-download me-1"></i>Export</button>
    <button class="btn btn-nimbus"><i class="bi bi-plus-lg me-1"></i>New Report</button>
  </div>
</div>

<!-- STAT CARDS -->
<div class="row g-3 mb-3">
  <div class="col-xxl-3 col-sm-6">
    <div class="glass-card stat-card hoverable fade-up">
      <div class="stat-icon" style="background:linear-gradient(135deg,var(--primary),var(--secondary));"><i class="bi bi-graph-up-arrow"></i></div>
      <div class="stat-label mb-1">Total Revenue</div>
      <div class="stat-value">$482,940</div>
      <span class="stat-trend up mt-2 d-inline-flex"><i class="bi bi-arrow-up-short"></i>12.4%</span>
      <canvas class="sparkline" id="spark1"></canvas>
    </div>
  </div>
  <div class="col-xxl-3 col-sm-6">
    <div class="glass-card stat-card hoverable fade-up" style="animation-delay:.05s">
      <div class="stat-icon" style="background:linear-gradient(135deg,#06B6D4,#0D9488);"><i class="bi bi-cart-check"></i></div>
      <div class="stat-label mb-1">Orders</div>
      <div class="stat-value">3,218</div>
      <span class="stat-trend up mt-2 d-inline-flex"><i class="bi bi-arrow-up-short"></i>8.1%</span>
      <canvas class="sparkline" id="spark2"></canvas>
    </div>
  </div>
  <div class="col-xxl-3 col-sm-6">
    <div class="glass-card stat-card hoverable fade-up" style="animation-delay:.1s">
      <div class="stat-icon" style="background:linear-gradient(135deg,#F59E0B,#DC2626);"><i class="bi bi-people-fill"></i></div>
      <div class="stat-label mb-1">New Customers</div>
      <div class="stat-value">1,042</div>
      <span class="stat-trend down mt-2 d-inline-flex"><i class="bi bi-arrow-down-short"></i>2.3%</span>
      <canvas class="sparkline" id="spark3"></canvas>
    </div>
  </div>
  <div class="col-xxl-3 col-sm-6">
    <div class="glass-card stat-card hoverable fade-up" style="animation-delay:.15s">
      <div class="stat-icon" style="background:linear-gradient(135deg,#16A34A,#06B6D4);"><i class="bi bi-check2-circle"></i></div>
      <div class="stat-label mb-1">Conversion Rate</div>
      <div class="stat-value">4.68%</div>
      <span class="stat-trend up mt-2 d-inline-flex"><i class="bi bi-arrow-up-short"></i>0.6%</span>
      <canvas class="sparkline" id="spark4"></canvas>
    </div>
  </div>
</div>

<!-- CHARTS ROW -->
<div class="row g-3 mb-3">
  <div class="col-xl-8">
    <div class="glass-card p-4 fade-up" style="animation-delay:.2s">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <h2 class="section-title">Revenue Overview</h2>
          <div class="text-secondary-c" style="font-size:.8rem;">Monthly performance, last 12 months</div>
        </div>
        <div class="btn-group btn-group-sm">
          <button class="btn btn-soft active">Year</button>
          <button class="btn btn-soft">Quarter</button>
          <button class="btn btn-soft">Month</button>
        </div>
      </div>
      <div style="height:280px;"><canvas id="revenueChart"></canvas></div>
    </div>
  </div>
  <div class="col-xl-4">
    <div class="glass-card p-4 fade-up" style="animation-delay:.25s">
      <h2 class="section-title mb-3">Traffic Sources</h2>
      <div style="height:220px;"><canvas id="donutChart"></canvas></div>
      <div class="mt-3 d-flex flex-column gap-2" id="donutLegend"></div>
    </div>
  </div>
</div>

<!-- TABLE + ACTIVITY -->
<div class="row g-3">
  <div class="col-xl-8">
    <div class="glass-card p-4 fade-up" style="animation-delay:.3s">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="section-title">Recent Orders</h2>
        <a href="{{ route('tables') }}" class="text-decoration-none fw-semibold" style="font-size:.82rem; color:var(--primary);">View all <i class="bi bi-arrow-right"></i></a>
      </div>
      <div class="table-responsive">
        <table class="table table-nimbus">
          <thead><tr><th>Customer</th><th>Order ID</th><th>Product</th><th>Amount</th><th>Status</th></tr></thead>
          <tbody id="ordersTableBody"></tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-xl-4">
    <div class="glass-card p-4 fade-up" style="animation-delay:.35s">
      <h2 class="section-title mb-3">Recent Activity</h2>
      <div id="activityFeed"></div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
/* ============================================
   CHART.JS — theme aware
   ============================================ */
let revenueChart, donutChart, sparkCharts = [];

function themeColors(){
  const dark = root.getAttribute('data-theme') === 'dark';
  return {
    grid: dark ? 'rgba(255,255,255,.06)' : 'rgba(15,23,42,.06)',
    text: dark ? '#94A3B8' : '#64748B',
    primary: '#0D9488',
    secondary: '#0891B2'
  };
}

function renderCharts(){
  const c = themeColors();

  // destroy existing
  if(revenueChart) revenueChart.destroy();
  if(donutChart) donutChart.destroy();
  sparkCharts.forEach(ch => ch.destroy());
  sparkCharts = [];

  // Revenue area chart
  const ctx = document.getElementById('revenueChart');
  const gradient = ctx.getContext('2d').createLinearGradient(0,0,0,220);
  gradient.addColorStop(0, 'rgba(37,99,235,.35)');
  gradient.addColorStop(1, 'rgba(37,99,235,0)');

  revenueChart = new Chart(ctx, {
    type:'line',
    data:{
      labels:['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
      datasets:[{
        label:'Revenue',
        data:[32,41,38,52,49,63,58,71,66,78,74,89],
        borderColor:c.primary, backgroundColor:gradient, fill:true, tension:.42,
        pointRadius:0, pointHoverRadius:5, pointHoverBackgroundColor:c.primary, borderWidth:2.5
      }]
    },
    options:{
      responsive:true, maintainAspectRatio:false,
      plugins:{legend:{display:false}},
      scales:{
        x:{grid:{display:false}, ticks:{color:c.text, font:{size:11}}},
        y:{grid:{color:c.grid}, ticks:{color:c.text, font:{size:11}, callback:v=>'$'+v+'k'}}
      }
    }
  });

  // Donut
  donutChart = new Chart(document.getElementById('donutChart'), {
    type:'doughnut',
    data:{
      labels:['Organic Search','Direct','Social','Referral'],
      datasets:[{data:[42,28,18,12], backgroundColor:['#0D9488','#0891B2','#06B6D4','#F59E0B'], borderWidth:0, hoverOffset:6}]
    },
    options:{responsive:true, maintainAspectRatio:false, cutout:'72%', plugins:{legend:{display:false}}}
  });

  const legendColors = {'Organic Search':'#0D9488','Direct':'#0891B2','Social':'#06B6D4','Referral':'#F59E0B'};
  document.getElementById('donutLegend').innerHTML = Object.entries(legendColors).map(([k,v]) =>
    `<div class="d-flex align-items-center justify-content-between" style="font-size:.82rem;">
       <span><i class="bi bi-circle-fill me-2" style="color:${v}; font-size:.55rem;"></i>${k}</span>
       <span class="fw-semibold font-mono">${ {'Organic Search':42,'Direct':28,'Social':18,'Referral':12}[k] }%</span>
     </div>`).join('');

  // Sparklines
  const sparkData = [[4,6,5,8,7,10,9,13],[3,4,4,6,5,7,6,9],[8,6,7,5,6,4,5,3],[2,3,5,4,6,7,9,11]];
  const sparkColors = [c.primary, '#06B6D4', '#DC2626', '#16A34A'];
  ['spark1','spark2','spark3','spark4'].forEach((id,i) => {
    const el = document.getElementById(id);
    if(!el) return;
    sparkCharts.push(new Chart(el, {
      type:'line',
      data:{labels:sparkData[i].map((_,x)=>x), datasets:[{data:sparkData[i], borderColor:sparkColors[i], borderWidth:2, pointRadius:0, tension:.4, fill:false}]},
      options:{responsive:true, maintainAspectRatio:false, plugins:{legend:{display:false}}, scales:{x:{display:false},y:{display:false}}}
    }));
  });
}

/* ============================================
   DATA — table + activity feed
   ============================================ */
const orders = [
  {name:'Elena Vance', init:'EV', color:'#0D9488', id:'#ORD-8841', product:'Pro Plan — Annual', amount:'$1,240.00', status:'Completed', badge:'success'},
  {name:'Marcus Iwu', init:'MI', color:'#0891B2', id:'#ORD-8840', product:'Team Seats x5', amount:'$860.00', status:'Processing', badge:'warning'},
  {name:'Sofia Ren', init:'SR', color:'#06B6D4', id:'#ORD-8839', product:'Starter Plan', amount:'$120.00', status:'Completed', badge:'success'},
  {name:'David Okoro', init:'DO', color:'#F59E0B', id:'#ORD-8838', product:'Enterprise License', amount:'$4,500.00', status:'Refunded', badge:'danger'},
  {name:'Priya Nair', init:'PN', color:'#DC2626', id:'#ORD-8837', product:'Pro Plan — Monthly', amount:'$99.00', status:'Completed', badge:'success'},
];
document.getElementById('ordersTableBody').innerHTML = orders.map(o => `
  <tr>
    <td><div class="d-flex align-items-center gap-2"><div class="row-avatar" style="background:${o.color}">${o.init}</div><span class="fw-semibold">${o.name}</span></div></td>
    <td class="font-mono text-secondary-c">${o.id}</td>
    <td>${o.product}</td>
    <td class="font-mono fw-semibold">${o.amount}</td>
    <td><span class="badge-soft ${o.badge}">${o.status}</span></td>
  </tr>`).join('');

const activity = [
  {icon:'bi-check2', color:'#16A34A', text:'Invoice #4021 marked as paid', time:'2 min ago'},
  {icon:'bi-person-plus', color:'#0D9488', text:'New customer Priya Nair signed up', time:'18 min ago'},
  {icon:'bi-exclamation-triangle', color:'#F59E0B', text:'Server latency spike detected', time:'1 hr ago'},
  {icon:'bi-box-seam', color:'#0891B2', text:'Order #8838 shipped to Lagos, NG', time:'3 hr ago'},
  {icon:'bi-chat-dots', color:'#06B6D4', text:'New message from Marcus Iwu', time:'5 hr ago'},
];
document.getElementById('activityFeed').innerHTML = activity.map(a => `
  <div class="activity-item">
    <div class="activity-dot" style="background:${a.color}"><i class="bi ${a.icon}"></i></div>
    <div>
      <div style="font-size:.85rem; font-weight:500;">${a.text}</div>
      <div class="text-secondary-c" style="font-size:.74rem;">${a.time}</div>
    </div>
  </div>`).join('');

try { renderCharts(); } catch(err){ console.warn('Chart render skipped:', err); }

</script>
@endpush
