@extends('layouts.app')

@section('title', 'Tables')

@section('content')

<div class="page-header fade-up">
        <div>
          <div class="eyebrow mb-1">Data Views</div>
          <h1 class="h3 mb-1">All Tables</h1>
          <div class="breadcrumb-c"><a href="{{ route('dashboard') }}">Home</a> / <span>Tables</span></div>
        </div>
        <div class="d-flex gap-2">
          <button class="btn btn-soft"><i class="bi bi-download me-1"></i>Export CSV</button>
          <button class="btn btn-nimbus"><i class="bi bi-plus-lg me-1"></i>Add Customer</button>
        </div>
      </div>

      <!-- SUMMARY STRIP -->
      <div class="row g-3 mb-3">
        <div class="col-sm-4">
          <div class="glass-card p-3 fade-up d-flex align-items-center gap-3">
            <div class="stat-icon m-0" style="background:linear-gradient(135deg,var(--primary),var(--secondary));"><i class="bi bi-people-fill"></i></div>
            <div><div class="stat-value" style="font-size:1.3rem;">248</div><div class="stat-label">Total customers</div></div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="glass-card p-3 fade-up d-flex align-items-center gap-3" style="animation-delay:.05s">
            <div class="stat-icon m-0" style="background:linear-gradient(135deg,#16A34A,#06B6D4);"><i class="bi bi-check-circle"></i></div>
            <div><div class="stat-value" style="font-size:1.3rem;">211</div><div class="stat-label">Active accounts</div></div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="glass-card p-3 fade-up d-flex align-items-center gap-3" style="animation-delay:.1s">
            <div class="stat-icon m-0" style="background:linear-gradient(135deg,#F59E0B,#DC2626);"><i class="bi bi-clock-history"></i></div>
            <div><div class="stat-value" style="font-size:1.3rem;">14</div><div class="stat-label">Pending review</div></div>
          </div>
        </div>
      </div>

      <!-- ADVANCED TABLE -->
      <div class="glass-card p-4 fade-up" style="animation-delay:.15s" id="advanced">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
          <h2 class="section-title">Customers</h2>
          <div class="d-flex align-items-center gap-2 flex-wrap">
            <div class="search-pill" style="max-width:240px;">
              <i class="bi bi-search"></i>
              <input type="text" id="tableSearch" placeholder="Search customers...">
            </div>
            <select class="form-select form-select-sm btn-soft border-0" id="statusFilter" style="width:auto; font-weight:600;">
              <option value="">All statuses</option>
              <option value="Active">Active</option>
              <option value="Pending">Pending</option>
              <option value="Suspended">Suspended</option>
            </select>
            <button class="icon-btn" title="Column settings"><i class="bi bi-sliders"></i></button>
          </div>
        </div>

        <div class="d-none align-items-center justify-content-between gap-2 mb-3 p-2" id="bulkBar" style="background:rgba(37,99,235,.08); border-radius:12px;">
          <span class="fw-semibold ps-2" style="font-size:.85rem;"><span id="selCount">0</span> selected</span>
          <div class="d-flex gap-2">
            <button class="btn btn-soft btn-sm"><i class="bi bi-envelope me-1"></i>Email</button>
            <button class="btn btn-soft btn-sm text-danger"><i class="bi bi-trash me-1"></i>Delete</button>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-nimbus" id="customersTable">
            <thead>
              <tr>
                <th style="width:36px;"><input type="checkbox" class="form-check-input" id="selectAll"></th>
                <th class="sortable" data-key="name" style="cursor:pointer;">Customer <i class="bi bi-arrow-down-up ms-1" style="font-size:.7rem;"></i></th>
                <th class="sortable" data-key="company" style="cursor:pointer;">Company <i class="bi bi-arrow-down-up ms-1" style="font-size:.7rem;"></i></th>
                <th class="sortable" data-key="plan" style="cursor:pointer;">Plan</th>
                <th class="sortable" data-key="spend" style="cursor:pointer;">Lifetime Spend <i class="bi bi-arrow-down-up ms-1" style="font-size:.7rem;"></i></th>
                <th>Status</th>
                <th style="width:40px;"></th>
              </tr>
            </thead>
            <tbody id="customersBody"></tbody>
          </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
          <div class="text-secondary-c" style="font-size:.8rem;" id="pageInfo"></div>
          <div class="d-flex gap-1" id="pagination"></div>
        </div>
      </div>

      <!-- SIMPLE TABLE VARIANT -->
      <div class="glass-card p-4 fade-up mt-3" style="animation-delay:.2s" id="exports">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h2 class="section-title">Recent Exports</h2>
          <span class="badge-soft primary">4 files</span>
        </div>
        <div class="table-responsive">
          <table class="table table-nimbus">
            <thead><tr><th>File</th><th>Type</th><th>Size</th><th>Generated</th><th>Status</th></tr></thead>
            <tbody>
              <tr><td><i class="bi bi-file-earmark-spreadsheet me-2" style="color:var(--success);"></i>customers_q2.csv</td><td>CSV</td><td class="font-mono">128 KB</td><td class="text-secondary-c">2 hours ago</td><td><span class="badge-soft success">Ready</span></td></tr>
              <tr><td><i class="bi bi-file-earmark-pdf me-2" style="color:var(--danger);"></i>invoice_summary.pdf</td><td>PDF</td><td class="font-mono">842 KB</td><td class="text-secondary-c">Yesterday</td><td><span class="badge-soft success">Ready</span></td></tr>
              <tr><td><i class="bi bi-file-earmark-excel me-2" style="color:var(--success);"></i>orders_2026.xlsx</td><td>Excel</td><td class="font-mono">2.1 MB</td><td class="text-secondary-c">2 days ago</td><td><span class="badge-soft warning">Processing</span></td></tr>
              <tr><td><i class="bi bi-file-earmark-text me-2" style="color:var(--info);"></i>audit_log.txt</td><td>Text</td><td class="font-mono">64 KB</td><td class="text-secondary-c">4 days ago</td><td><span class="badge-soft success">Ready</span></td></tr>
            </tbody>
          </table>
        </div>
      </div>

