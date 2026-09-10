@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    <div class="hero min-h-[70vh] relative overflow-hidden">
        <div class="hero-content w-full max-w-md relative z-10">
            <div
                class="card bg-base-200 w-full shadow-xl hover:shadow-2xl transition-all duration-400 hover:-translate-y-1 animate-[fadeSlideUp_0.6s_ease-out]">
                <div class="card-body">
                    <a href="{{ route('login') }}"
                        class="group inline-flex items-center gap-1 text-sm opacity-70 hover:opacity-100 transition-opacity w-fit mb-1">
                        <span class="inline-block transition-transform duration-200 group-hover:-translate-x-1">←</span>
                        Back to login
                    </a>

                    <h2 class="card-title text-2xl mb-2">
                        Reset Password
                        <span class="inline-block animate-[wave_2.2s_ease-in-out_infinite] origin-[70%_70%]">🔑</span>
                    </h2>

                    @if (session('status'))
                        <div class="alert alert-success animate-[fadeSlideUp_0.4s_ease-out] mb-2" role="alert">
                            <span>{{ session('status') }}</span>
                        </div>
                    @endif

                    <p class="text-sm opacity-70 mb-2 animate-[fadeSlideUp_0.6s_ease-out_0.1s_both]">
                        Enter your email and we'll send you a link to reset your password.
                    </p>

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        {{-- Email --}}
                        <fieldset class="fieldset mb-4 animate-[fadeSlideUp_0.6s_ease-out_0.2s_both]">
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

                        {{-- Actions --}}
                        <div class="card-actions items-center justify-end animate-[fadeSlideUp_0.6s_ease-out_0.3s_both]">
                            <button type="submit"
                                class="btn btn-primary transition-transform duration-150 hover:scale-105 active:scale-95">
                                Send Password Reset Link
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
