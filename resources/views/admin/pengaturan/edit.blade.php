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
            class="mt-4 rounded-xl border border-slate-200 bg-white overflow-hidden">
            @csrf
            @method('PUT')

            <div class="p-6">
                <div class="mb-6 rounded-lg bg-blue-50 border border-blue-100 p-4">
                    <h3 class="text-sm font-bold text-blue-900 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A1.75 1.75 0 0 0 10.747 15H11a.75.75 0 0 0 0-1.5h-.253a.25.25 0 0 1-.244-.304l.459-2.066A1.75 1.75 0 0 0 9.253 9H9Z" clip-rule="evenodd" />
                        </svg>
                        Apa itu Threshold Kelayakan?
                    </h3>
                    <div class="mt-2 text-sm text-blue-800 space-y-2">
                        <p><strong>Threshold Kelayakan</strong> (Passing Grade) adalah <em>nilai batas minimum</em> yang digunakan oleh sistem untuk menentukan apakah seorang warga berhak menerima bantuan PKH atau tidak.</p>
                        <ul class="list-disc pl-5 space-y-1">
                            <li>Jika skor akhir SAW warga &ge; Threshold, maka statusnya <strong>Layak</strong>.</li>
                            <li>Jika skor akhir SAW warga &lt; Threshold, maka statusnya <strong>Tidak Layak</strong>.</li>
                        </ul>
                        <p class="text-xs pt-1 opacity-90">Contoh: Jika Anda set batas di <strong>0.75</strong>, maka warga dengan skor 0.78 akan lolos, sedangkan warga berpoin 0.74 akan ditolak.</p>
                    </div>
                </div>

                <div>
                    <label class="text-sm font-semibold text-slate-900">Batas Nilai Minimal (0.01 - 1.00)</label>
                    <div class="relative mt-2">
                        <input type="number" name="threshold_kelayakan" step="0.01" min="0" max="1"
                            value="{{ old('threshold_kelayakan', $pengaturan->threshold_kelayakan) }}"
                            class="block h-11 w-full sm:max-w-xs rounded-lg border border-slate-300 px-4 text-slate-900 focus:border-slate-500 focus:ring-1 focus:ring-slate-500 font-mono text-lg" 
                            placeholder="0.60" />
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none hidden">
                            <!-- Icon spacer -->
                        </div>
                    </div>
                    <div class="mt-2 flex items-center gap-2 text-xs text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                        </svg>
                        Saran: Sesuaikan nilai ini dengan rata-rata skor warga atau berdasarkan kuota kuota bantuan dari dinas.
                    </div>
                </div>
            </div>

            <div class="bg-slate-50 px-6 py-4 flex justify-end border-t border-slate-200">
                <button type="submit"
                    class="inline-flex h-10 items-center justify-center rounded-lg bg-slate-900 px-6 text-sm font-semibold text-white transition-colors hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-900 focus:ring-offset-2">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
@endsection

