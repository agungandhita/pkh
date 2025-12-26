@extends('admin.layouts.main')

@section('container')
    <div class="space-y-4">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-semibold text-slate-900">Data Warga</h1>
                <p class="mt-1 text-sm text-slate-600">Kelola data alternatif calon penerima bantuan PKH.</p>
            </div>
            <a href="{{ route('admin.warga.create') }}"
                class="inline-flex h-10 items-center justify-center rounded-lg bg-slate-900 px-4 text-sm font-medium text-white hover:bg-slate-800">
                Tambah Warga
            </a>
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
                    <a href="{{ route('admin.warga.index') }}"
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
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">RT/RW</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">DTKS</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-slate-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse ($warga as $row)
                            <tr class="hover:bg-slate-50">
                                <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-900">{{ $row->nik }}</td>
                                <td class="px-4 py-3 text-sm text-slate-900">
                                    <div class="font-medium">{{ $row->nama }}</div>
                                    <div class="mt-1 text-xs text-slate-500">{{ $row->alamat }}</div>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-700">{{ $row->rt }}/{{ $row->rw }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm">
                                    @if ($row->status_dtks)
                                        <span class="inline-flex rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">Ya</span>
                                    @else
                                        <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">Tidak</span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-4 py-3">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.warga.edit', $row) }}"
                                            class="inline-flex h-9 items-center justify-center rounded-lg border border-slate-200 bg-white px-3 text-sm font-medium text-slate-700 hover:bg-slate-50">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.warga.destroy', $row) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex h-9 items-center justify-center rounded-lg border border-rose-200 bg-white px-3 text-sm font-medium text-rose-700 hover:bg-rose-50">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-10 text-center text-sm text-slate-600">Belum ada data.</td>
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