@endsection

@push('scripts')
<script>
/* ============================================
   CUSTOMERS TABLE — search, sort, filter, paginate, bulk select
   ============================================ */
const initials = n => n.split(' ').map(w=>w[0]).slice(0,2).join('').toUpperCase();
const avatarColors = ['#0D9488','#0891B2','#06B6D4','#F59E0B','#DC2626','#16A34A'];

const customers = [
  {name:'Elena Vance', company:'Northwind Retail', plan:'Enterprise', spend:12400, status:'Active'},
  {name:'Marcus Iwu', company:'Lagos Freight Co.', plan:'Team', spend:3860, status:'Active'},
  {name:'Sofia Ren', company:'Meridian Labs', plan:'Starter', spend:1200, status:'Pending'},
  {name:'David Okoro', company:'Okoro & Partners', plan:'Enterprise', spend:24500, status:'Suspended'},
  {name:'Priya Nair', company:'Nair Consulting', plan:'Pro', spend:990, status:'Active'},
  {name:'Liam Carter', company:'Carter Logistics', plan:'Team', spend:5400, status:'Active'},
  {name:'Yuki Tanaka', company:'Tanaka Design Studio', plan:'Starter', spend:640, status:'Pending'},
  {name:'Amara Kessler', company:'CreativePro Internal', plan:'Enterprise', spend:0, status:'Active'},
  {name:'Noah Bergström', company:'Bergström AB', plan:'Pro', spend:2100, status:'Active'},
  {name:'Fatima Al-Sayed', company:'Al-Sayed Trading', plan:'Team', spend:7800, status:'Suspended'},
  {name:'Diego Morales', company:'Morales Freight', plan:'Starter', spend:410, status:'Pending'},
  {name:'Chloe Bennett', company:'Bennett & Co', plan:'Pro', spend:3300, status:'Active'},
].map((c,i)=>({...c, color: avatarColors[i % avatarColors.length]}));

let sortKey = null, sortDir = 1, currentPage = 1;
const pageSize = 6;
const selected = new Set();

