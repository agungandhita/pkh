@extends('admin.layouts.main')

@section('container')
    <div class="max-w-2xl">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-slate-900">Tambah Sub Kriteria</h1>
                <p class="mt-1 text-sm text-slate-600">{{ $kriteria->kode_kriteria }} — {{ $kriteria->nama_kriteria }}</p>
            </div>
            <a href="{{ route('admin.kriteria.sub-kriteria.index', $kriteria) }}"
                class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-200 bg-white px-4 text-sm font-medium text-slate-700 hover:bg-slate-50">
                Kembali
            </a>
        </div>

        <form action="{{ route('admin.kriteria.sub-kriteria.store', $kriteria) }}" method="POST"
            class="mt-4 rounded-xl border border-slate-200 bg-white p-6">
            @csrf

            <div class="space-y-4">
                <div>
                    <label class="text-sm font-medium text-slate-700">Nama Sub Kriteria</label>
                    <input name="nama_sub_kriteria" value="{{ old('nama_sub_kriteria') }}"
                        class="mt-1 h-10 w-full rounded-lg border border-slate-200 px-3 text-sm focus:border-slate-400 focus:outline-none" />
                </div>

                <div>
                    <label class="text-sm font-medium text-slate-700">Nilai</label>
                    <select name="nilai"
                        class="mt-1 h-10 w-full rounded-lg border border-slate-200 bg-white px-3 text-sm focus:border-slate-400 focus:outline-none">
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" @selected((int) old('nilai', 3) === $i)>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-2">
                <a href="{{ route('admin.kriteria.sub-kriteria.index', $kriteria) }}"
                    class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-200 bg-white px-4 text-sm font-medium text-slate-700 hover:bg-slate-50">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex h-10 items-center justify-center rounded-lg bg-slate-900 px-4 text-sm font-medium text-white hover:bg-slate-800">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection

