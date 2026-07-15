@extends('layouts.auth')

@section('title', 'Reset password')

@section('brand-heading', "Locked out happens. Getting back in shouldn't be hard.")
@section('brand-subtext', "We'll send a secure reset link to your inbox — it expires in 15 minutes for your safety.")

@section('form')

@if (session('status'))
  {{-- Laravel's password broker sets this after successfully emailing a reset link --}}
  <div class="form-card fade-up">
    <div class="mb-3" style="width:56px;height:56px;border-radius:16px;background:rgba(22,163,74,.12);display:flex;align-items:center;justify-content:center;color:var(--success);font-size:1.4rem;">
      <i class="bi bi-envelope-check"></i>
    </div>
    <h1 class="h4 mb-1">Check your inbox</h1>
    <p class="text-secondary-c mb-4" style="font-size:.88rem;">{{ session('status') }} The link expires in 15 minutes.</p>
    <form method="POST" action="{{ route('password.email') }}">
      @csrf
      <input type="hidden" name="email" value="{{ old('email') }}">
      <button type="submit" class="btn-social w-100"><i class="bi bi-arrow-repeat"></i>Resend email</button>
    </form>
    <p class="text-center text-secondary-c mt-4 mb-0" style="font-size:.85rem;">
      Wrong email? <a href="{{ route('password.request') }}" class="link-c">Try again</a>
    </p>
  </div>
@else
  <div class="form-card fade-up">
    <a href="{{ route('login') }}" class="link-c" style="display:inline-flex; align-items:center; gap:4px; margin-bottom:18px;"><i class="bi bi-arrow-left"></i> Back to sign in</a>
    <h1 class="h4 mb-1">Forgot your password?</h1>
    <p class="text-secondary-c mb-4" style="font-size:.88rem;">No worries — enter your email and we'll send you a reset link.</p>

    <form method="POST" action="{{ route('password.email') }}" novalidate>
      @csrf
      <div class="mb-4">
        <label class="form-label-c" for="email">Work email</label>
        <div class="input-wrap">
          <i class="bi bi-envelope leading"></i>
          <input type="email" name="email" id="email" class="form-control-c @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="you@company.com" required autofocus>
        </div>
        @error('email')
          <div class="text-danger mt-1" style="font-size:.76rem;">{{ $message }}</div>
        @enderror
      </div>
      <button type="submit" class="btn-nimbus">Send reset link</button>
    </form>
  </div>
@endif

@endsection
