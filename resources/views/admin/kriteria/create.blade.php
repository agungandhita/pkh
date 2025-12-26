@extends('admin.layouts.main')

@section('container')
    <div class="max-w-3xl">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-slate-900">Tambah Kriteria</h1>
                <p class="mt-1 text-sm text-slate-600">Tambahkan kriteria penilaian SAW.</p>
            </div>
            <a href="{{ route('admin.kriteria.index') }}"
                class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-200 bg-white px-4 text-sm font-medium text-slate-700 hover:bg-slate-50">
                Kembali
            </a>
        </div>

        <form action="{{ route('admin.kriteria.store') }}" method="POST"
            class="mt-4 rounded-xl border border-slate-200 bg-white p-6">
            @csrf

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label class="text-sm font-medium text-slate-700">Kode Kriteria</label>
                    <input name="kode_kriteria" value="{{ old('kode_kriteria') }}"
                        class="mt-1 h-10 w-full rounded-lg border border-slate-200 px-3 text-sm focus:border-slate-400 focus:outline-none"
                        placeholder="C1" />
                </div>

                <div>
                    <label class="text-sm font-medium text-slate-700">Bobot</label>
                    <input name="bobot" value="{{ old('bobot') }}" inputmode="decimal"
                        class="mt-1 h-10 w-full rounded-lg border border-slate-200 px-3 text-sm focus:border-slate-400 focus:outline-none"
                        placeholder="0.02" />
                </div>

                <div class="sm:col-span-2">
                    <label class="text-sm font-medium text-slate-700">Nama Kriteria</label>
                    <input name="nama_kriteria" value="{{ old('nama_kriteria') }}"
                        class="mt-1 h-10 w-full rounded-lg border border-slate-200 px-3 text-sm focus:border-slate-400 focus:outline-none" />
                </div>

                <div>
                    <label class="text-sm font-medium text-slate-700">Jenis Atribut</label>
                    <select name="jenis_atribut"
                        class="mt-1 h-10 w-full rounded-lg border border-slate-200 bg-white px-3 text-sm focus:border-slate-400 focus:outline-none">
                        <option value="benefit" @selected(old('jenis_atribut') === 'benefit')>benefit</option>
                        <option value="cost" @selected(old('jenis_atribut') === 'cost')>cost</option>
                    </select>
                </div>

                <div class="flex items-end">
                    <label class="inline-flex items-center gap-2 text-sm text-slate-700">
                        <input type="checkbox" name="status" value="1" @checked(old('status', true))
                            class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-900" />
                        Aktif
                    </label>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-2">
                <a href="{{ route('admin.kriteria.index') }}"
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

