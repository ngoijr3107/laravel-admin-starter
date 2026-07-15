@extends('layouts.auth')

@section('title', 'Create account')

@section('brand-heading', 'Join thousands of teams running calmer operations.')
@section('brand-subtext', 'Set up your workspace in under two minutes — no credit card required to start.')

@section('form')
<div class="form-card fade-up">
  <h1 class="h4 mb-1">Create your workspace</h1>
  <p class="text-secondary-c mb-4" style="font-size:.88rem;">Start your 14-day free trial. No card required.</p>

  <div class="d-flex flex-column gap-2 mb-3">
    <button class="btn-social" type="button"><i class="bi bi-google"></i>Sign up with Google</button>
    <button class="btn-social" type="button"><i class="bi bi-microsoft"></i>Sign up with Microsoft</button>
  </div>

  <div class="divider-c">or continue with email</div>

  <form method="POST" action="{{ route('register') }}" novalidate>
    @csrf
    <div class="row g-2 mb-3">
      <div class="col-6">
        <label class="form-label-c" for="fname">First name</label>
        <input type="text" name="first_name" id="fname" class="form-control-c @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" placeholder="Amara" required>
        @error('first_name')<div class="text-danger mt-1" style="font-size:.76rem;">{{ $message }}</div>@enderror
      </div>
      <div class="col-6">
        <label class="form-label-c" for="lname">Last name</label>
        <input type="text" name="last_name" id="lname" class="form-control-c @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" placeholder="Kessler" required>
        @error('last_name')<div class="text-danger mt-1" style="font-size:.76rem;">{{ $message }}</div>@enderror
      </div>
    </div>
    <div class="mb-3">
      <label class="form-label-c" for="email">Work email</label>
      <div class="input-wrap">
        <i class="bi bi-envelope leading"></i>
        <input type="email" name="email" id="email" class="form-control-c @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="you@company.com" required>
      </div>
      @error('email')<div class="text-danger mt-1" style="font-size:.76rem;">{{ $message }}</div>@enderror
    </div>
    <div class="mb-2">
      <label class="form-label-c" for="password">Password</label>
      <div class="input-wrap">
        <i class="bi bi-lock leading"></i>
        <input type="password" name="password" id="password" class="form-control-c @error('password') is-invalid @enderror" placeholder="Create a strong password" required>
        <i class="bi bi-eye trailing" id="togglePw"></i>
      </div>
      <div class="strength-meter"><span id="s1"></span><span id="s2"></span><span id="s3"></span><span id="s4"></span></div>
      <div class="strength-label" id="strengthLabel">Use 8+ characters with a mix of letters, numbers &amp; symbols</div>
      @error('password')<div class="text-danger mt-1" style="font-size:.76rem;">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label-c" for="password_confirmation">Confirm password</label>
      <div class="input-wrap">
        <i class="bi bi-lock leading"></i>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control-c" placeholder="Repeat your password" required>
      </div>
    </div>
    <div class="form-check-c mt-3 mb-4">
      <input type="checkbox" class="form-check-input" style="margin:0;" required>
      <span>I agree to the <a href="#" class="link-c">Terms of Service</a> and <a href="#" class="link-c">Privacy Policy</a></span>
    </div>
    <button type="submit" class="btn-nimbus">Create account</button>
  </form>

  <p class="text-center text-secondary-c mt-4 mb-0" style="font-size:.85rem;">
    Already have an account? <a href="{{ route('login') }}" class="link-c">Sign in</a>
  </p>
</div>
@endsection

@push('scripts')
<script>
const pw = document.getElementById('password');
document.getElementById('togglePw').addEventListener('click', function(){
  const isPw = pw.type === 'password';
  pw.type = isPw ? 'text' : 'password';
  this.className = isPw ? 'bi bi-eye-slash trailing' : 'bi bi-eye trailing';
});

const bars = [document.getElementById('s1'),document.getElementById('s2'),document.getElementById('s3'),document.getElementById('s4')];
const strengthLabel = document.getElementById('strengthLabel');
const colors = ['#DC2626','#F59E0B','#06B6D4','#16A34A'];
const labels = ['Weak password','Fair password','Good password','Strong password'];
pw.addEventListener('input', () => {
  const v = pw.value;
  let score = 0;
  if(v.length >= 8) score++;
  if(/[A-Z]/.test(v) && /[a-z]/.test(v)) score++;
  if(/\d/.test(v)) score++;
  if(/[^A-Za-z0-9]/.test(v)) score++;
  bars.forEach((b,i) => { b.style.background = i < score ? colors[Math.max(score-1,0)] : ''; });
  strengthLabel.textContent = v.length === 0 ? 'Use 8+ characters with a mix of letters, numbers & symbols' : labels[Math.max(score-1,0)];
});
</script>
@endpush
