<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $kriteria = Kriteria::query()
            ->when($q !== '', function ($query) use ($q) {
                $query
                    ->where('kode_kriteria', 'like', '%'.$q.'%')
                    ->orWhere('nama_kriteria', 'like', '%'.$q.'%');
            })
            ->orderBy('kode_kriteria')
            ->paginate(15)
            ->withQueryString();

        return view('admin.kriteria.index', compact('kriteria', 'q'));
    }

    public function create()
    {
        return view('admin.kriteria.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'kode_kriteria' => ['required', 'string', 'max:16', 'unique:kriteria,kode_kriteria'],
            'nama_kriteria' => ['required', 'string', 'max:255'],
            'bobot' => ['required', 'numeric', 'min:0'],
            'jenis_atribut' => ['required', 'in:benefit,cost'],
            'status' => ['nullable', 'boolean'],
        ]);

        $data['status'] = (bool) ($data['status'] ?? false);

        Kriteria::query()->create($data);

        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil ditambahkan.');
    }

    public function edit(Kriteria $kriterium)
    {
        return view('admin.kriteria.edit', ['kriteria' => $kriterium]);
    }

    public function update(Request $request, Kriteria $kriterium): RedirectResponse
    {
        $data = $request->validate([
            'kode_kriteria' => ['required', 'string', 'max:16', 'unique:kriteria,kode_kriteria,'.$kriterium->id],
            'nama_kriteria' => ['required', 'string', 'max:255'],
            'bobot' => ['required', 'numeric', 'min:0'],
            'jenis_atribut' => ['required', 'in:benefit,cost'],
            'status' => ['nullable', 'boolean'],
        ]);

        $data['status'] = (bool) ($data['status'] ?? false);

        $kriterium->update($data);

        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil diperbarui.');
    }

    public function destroy(Kriteria $kriterium): RedirectResponse
    {
        $kriterium->delete();

        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil dihapus.');
    }
}
