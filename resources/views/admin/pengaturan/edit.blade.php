@extends('admin.layouts.main')

@section('container')
    <div class="max-w-2xl">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-slate-900">Pengaturan</h1>
                <p class="mt-1 text-sm text-slate-600">Atur threshold kelayakan untuk status rekomendasi.</p>
            </div>
        </div>

        <form action="{{ route('admin.pengaturan.update') }}" method="POST"
            class="mt-4 rounded-xl border border-slate-200 bg-white p-6">
            @csrf
            @method('PUT')

            <div>
                <label class="text-sm font-medium text-slate-700">Threshold Kelayakan (0 - 1)</label>
                <input type="number" name="threshold_kelayakan" step="0.01" min="0" max="1"
                    value="{{ old('threshold_kelayakan', $pengaturan->threshold_kelayakan) }}"
                    class="mt-1 h-10 w-full rounded-lg border border-slate-200 px-3 text-sm focus:border-slate-400 focus:outline-none" />
                <div class="mt-2 text-sm text-slate-600">Warga dengan nilai preferensi \(\ge\) threshold akan dianggap layak.</div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit"
                    class="inline-flex h-10 items-center justify-center rounded-lg bg-slate-900 px-4 text-sm font-medium text-white hover:bg-slate-800">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection

