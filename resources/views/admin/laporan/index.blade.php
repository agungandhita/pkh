@extends('admin.layouts.main')

@section('container')
    <div class="space-y-4">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-semibold text-slate-900">Laporan</h1>
                <p class="mt-1 text-sm text-slate-600">Ringkasan hasil perangkingan untuk dicetak.</p>
            </div>
            <a href="{{ route('admin.laporan.pdf') }}"
                class="inline-flex h-10 items-center justify-center rounded-lg bg-slate-900 px-4 text-sm font-medium text-white hover:bg-slate-800">
                Cetak Laporan
            </a>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Peringkat</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">NIK</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Nama</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Nilai</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse ($hasil as $row)
                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-3 text-sm font-medium text-slate-900">{{ $row->peringkat }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-700">{{ $row->warga->nik ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm text-slate-900">{{ $row->warga->nama ?? '-' }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-700">{{ number_format((float) $row->nilai_preferensi, 6) }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm">
                                    @if ($row->status_kelayakan === 'layak')
                                        <span class="inline-flex rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">Layak</span>
                                    @else
                                        <span class="inline-flex rounded-full bg-rose-50 px-2.5 py-1 text-xs font-semibold text-rose-700">Tidak Layak</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-10 text-center text-sm text-slate-600">Belum ada hasil.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="border-t border-slate-200 p-4">
                {{ $hasil->links() }}
            </div>
        </div>
    </div>
@endsection

