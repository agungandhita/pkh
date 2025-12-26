<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $warga = Warga::query()
            ->when($q !== '', function ($query) use ($q) {
                $query
                    ->where('nik', 'like', '%'.$q.'%')
                    ->orWhere('nama', 'like', '%'.$q.'%');
            })
            ->orderBy('nama')
            ->paginate(15)
            ->withQueryString();

        return view('admin.warga.index', compact('warga', 'q'));
    }

    public function create()
    {
        return view('admin.warga.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nik' => ['required', 'string', 'max:32', 'unique:warga,nik'],
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'rt' => ['required', 'string', 'max:4'],
            'rw' => ['required', 'string', 'max:4'],
            'status_dtks' => ['nullable', 'boolean'],
        ]);

        $data['status_dtks'] = (bool) ($data['status_dtks'] ?? false);

        Warga::query()->create($data);

        return redirect()->route('admin.warga.index')->with('success', 'Warga berhasil ditambahkan.');
    }

    public function edit(Warga $warga)
    {
        return view('admin.warga.edit', compact('warga'));
    }

    public function update(Request $request, Warga $warga): RedirectResponse
    {
        $data = $request->validate([
            'nik' => ['required', 'string', 'max:32', 'unique:warga,nik,'.$warga->id],
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'rt' => ['required', 'string', 'max:4'],
            'rw' => ['required', 'string', 'max:4'],
            'status_dtks' => ['nullable', 'boolean'],
        ]);

        $data['status_dtks'] = (bool) ($data['status_dtks'] ?? false);

        $warga->update($data);

        return redirect()->route('admin.warga.index')->with('success', 'Warga berhasil diperbarui.');
    }

    public function destroy(Warga $warga): RedirectResponse
    {
        $warga->delete();

        return redirect()->route('admin.warga.index')->with('success', 'Warga berhasil dihapus.');
    }
}
