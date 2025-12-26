<!DOCTYPE html>
<html lang="id">
    <head>
        @include('admin.partials.start')
    </head>
    <body class="bg-slate-50 text-slate-900">
        <div class="min-h-screen">
            <div class="flex">
                @include('admin.partials.sidebar')

                <div class="min-w-0 flex-1 md:pl-64">
                    @include('admin.partials.header')

                    <main class="px-4 sm:px-6 lg:px-8 py-6 mt-16">
                        @if (session('success'))
                            <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-900">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-rose-900">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-rose-900">
                                <div class="font-semibold">Periksa kembali input Anda.</div>
                                <ul class="mt-2 list-disc space-y-1 pl-5 text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @yield('container')
                    </main>
                </div>
            </div>
        </div>

        @include('admin.partials.end')
    </body>
</html>
