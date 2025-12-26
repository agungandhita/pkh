@extends('admin.layouts.main')

@section('container')
    <div class="space-y-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-semibold text-slate-900">Perhitungan SAW</h1>
                <p class="mt-1 text-sm text-slate-600">Hitung normalisasi, nilai preferensi, dan perangkingan otomatis.</p>
            </div>
            <form action="{{ route('admin.saw.hitung') }}" method="POST">
                @csrf
                <button type="submit"
                    class="inline-flex h-10 items-center justify-center rounded-lg bg-slate-900 px-4 text-sm font-medium text-white hover:bg-slate-800">
                    Hitung SAW
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <div class="rounded-xl border border-slate-200 bg-white p-5">
                <div class="text-sm font-medium text-slate-600">Total Warga</div>
                <div class="mt-2 text-3xl font-semibold text-slate-900">{{ $wargaCount }}</div>
            </div>
            <div class="rounded-xl border border-slate-200 bg-white p-5">
                <div class="text-sm font-medium text-slate-600">Kriteria Aktif</div>
                <div class="mt-2 text-3xl font-semibold text-slate-900">{{ $kriteriaAktifCount }}</div>
            </div>
            <div class="rounded-xl border border-slate-200 bg-white p-5">
                <div class="text-sm font-medium text-slate-600">Hasil Tersimpan</div>
                <div class="mt-2 text-3xl font-semibold text-slate-900">{{ $hasilCount }}</div>
            </div>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6">
            <div class="text-base font-semibold text-slate-900">Catatan</div>
            <div class="mt-2 space-y-1 text-sm text-slate-700">
                <div>Pastikan seluruh warga sudah memiliki penilaian untuk semua kriteria aktif.</div>
                <div>Bobot kriteria akan dinormalisasi otomatis sebelum perhitungan.</div>
            </div>
        </div>
    </div>
@endsection

