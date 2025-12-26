@extends('admin.layouts.main')

@section('container')
    <div class="space-y-6">
        <div class="flex flex-col gap-1">
            <h1 class="text-xl font-semibold text-slate-900">Dashboard</h1>
            <p class="text-sm text-slate-600">Ringkasan data Sistem Pendukung Keputusan PKH (SAW).</p>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <a href="{{ route('admin.warga.index') }}" class="rounded-xl border border-slate-200 bg-white p-5 hover:bg-slate-50">
                <div class="text-sm font-medium text-slate-600">Total Warga</div>
                <div class="mt-2 text-3xl font-semibold text-slate-900">{{ $wargaCount }}</div>
            </a>

            <a href="{{ route('admin.kriteria.index') }}"
                class="rounded-xl border border-slate-200 bg-white p-5 hover:bg-slate-50">
                <div class="text-sm font-medium text-slate-600">Kriteria Aktif</div>
                <div class="mt-2 text-3xl font-semibold text-slate-900">{{ $kriteriaAktifCount }}</div>
            </a>

            <a href="{{ route('admin.penilaian.index') }}"
                class="rounded-xl border border-slate-200 bg-white p-5 hover:bg-slate-50">
                <div class="text-sm font-medium text-slate-600">Total Penilaian</div>
                <div class="mt-2 text-3xl font-semibold text-slate-900">{{ $penilaianCount }}</div>
            </a>

            <a href="{{ route('admin.hasil.index') }}" class="rounded-xl border border-slate-200 bg-white p-5 hover:bg-slate-50">
                <div class="text-sm font-medium text-slate-600">Hasil SAW</div>
                <div class="mt-2 text-3xl font-semibold text-slate-900">{{ $hasilCount }}</div>
            </a>
        </div>

        <div class="grid grid-cols-1 gap-4 xl:grid-cols-3">
            <div class="rounded-xl border border-slate-200 bg-white p-6 xl:col-span-2">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-base font-semibold text-slate-900">Alur Cepat</div>
                        <div class="mt-1 text-sm text-slate-600">Langkah ringkas untuk mendapatkan hasil rekomendasi.</div>
                    </div>
                </div>

                <ol class="mt-4 space-y-3 text-sm text-slate-700">
                    <li class="flex gap-3">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-slate-900 text-white">1</span>
                        <div>
                            <div class="font-medium text-slate-900">Input data warga</div>
                            <div class="text-slate-600">Tambahkan alternatif calon penerima bantuan.</div>
                        </div>
                    </li>
                    <li class="flex gap-3">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-slate-900 text-white">2</span>
                        <div>
                            <div class="font-medium text-slate-900">Atur kriteria & bobot</div>
                            <div class="text-slate-600">Aktifkan kriteria yang dipakai, pastikan bobot benar.</div>
                        </div>
                    </li>
                    <li class="flex gap-3">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-slate-900 text-white">3</span>
                        <div>
                            <div class="font-medium text-slate-900">Isi penilaian</div>
                            <div class="text-slate-600">Masukkan nilai 1–5 untuk setiap warga.</div>
                        </div>
                    </li>
                    <li class="flex gap-3">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-slate-900 text-white">4</span>
                        <div>
                            <div class="font-medium text-slate-900">Hitung SAW</div>
                            <div class="text-slate-600">Normalisasi, pembobotan, dan perangkingan otomatis.</div>
                        </div>
                    </li>
                </ol>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-6">
                <div class="text-base font-semibold text-slate-900">Threshold Kelayakan</div>
                <div class="mt-1 text-sm text-slate-600">Nilai minimum untuk status “layak”.</div>
                <div class="mt-4 rounded-lg border border-slate-200 bg-slate-50 px-4 py-3">
                    <div class="text-3xl font-semibold text-slate-900">{{ number_format((float) $threshold, 2) }}</div>
                    <div class="mt-1 text-sm text-slate-600">Atur di halaman pengaturan.</div>
                </div>
                <a href="{{ route('admin.pengaturan.edit') }}"
                    class="mt-4 inline-flex h-10 w-full items-center justify-center rounded-lg bg-slate-900 px-4 text-sm font-medium text-white hover:bg-slate-800">
                    Buka Pengaturan
                </a>
            </div>
        </div>
    </div>
@endsection
