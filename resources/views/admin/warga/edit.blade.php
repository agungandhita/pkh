@extends('admin.layouts.main')

@section('container')
    <div class="max-w-3xl">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-slate-900">Edit Warga</h1>
                <p class="mt-1 text-sm text-slate-600">Perbarui data warga.</p>
            </div>
            <a href="{{ route('admin.warga.index') }}"
                class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-200 bg-white px-4 text-sm font-medium text-slate-700 hover:bg-slate-50">
                Kembali
            </a>
        </div>

        <form action="{{ route('admin.warga.update', $warga) }}" method="POST"
            class="mt-4 rounded-xl border border-slate-200 bg-white p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label class="text-sm font-medium text-slate-700">NIK</label>
                    <input name="nik" value="{{ old('nik', $warga->nik) }}"
                        class="mt-1 h-10 w-full rounded-lg border border-slate-200 px-3 text-sm focus:border-slate-400 focus:outline-none" />
                </div>

                <div>
                    <label class="text-sm font-medium text-slate-700">Nama</label>
                    <input name="nama" value="{{ old('nama', $warga->nama) }}"
                        class="mt-1 h-10 w-full rounded-lg border border-slate-200 px-3 text-sm focus:border-slate-400 focus:outline-none" />
                </div>

                <div class="sm:col-span-2">
                    <label class="text-sm font-medium text-slate-700">Alamat</label>
                    <textarea name="alamat" rows="3"
                        class="mt-1 w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-slate-400 focus:outline-none">{{ old('alamat', $warga->alamat) }}</textarea>
                </div>

                <div>
                    <label class="text-sm font-medium text-slate-700">RT</label>
                    <input name="rt" value="{{ old('rt', $warga->rt) }}"
                        class="mt-1 h-10 w-full rounded-lg border border-slate-200 px-3 text-sm focus:border-slate-400 focus:outline-none" />
                </div>

                <div>
                    <label class="text-sm font-medium text-slate-700">RW</label>
                    <input name="rw" value="{{ old('rw', $warga->rw) }}"
                        class="mt-1 h-10 w-full rounded-lg border border-slate-200 px-3 text-sm focus:border-slate-400 focus:outline-none" />
                </div>
            </div>

            <div class="mt-4">
                <label class="inline-flex items-center gap-2 text-sm text-slate-700">
                    <input type="checkbox" name="status_dtks" value="1" @checked(old('status_dtks', $warga->status_dtks))
                        class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-900" />
                    Terdaftar DTKS
                </label>
            </div>

            <div class="mt-6 flex justify-end gap-2">
                <a href="{{ route('admin.warga.index') }}"
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

