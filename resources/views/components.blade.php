@extends('layouts.app')

@section('title', 'Components')

@section('content')

<div class="page-header fade-up">
        <div>
          <div class="eyebrow mb-1">UI Kit</div>
          <h1 class="h3 mb-1">Components</h1>
          <div class="breadcrumb-c"><a href="{{ route('dashboard') }}">Home</a> / <span>Components</span></div>
        </div>
      </div>

      <!-- BUTTONS -->
      <div class="glass-card p-4 fade-up mb-3">
        <h2 class="section-title mb-3">Buttons</h2>
        <div class="d-flex flex-wrap gap-2 mb-3">
          <button class="btn btn-nimbus">Primary action</button>
          <button class="btn btn-soft">Secondary</button>
          <button class="btn btn-nimbus" disabled>Disabled</button>
          <button class="btn btn-nimbus btn-sm">Small</button>
          <button class="btn btn-soft"><i class="bi bi-download me-1"></i>With icon</button>
          <button class="btn btn-soft text-danger"><i class="bi bi-trash me-1"></i>Destructive</button>
        </div>
        <div class="d-flex flex-wrap gap-2">
          <button class="icon-btn"><i class="bi bi-heart"></i></button>
          <button class="icon-btn"><i class="bi bi-share"></i></button>
          <button class="icon-btn"><i class="bi bi-three-dots"></i></button>
        </div>
      </div>

      <div class="row g-3 mb-3">
        <!-- BADGES -->
        <div class="col-lg-6">
          <div class="glass-card p-4 fade-up h-100">
            <h2 class="section-title mb-3">Badges</h2>
            <div class="d-flex flex-wrap gap-2">
              <span class="badge-soft primary">Primary</span>
              <span class="badge-soft success">Success</span>
              <span class="badge-soft warning">Warning</span>
              <span class="badge-soft danger">Danger</span>
              <span class="badge bg-secondary">Bootstrap</span>
              <span class="badge rounded-pill" style="background:var(--gray-200); color:var(--text-primary);">Neutral</span>
            </div>
          </div>
        </div>

        <!-- ALERTS -->
        <div class="col-lg-6">
          <div class="glass-card p-4 fade-up h-100">
            <h2 class="section-title mb-3">Alerts</h2>
            <div class="d-flex flex-column gap-2">
              <div class="d-flex align-items-center gap-2 p-2 rounded-3" style="background:rgba(22,163,74,.1); color:var(--success); font-size:.85rem;"><i class="bi bi-check-circle-fill"></i>Payment received successfully.</div>
              <div class="d-flex align-items-center gap-2 p-2 rounded-3" style="background:rgba(245,158,11,.12); color:#B45309; font-size:.85rem;"><i class="bi bi-exclamation-triangle-fill"></i>Your trial ends in 3 days.</div>
              <div class="d-flex align-items-center gap-2 p-2 rounded-3" style="background:rgba(220,38,38,.1); color:var(--danger); font-size:.85rem;"><i class="bi bi-x-circle-fill"></i>Card declined — update billing.</div>
            </div>
          </div>
        </div>
      </div>

      <div class="row g-3 mb-3">
        <!-- PROGRESS -->
        <div class="col-lg-6">
          <div class="glass-card p-4 fade-up h-100">
            <h2 class="section-title mb-3">Progress</h2>
            <div class="mb-3">
              <div class="d-flex justify-content-between mb-1" style="font-size:.8rem;"><span>Storage used</span><span class="text-secondary-c">68%</span></div>
              <div class="progress-thick"><div class="bar" style="width:68%; background:linear-gradient(90deg,var(--primary),var(--secondary));"></div></div>
            </div>
            <div class="mb-3">
              <div class="d-flex justify-content-between mb-1" style="font-size:.8rem;"><span>Sprint progress</span><span class="text-secondary-c">42%</span></div>
              <div class="progress-thick"><div class="bar" style="width:42%; background:var(--success);"></div></div>
            </div>
            <div>
              <div class="d-flex justify-content-between mb-1" style="font-size:.8rem;"><span>Support SLA</span><span class="text-secondary-c">91%</span></div>
              <div class="progress-thick"><div class="bar" style="width:91%; background:var(--warning);"></div></div>
            </div>
          </div>
        </div>

        <!-- AVATARS / STACK -->
        <div class="col-lg-6">
          <div class="glass-card p-4 fade-up h-100">
            <h2 class="section-title mb-3">Avatars</h2>
            <div class="d-flex align-items-center mb-3">
              <div class="row-avatar" style="width:40px;height:40px;font-size:.85rem;background:#2563EB; margin-left:-8px; border:2px solid var(--surface-solid);">EV</div>
              <div class="row-avatar" style="width:40px;height:40px;font-size:.85rem;background:#4F46E5; margin-left:-8px; border:2px solid var(--surface-solid);">MI</div>
              <div class="row-avatar" style="width:40px;height:40px;font-size:.85rem;background:#06B6D4; margin-left:-8px; border:2px solid var(--surface-solid);">SR</div>
              <div class="row-avatar" style="width:40px;height:40px;font-size:.78rem;background:var(--gray-300); color:var(--gray-700); margin-left:-8px; border:2px solid var(--surface-solid);">+9</div>
            </div>
            <h2 class="section-title mb-3 mt-4">Rating</h2>
            <div style="color:var(--warning); font-size:1.1rem;">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
              <span class="text-secondary-c ms-1" style="font-size:.8rem;">4.5 (312 reviews)</span>
            </div>
          </div>
        </div>
      </div>

      <!-- TABS + ACCORDION -->
      <div class="row g-3 mb-3">
        <div class="col-lg-6">
          <div class="glass-card p-4 fade-up h-100">
            <h2 class="section-title mb-3">Tabs</h2>
            <ul class="nav nav-pills mb-3" style="gap:6px;">
              <li class="nav-item"><button class="nav-link active btn-nimbus" style="border-radius:11px;" data-bs-toggle="pill" data-bs-target="#tab1">Overview</button></li>
              <li class="nav-item"><button class="nav-link btn-soft" style="border-radius:11px;" data-bs-toggle="pill" data-bs-target="#tab2">Activity</button></li>
              <li class="nav-item"><button class="nav-link btn-soft" style="border-radius:11px;" data-bs-toggle="pill" data-bs-target="#tab3">Settings</button></li>
            </ul>
            <div class="tab-content" style="font-size:.85rem; color:var(--text-secondary);">
              <div class="tab-pane fade show active" id="tab1">A quick summary of this record and its current state lives here.</div>
              <div class="tab-pane fade" id="tab2">A timeline of recent changes and events would render in this pane.</div>
              <div class="tab-pane fade" id="tab3">Configuration options for this record live here.</div>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="glass-card p-4 fade-up h-100">
            <h2 class="section-title mb-3">Accordion</h2>
            <div class="accordion" id="faqAccordion">
              <div class="accordion-item" style="background:transparent; border:1px solid var(--surface-border); border-radius:12px; margin-bottom:8px; overflow:hidden;">
                <h2 class="accordion-header"><button class="accordion-button" style="background:var(--surface); color:var(--text-primary); font-size:.85rem; font-weight:600;" data-bs-toggle="collapse" data-bs-target="#faq1">How do I invite teammates?</button></h2>
                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion"><div class="accordion-body" style="font-size:.83rem; color:var(--text-secondary);">Go to Settings → Team and send an invite by email.</div></div>
              </div>
              <div class="accordion-item" style="background:transparent; border:1px solid var(--surface-border); border-radius:12px; overflow:hidden;">
                <h2 class="accordion-header"><button class="accordion-button collapsed" style="background:var(--surface); color:var(--text-primary); font-size:.85rem; font-weight:600;" data-bs-toggle="collapse" data-bs-target="#faq2">Can I export my data?</button></h2>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body" style="font-size:.83rem; color:var(--text-secondary);">Yes — CSV and Excel exports are available from any table view.</div></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- FORM ELEMENTS -->
      <div class="row g-3 mb-3">
        <div class="col-lg-7">
          <div class="glass-card p-4 fade-up h-100">
            <h2 class="section-title mb-3">Form Elements</h2>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label" style="font-size:.82rem; font-weight:600;">Full name</label>
                <input type="text" class="form-control" style="background:var(--gray-50); border-color:var(--surface-border); border-radius:10px;" placeholder="Jane Doe">
              </div>
              <div class="col-md-6">
                <label class="form-label" style="font-size:.82rem; font-weight:600;">Plan</label>
                <select class="form-select" style="background:var(--gray-50); border-color:var(--surface-border); border-radius:10px;">
                  <option>Starter</option><option>Pro</option><option>Enterprise</option>
                </select>
              </div>
              <div class="col-12">
                <label class="form-label" style="font-size:.82rem; font-weight:600;">Notes</label>
                <textarea class="form-control" rows="2" style="background:var(--gray-50); border-color:var(--surface-border); border-radius:10px;" placeholder="Add a note..."></textarea>
              </div>
              <div class="col-12 d-flex flex-wrap gap-4 mt-1">
                <div class="form-check form-switch"><input class="form-check-input" type="checkbox" checked><label class="form-check-label" style="font-size:.83rem;">Email notifications</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox"><label class="form-check-label" style="font-size:.83rem;">Marketing updates</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="plan-radio" checked><label class="form-check-label" style="font-size:.83rem;">Monthly</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" name="plan-radio"><label class="form-check-label" style="font-size:.83rem;">Annual</label></div>
              </div>
            </div>
          </div>
        </div>

        <!-- MODAL + TOAST TRIGGERS -->
        <div class="col-lg-5">
          <div class="glass-card p-4 fade-up h-100">
            <h2 class="section-title mb-3">Modals &amp; Toasts</h2>
            <div class="d-flex flex-wrap gap-2 mb-3">
              <button class="btn btn-nimbus" data-bs-toggle="modal" data-bs-target="#demoModal"><i class="bi bi-window me-1"></i>Open modal</button>
              <button class="btn btn-soft" id="showToastBtn"><i class="bi bi-bell me-1"></i>Show toast</button>
            </div>
            <h2 class="section-title mb-2 mt-4">Tooltip &amp; Popover</h2>
            <div class="d-flex gap-2">
              <button class="btn btn-soft" data-bs-toggle="tooltip" title="This is a tooltip">Hover me</button>
              <button class="btn btn-soft" data-bs-toggle="popover" data-bs-title="Quick tip" data-bs-content="Popovers show richer content on click.">Click me</button>
            </div>
          </div>
        </div>
      </div>

      <!-- EMPTY STATE + SKELETON -->
      <div class="row g-3">
        <div class="col-lg-6">
          <div class="glass-card p-4 fade-up h-100 text-center d-flex flex-column align-items-center justify-content-center" style="min-height:220px;">
            <div style="width:56px;height:56px;border-radius:16px;background:rgba(var(--primary-rgb),.1);display:flex;align-items:center;justify-content:center;color:var(--primary);font-size:1.4rem;" class="mb-3"><i class="bi bi-inbox"></i></div>
            <h3 class="h6 mb-1">No results found</h3>
            <p class="text-secondary-c mb-3" style="font-size:.83rem; max-width:260px;">Try adjusting your filters or search terms.</p>
            <button class="btn btn-soft btn-sm">Clear filters</button>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="glass-card p-4 fade-up h-100">
            <h2 class="section-title mb-3">Skeleton loading</h2>
            <div class="d-flex flex-column gap-2">
              <div style="height:14px; width:70%; border-radius:6px; background:var(--gray-200); animation:pulse 1.4s ease-in-out infinite;"></div>
              <div style="height:14px; width:90%; border-radius:6px; background:var(--gray-200); animation:pulse 1.4s ease-in-out infinite .1s;"></div>
              <div style="height:14px; width:50%; border-radius:6px; background:var(--gray-200); animation:pulse 1.4s ease-in-out infinite .2s;"></div>
              <div style="height:80px; width:100%; border-radius:12px; background:var(--gray-200); margin-top:8px; animation:pulse 1.4s ease-in-out infinite .3s;"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- DEMO MODAL -->
      <div class="modal fade" id="demoModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content" style="background:var(--surface-solid); border:1px solid var(--surface-border); border-radius:var(--r-lg); color:var(--text-primary);">
            <div class="modal-header" style="border-color:var(--surface-border);">
              <h5 class="modal-title">Invite a teammate</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <label class="form-label" style="font-size:.82rem; font-weight:600;">Email address</label>
              <input type="email" class="form-control" style="background:var(--gray-50); border-color:var(--surface-border); border-radius:10px;" placeholder="teammate@company.com">
            </div>
            <div class="modal-footer" style="border-color:var(--surface-border);">
              <button class="btn btn-soft" data-bs-dismiss="modal">Cancel</button>
              <button class="btn btn-nimbus">Send invite</button>
            </div>
          </div>
        </div>
      </div>

      <!-- TOAST -->
      <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="demoToast" class="toast align-items-center" role="alert" style="background:var(--surface-solid); border:1px solid var(--surface-border); border-radius:12px; color:var(--text-primary);">
          <div class="d-flex">
            <div class="toast-body" style="font-size:.85rem;"><i class="bi bi-check-circle-fill text-success me-2"></i>Invite sent successfully.</div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"></button>
          </div>
        </div>
      </div>

@endsection

@push('scripts')
<script>
/* ============================================
   COMPONENT DEMOS — tooltips, popovers, toast
   ============================================ */
document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => new bootstrap.Tooltip(el));
document.querySelectorAll('[data-bs-toggle="popover"]').forEach(el => new bootstrap.Popover(el));

const demoToastEl = document.getElementById('demoToast');
const demoToast = new bootstrap.Toast(demoToastEl, { delay: 3000 });
document.getElementById('showToastBtn').addEventListener('click', () => demoToast.show());

</script>
@endpush
