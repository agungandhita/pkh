@extends('admin.layouts.main')

@section('container')
    <div class="space-y-4">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-semibold text-slate-900">Input Penilaian</h1>
                <p class="mt-1 text-sm text-slate-600">{{ $warga->nik }} — {{ $warga->nama }}</p>
            </div>
            <a href="{{ route('admin.penilaian.index') }}"
                class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-200 bg-white px-4 text-sm font-medium text-slate-700 hover:bg-slate-50">
                Kembali
            </a>
        </div>

        <form action="{{ route('admin.penilaian.update', $warga) }}" method="POST"
            class="rounded-xl border border-slate-200 bg-white">
            @csrf
            @method('PUT')

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Kriteria</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Nilai</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse ($kriteria as $k)
                            @php
                                $oldValue = old('nilai.'.$k->id);
                                $currentValue = $existing[$k->id]->nilai ?? null;
                                $selected = $oldValue !== null ? (string) $oldValue : ($currentValue !== null ? (string) $currentValue : '');
                            @endphp
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3 text-sm text-slate-900">
                                    <div class="font-medium">{{ $k->kode_kriteria }} — {{ $k->nama_kriteria }}</div>
                                    <div class="mt-1 text-xs text-slate-500">Bobot: {{ number_format((float) $k->bobot, 4) }} • {{ $k->jenis_atribut }}</div>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <select name="nilai[{{ $k->id }}]"
                                        class="h-10 w-full rounded-lg border border-slate-200 bg-white px-3 text-sm focus:border-slate-400 focus:outline-none">
                                        <option value="" @selected($selected === '')>Pilih nilai...</option>
                                        @foreach ($k->subKriteria as $sub)
                                            <option value="{{ $sub->nilai }}" @selected($selected === (string) $sub->nilai)>
                                                {{ $sub->nilai }} — {{ $sub->nama_sub_kriteria }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-4 py-10 text-center text-sm text-slate-600">Belum ada kriteria aktif.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end gap-2 border-t border-slate-200 p-4">
                <a href="{{ route('admin.penilaian.index') }}"
                    class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-200 bg-white px-4 text-sm font-medium text-slate-700 hover:bg-slate-50">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex h-10 items-center justify-center rounded-lg bg-slate-900 px-4 text-sm font-medium text-white hover:bg-slate-800">
                    Simpan Penilaian
                </button>
            </div>
        </form>
    </div>
@endsection

