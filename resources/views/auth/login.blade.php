@php
use Illuminate\Support\Facades\Route;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Admin Login — AzagiPrint</title>
  <meta name="description" content="Panel Admin AzagiPrint — Masuk untuk mengelola pesanan, produk, dan data pelanggan.">

  <!-- Google Fonts: Plus Jakarta Sans + Inter -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}">

  <!-- Vite: landing.css mengandung Tailwind v4 + brand tokens -->
  @vite(['resources/css/landing.css'])
  @stack('styles')
</head>
<body class="font-body antialiased h-screen overflow-hidden" style="background-color: #F8FAFC;">

  <div class="h-screen flex flex-col lg:flex-row overflow-hidden">
    {{-- ============================================ --}}
    {{-- LEFT COLUMN — Brand / Illustration (hidden on mobile) --}}
    {{-- ============================================ --}}
    <div class="hidden lg:flex lg:w-3/5 hero-gradient relative overflow-hidden items-center justify-center p-8 xl:p-12">
      {{-- Decorative blur circles --}}
      <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-32 -left-32 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>
        <div class="absolute top-1/3 right-1/4 w-64 h-64 bg-blue-400/10 rounded-full blur-3xl"></div>
      </div>

      <div class="relative z-10 text-center max-w-lg">
        {{-- Back to home --}}
        <a href="{{ route('landing') }}" class="inline-flex items-center gap-1.5 text-white/60 hover:text-white transition-colors mb-8 text-sm font-medium">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
          </svg>
          Kembali ke Beranda
        </a>

        {{-- Brand logo --}}
        <div class="mb-8">
          <span class="font-heading text-4xl xl:text-5xl font-extrabold text-white tracking-tight">AzagiPrint</span>
          <p class="text-white/60 text-sm mt-1 font-medium tracking-wide">Desa Percetakan Online</p>
        </div>

        {{-- Illustration --}}
        <div class="mb-8">
          <img src="{{ asset('assets/img/landing/hero-lanyard.png') }}"
               alt="AzagiPrint Lanyard"
               width="500" height="400"
               class="w-full max-w-xs mx-auto rounded-2xl shadow-2xl object-cover"
               loading="eager">
        </div>

        {{-- Panel Admin text --}}
        <h2 class="font-heading text-2xl xl:text-3xl font-bold text-white mb-3">
          Panel Admin
        </h2>
        <p class="text-white/70 text-sm xl:text-base leading-relaxed max-w-sm mx-auto">
          Kelola pesanan, produk, dan pelanggan — semuanya dari satu dasbor.
        </p>

        {{-- Trust badges --}}
        <div class="flex flex-wrap items-center justify-center gap-x-6 gap-y-2 mt-8">
          <div class="flex items-center gap-1.5 text-white/60 text-xs xl:text-sm">
            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>1.200+ Pelanggan</span>
          </div>
          <div class="flex items-center gap-1.5 text-white/60 text-xs xl:text-sm">
            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>566+ Pesanan</span>
          </div>
          <div class="flex items-center gap-1.5 text-white/60 text-xs xl:text-sm">
            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>Produksi 24 Jam</span>
          </div>
        </div>
      </div>
    </div>
    {{-- END LEFT COLUMN --}}

    {{-- ============================================ --}}
    {{-- RIGHT COLUMN — Login Form --}}
    {{-- ============================================ --}}
    <div class="w-full lg:w-2/5 flex items-center justify-center p-6 sm:p-8 lg:p-10 xl:p-12 overflow-hidden">
      <div class="w-full max-w-md">

        {{-- Mobile Logo (visible only on small screens) --}}
        <div class="lg:hidden text-center mb-8">
          <a href="{{ route('landing') }}" class="inline-flex items-center gap-1.5 text-gray-400 hover:text-[#0A2463] transition-colors mb-4 text-sm font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Beranda
          </a>
          <div class="mt-2">
            <span class="font-heading text-3xl font-extrabold tracking-tight" style="color: #0A2463;">AzagiPrint</span>
            <p class="text-gray-400 text-xs font-medium mt-0.5 tracking-wide">Desa Percetakan Online</p>
          </div>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgba(10,36,99,0.08)] border border-gray-100/80 p-8 sm:p-10">
          {{-- Card Header --}}
            <div class="text-center mb-8">
            <div class="w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4" style="background-color: #E8EDF7;">
              <svg class="w-7 h-7" style="color: #0A2463;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
              </svg>
            </div>
            <h1 class="font-heading text-2xl font-bold text-gray-900">Masuk Admin</h1>
            <p class="font-body text-gray-500 text-sm mt-1">Masuk ke panel untuk mengelola</p>
          </div>

          {{-- Session Status (Success Messages) --}}
          @if (session('status'))
            <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200" role="alert">
              <div class="flex items-center gap-2.5">
                <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm font-medium text-green-800">{{ session('status') }}</p>
              </div>
            </div>
          @endif

          {{-- Login Form --}}
          <form id="formAuthentication" action="{{ route('admin.login.post') }}" method="POST">
            @csrf

            {{-- Email Field --}}
            <div class="mb-5">
              <label for="login-email" class="block font-body text-sm font-medium text-gray-700 mb-1.5">Email</label>
              <input type="text"
                     id="login-email"
                     name="email"
                     placeholder="nama@email.com"
                     autofocus
                     autocomplete="email"
                     value="{{ old('email') }}"
                     class="block w-full px-4 py-3 rounded-[5px] font-body text-sm border transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 @error('email') border-red-400 focus:ring-red-500/20 text-red-900 placeholder-red-400 @else border-gray-300 focus:border-[#0A2463] focus:ring-[#0A2463]/20 text-gray-900 @enderror">
              @error('email')
                <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1.5">
                  <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                  </svg>
                  {{ $message }}
                </p>
              @enderror
            </div>

            {{-- Password Field --}}
            <div class="mb-5">
              <label for="login-password" class="block font-body text-sm font-medium text-gray-700 mb-1.5">Password</label>
              <div class="relative">
                <input type="password"
                       id="login-password"
                       name="password"
                       placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
                       autocomplete="current-password"
                       class="block w-full px-4 py-3 rounded-[5px] font-body text-sm border transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 pr-12 @error('password') border-red-400 focus:ring-red-500/20 text-red-900 placeholder-red-400 @else border-gray-300 focus:border-[#0A2463] focus:ring-[#0A2463]/20 text-gray-900 @enderror">
                {{-- Toggle Password Visibility --}}
                <button type="button"
                        onclick="togglePassword()"
                        class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600 transition-colors focus:outline-none"
                        tabindex="-1"
                        aria-label="Toggle password visibility">
                  <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                  </svg>
                  <svg id="eye-off-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                  </svg>
                </button>
              </div>
              @error('password')
                <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1.5">
                  <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                  </svg>
                  {{ $message }}
                </p>
              @enderror
            </div>

            {{-- Remember Me & Forgot Password --}}
            <div class="flex items-center justify-between mb-6">
              <label class="flex items-center gap-2 cursor-pointer select-none" for="remember-me">
                <input type="checkbox"
                       name="remember"
                       id="remember-me"
                       {{ old('remember') ? 'checked' : '' }}
                       class="w-4 h-4 rounded border-gray-300 text-[#0A2463] focus:ring-[#0A2463]/20 focus:ring-2 transition-all cursor-pointer">
                <span class="text-sm text-gray-600 font-medium cursor-pointer">Ingat Saya</span>
              </label>
              @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm font-medium transition-colors hover:underline" style="color: #3B82F6;">
                  Lupa Password?
                </a>
              @endif
            </div>

            {{-- Submit Button --}}
            <button type="submit"
                    class="w-full font-cta text-base font-semibold py-3 px-6 rounded-[5px] text-white transition-all duration-300 shadow-lg hover:shadow-xl active:scale-[0.98]"
                    style="background-color: #0A2463;">
              <span class="flex items-center justify-center gap-2.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                Masuk ke Panel Admin
              </span>
            </button>
          </form>

        </div>
        {{-- END Form Card --}}

      </div>
    </div>
    {{-- END RIGHT COLUMN --}}
  </div>

  {{-- Password Visibility Toggle --}}
  <script>
    function togglePassword() {
      const input = document.getElementById('login-password');
      const eye = document.getElementById('eye-icon');
      const eyeOff = document.getElementById('eye-off-icon');

      if (input.type === 'password') {
        input.type = 'text';
        eye.classList.add('hidden');
        eyeOff.classList.remove('hidden');
      } else {
        input.type = 'password';
        eye.classList.remove('hidden');
        eyeOff.classList.add('hidden');
      }
    }
  </script>

  @stack('scripts')
</body>
</html>
