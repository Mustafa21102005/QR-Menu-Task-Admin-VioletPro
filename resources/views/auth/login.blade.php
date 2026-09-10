@extends('layouts.app')

@section('title', 'Log in')

@section('content')
    <div class="hero min-h-[70vh] relative overflow-hidden">
        <div class="hero-content w-full max-w-md relative z-10">
            <div
                class="card bg-base-200 w-full shadow-xl hover:shadow-2xl transition-all duration-400 hover:-translate-y-1 animate-[fadeSlideUp_0.6s_ease-out]">
                <div class="card-body">
                    <h2 class="card-title text-2xl mb-2">
                        Welcome Back
                        <span class="inline-block animate-[wave_2.2s_ease-in-out_infinite] origin-[70%_70%]">👋</span>
                    </h2>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Email --}}
                        <fieldset class="fieldset mb-2 animate-[fadeSlideUp_0.6s_ease-out_0.1s_both]">
                            <label for="email" class="label">
                                <span class="label-text">Email Address</span>
                            </label>
                            <input id="email" type="email"
                                class="input input-bordered w-full transition-all duration-200 focus:scale-[1.02] focus:shadow-md @error('email') input-error @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="label-text-alt text-error mt-1">{{ $message }}</span>
                            @enderror
                        </fieldset>

                        {{-- Password --}}
                        <fieldset class="fieldset mb-2 animate-[fadeSlideUp_0.6s_ease-out_0.2s_both]">
                            <label for="password" class="label">
                                <span class="label-text">Password</span>
                            </label>
                            <input id="password" type="password"
                                class="input input-bordered w-full transition-all duration-200 focus:scale-[1.02] focus:shadow-md @error('password') input-error @enderror"
                                name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="label-text-alt text-error mt-1">{{ $message }}</span>
                            @enderror
                        </fieldset>

                        {{-- Remember me --}}
                        <div class="form-control mb-4 animate-[fadeSlideUp_0.6s_ease-out_0.3s_both]">
                            <label class="label cursor-pointer justify-start gap-2">
                                <input type="checkbox" name="remember" id="remember" class="checkbox checkbox-sm"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <span class="label-text">Remember Me</span>
                            </label>
                        </div>

                        {{-- Actions --}}
                        <div
                            class="card-actions items-center justify-between animate-[fadeSlideUp_0.6s_ease-out_0.4s_both]">
                            <button type="submit"
                                class="btn btn-primary transition-transform duration-150 hover:scale-105 active:scale-95">
                                Login
                            </button>

                            @if (Route::has('password.request'))
                                <a class="link link-hover text-sm" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
