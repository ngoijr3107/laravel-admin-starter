@extends('layouts.auth')

@section('title', 'Sign in')

@section('form')
<div class="form-card fade-up">
  <h1 class="h4 mb-1">Welcome back</h1>
  <p class="text-secondary-c mb-4" style="font-size:.88rem;">Sign in to your Nimbus workspace to continue.</p>

  @if (session('status'))
    <div class="alert alert-success py-2" style="font-size:.83rem; border-radius:10px;">{{ session('status') }}</div>
  @endif

  <div class="d-flex flex-column gap-2 mb-3">
    <button class="btn-social" type="button"><i class="bi bi-google"></i>Continue with Google</button>
    <button class="btn-social" type="button"><i class="bi bi-microsoft"></i>Continue with Microsoft</button>
  </div>

  <div class="divider-c">or continue with email</div>

  <form method="POST" action="{{ route('login') }}" novalidate>
    @csrf
    <div class="mb-3">
      <label class="form-label-c" for="email">Work email</label>
      <div class="input-wrap">
        <i class="bi bi-envelope leading"></i>
        <input type="email" name="email" id="email" class="form-control-c @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="you@company.com" required autofocus>
      </div>
      @error('email')
        <div class="text-danger mt-1" style="font-size:.76rem;">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-2">
      <label class="form-label-c" for="password">Password</label>
      <div class="input-wrap">
        <i class="bi bi-lock leading"></i>
        <input type="password" name="password" id="password" class="form-control-c @error('password') is-invalid @enderror" placeholder="••••••••" required>
        <i class="bi bi-eye trailing" id="togglePw"></i>
      </div>
      @error('password')
        <div class="text-danger mt-1" style="font-size:.76rem;">{{ $message }}</div>
      @enderror
    </div>
    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
      <label class="form-check-c"><input type="checkbox" name="remember" class="form-check-input" style="margin:0;"> Remember me</label>
      @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}" class="link-c">Forgot password?</a>
      @endif
    </div>
    <button type="submit" class="btn-nimbus">Sign in</button>
  </form>

  @if (Route::has('register'))
    <p class="text-center text-secondary-c mt-4 mb-0" style="font-size:.85rem;">
      Don't have an account? <a href="{{ route('register') }}" class="link-c">Create one</a>
    </p>
  @endif
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
</script>
@endpush
