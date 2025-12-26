@extends('admin.layouts.main')

@section('container')
    <div class="space-y-4">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-semibold text-slate-900">Sub Kriteria</h1>
                <p class="mt-1 text-sm text-slate-600">{{ $kriteria->kode_kriteria }} — {{ $kriteria->nama_kriteria }}</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.kriteria.index') }}"
                    class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-200 bg-white px-4 text-sm font-medium text-slate-700 hover:bg-slate-50">
                    Kembali
                </a>
                <a href="{{ route('admin.kriteria.sub-kriteria.create', $kriteria) }}"
                    class="inline-flex h-10 items-center justify-center rounded-lg bg-slate-900 px-4 text-sm font-medium text-white hover:bg-slate-800">
                    Tambah Sub Kriteria
                </a>
            </div>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Nama</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Nilai</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-slate-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse ($subKriteria as $row)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3 text-sm text-slate-900">{{ $row->nama_sub_kriteria }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-700">{{ $row->nilai }}</td>
                                <td class="whitespace-nowrap px-4 py-3">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.sub-kriteria.edit', $row) }}"
                                            class="inline-flex h-9 items-center justify-center rounded-lg border border-slate-200 bg-white px-3 text-sm font-medium text-slate-700 hover:bg-slate-50">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.sub-kriteria.destroy', $row) }}" method="POST">
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
                                <td colspan="3" class="px-4 py-10 text-center text-sm text-slate-600">Belum ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
