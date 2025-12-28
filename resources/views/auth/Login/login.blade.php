@extends('auth.layouts.main')

@section('container')
<div class="min-h-screen flex items-center justify-center bg-[#f8f9fa] p-4">
    <div class="max-w-4xl w-full bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row border border-gray-100">
        <!-- Left Side: Branding/Info -->
        <div class="w-full md:w-1/2 bg-black p-10 flex flex-col justify-center items-center text-white text-center">
            <img src="{{ asset('img/logo.png') }}" alt="{{ config('app.name') }} Logo" class="w-32 mb-6 drop-shadow-lg" />
            <h1 class="text-3xl font-extrabold tracking-tight mb-2">
                {{ config('app.name') }}
            </h1>
            <p class="text-gray-400 text-sm max-w-xs mx-auto">
                Sistem Informasi Terpadu Pelayanan Masyarakat. Masuk untuk mengakses dasboard admin.
            </p>
            <div class="mt-8 pt-8 border-t border-gray-800 w-full">
                <p class="text-xs text-gray-500 italic">"Melayani dengan Integritas dan Transparansi"</p>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full md:w-1/2 p-10 bg-white">
            <div class="mb-10">
                <h2 class="text-2xl font-bold text-gray-900">Selamat Datang</h2>
                <p class="text-gray-500 text-sm mt-1">Silakan masuk ke akun Anda</p>
            </div>

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded-r-lg">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded-r-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="text-gray-700 text-xs font-bold uppercase tracking-wider mb-2 block">Alamat Email</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-black transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input name="email" type="email" required
                            class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-black focus:border-transparent outline-none transition-all text-sm"
                            placeholder="nama@email.com" value="{{ old('email') }}" />
                    </div>
                </div>

                <div>
                    <label class="text-gray-700 text-xs font-bold uppercase tracking-wider mb-2 block">Kata Sandi</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-black transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input name="password" type="password" required
                            class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-black focus:border-transparent outline-none transition-all text-sm"
                            placeholder="••••••••" />
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember" type="checkbox" class="h-4 w-4 text-black focus:ring-black border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-600">Ingat saya</label>
                    </div>
                </div>

                <button type="submit"
                    class="w-full py-4 px-6 bg-black hover:bg-gray-800 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                    Masuk Sekarang
                </button>
            </form>

            <div class="mt-10 text-center">
                <p class="text-gray-400 text-xs">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