function statusBadge(s){
  const map = {Active:'success', Pending:'warning', Suspended:'danger'};
  return `<span class="badge-soft ${map[s]}">${s}</span>`;
}

function getFiltered(){
  const q = (document.getElementById('tableSearch').value || '').toLowerCase();
  const statusVal = document.getElementById('statusFilter').value;
  let rows = customers.filter(c =>
    (c.name.toLowerCase().includes(q) || c.company.toLowerCase().includes(q)) &&
    (!statusVal || c.status === statusVal)
  );
  if(sortKey){
    rows = [...rows].sort((a,b) => {
      let av = a[sortKey], bv = b[sortKey];
      if(typeof av === 'string') return av.localeCompare(bv) * sortDir;
      return (av - bv) * sortDir;
    });
  }
  return rows;
}

function renderTable(){
  const rows = getFiltered();
  const totalPages = Math.max(1, Math.ceil(rows.length / pageSize));
  currentPage = Math.min(currentPage, totalPages);
  const pageRows = rows.slice((currentPage-1)*pageSize, currentPage*pageSize);

  document.getElementById('customersBody').innerHTML = pageRows.length ? pageRows.map(c => `
    <tr>
      <td><input type="checkbox" class="form-check-input row-check" data-name="${c.name}" ${selected.has(c.name)?'checked':''}></td>
      <td><div class="d-flex align-items-center gap-2"><div class="row-avatar" style="background:${c.color}">${initials(c.name)}</div><span class="fw-semibold">${c.name}</span></div></td>
      <td class="text-secondary-c">${c.company}</td>
      <td>${c.plan}</td>
      <td class="font-mono fw-semibold">$${c.spend.toLocaleString()}</td>
      <td>${statusBadge(c.status)}</td>
      <td><i class="bi bi-three-dots-vertical text-secondary-c" style="cursor:pointer;"></i></td>
    </tr>`).join('') : `<tr><td colspan="7" class="text-center text-secondary-c py-4">No customers match your filters.</td></tr>`;

  document.getElementById('pageInfo').textContent = rows.length
    ? `Showing ${(currentPage-1)*pageSize+1}–${Math.min(currentPage*pageSize, rows.length)} of ${rows.length}`
    : 'No results';

  const pag = document.getElementById('pagination');
  let btns = '';
  for(let p=1; p<=totalPages; p++){
    btns += `<button class="btn btn-sm ${p===currentPage?'btn-nimbus':'btn-soft'} page-btn" data-page="${p}" style="min-width:34px;">${p}</button>`;
  }
  pag.innerHTML = btns;
  pag.querySelectorAll('.page-btn').forEach(b => b.addEventListener('click', () => { currentPage = +b.dataset.page; renderTable(); }));

  document.querySelectorAll('.row-check').forEach(cb => {
    cb.addEventListener('change', () => {
      if(cb.checked) selected.add(cb.dataset.name); else selected.delete(cb.dataset.name);
      updateBulkBar();
    });
  });
  updateBulkBar();
}

function updateBulkBar(){
  const bar = document.getElementById('bulkBar');
  document.getElementById('selCount').textContent = selected.size;
  bar.classList.toggle('d-none', selected.size === 0);
  bar.classList.toggle('d-flex', selected.size > 0);
}

document.getElementById('tableSearch').addEventListener('input', () => { currentPage = 1; renderTable(); });
document.getElementById('statusFilter').addEventListener('change', () => { currentPage = 1; renderTable(); });
document.getElementById('selectAll').addEventListener('change', function(){
  const rows = getFiltered().slice((currentPage-1)*pageSize, currentPage*pageSize);
  rows.forEach(r => this.checked ? selected.add(r.name) : selected.delete(r.name));
  renderTable();
});
document.querySelectorAll('.sortable').forEach(th => {
  th.addEventListener('click', () => {
    const key = th.dataset.key;
    if(sortKey === key) sortDir *= -1; else { sortKey = key; sortDir = 1; }
    renderTable();
  });
});

renderTable();

</script>
@endpush
