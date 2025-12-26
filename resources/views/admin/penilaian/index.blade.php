@extends('admin.layouts.main')

@section('container')
    <div class="space-y-4">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-semibold text-slate-900">Penilaian Warga</h1>
                <p class="mt-1 text-sm text-slate-600">Input nilai warga untuk seluruh kriteria aktif.</p>
            </div>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white">
            <div class="border-b border-slate-200 p-4">
                <form method="GET" class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <div class="flex-1">
                        <input type="text" name="q" value="{{ $q }}"
                            class="h-10 w-full rounded-lg border border-slate-200 bg-white px-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-slate-400 focus:outline-none"
                            placeholder="Cari NIK atau nama..." />
                    </div>
                    <button type="submit"
                        class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-200 bg-white px-4 text-sm font-medium text-slate-700 hover:bg-slate-50">
                        Cari
                    </button>
                    <a href="{{ route('admin.penilaian.index') }}"
                        class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-200 bg-white px-4 text-sm font-medium text-slate-700 hover:bg-slate-50">
                        Reset
                    </a>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">NIK</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Nama</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Terisi</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-slate-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse ($warga as $row)
                            @php
                                $filled = (int) $row->penilaian_count;
                                $total = (int) $kriteriaAktifCount;
                            @endphp
                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-900">{{ $row->nik }}</td>
                                <td class="px-4 py-3 text-sm text-slate-900">{{ $row->nama }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm">
                                    @if ($total === 0)
                                        <span class="inline-flex rounded-full bg-rose-50 px-2.5 py-1 text-xs font-semibold text-rose-700">Kriteria belum aktif</span>
                                    @elseif ($filled >= $total)
                                        <span class="inline-flex rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">Lengkap</span>
                                    @else
                                        <span class="inline-flex rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-800">{{ $filled }}/{{ $total }}</span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-right">
                                    <a href="{{ route('admin.penilaian.edit', $row) }}"
                                        class="inline-flex h-9 items-center justify-center rounded-lg bg-slate-900 px-3 text-sm font-medium text-white hover:bg-slate-800">
                                        Input Nilai
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-10 text-center text-sm text-slate-600">Belum ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="border-t border-slate-200 p-4">
                {{ $warga->links() }}
            </div>
        </div>
    </div>
@endsection

