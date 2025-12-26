<header class="fixed inset-x-0 top-0 z-30 border-b border-slate-200 bg-white/90 backdrop-blur md:pl-64">
    <div class="h-16 px-4 sm:px-6 lg:px-8">
        <div class="flex h-full items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <button type="button" data-sidebar-open
                    class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 md:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                        <path fill-rule="evenodd"
                            d="M3 6.75A.75.75 0 013.75 6h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.75zm0 5.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm0 5.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 17.25z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-900 text-white">
                        <span class="text-sm font-semibold">PKH</span>
                    </div>
                    <div class="leading-tight">
                        <div class="text-sm font-semibold text-slate-900">{{ config('app.name', 'PKH') }}</div>
                        <div class="text-xs text-slate-500">Admin Dashboard</div>
                    </div>
                </a>
            </div>

            <div class="flex items-center gap-3">
                <div class="hidden text-right sm:block">
                    <div class="text-sm font-semibold text-slate-900">{{ auth()->user()->name ?? 'Admin' }}</div>
                    <div class="text-xs text-slate-500">{{ auth()->user()->email ?? '' }}</div>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-200 bg-white px-3 text-sm font-medium text-slate-700 hover:bg-slate-50">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
