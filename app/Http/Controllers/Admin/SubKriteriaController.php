<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    public function index(Kriteria $kriterium)
    {
        $subKriteria = $kriterium->subKriteria()->orderBy('nilai')->get();

        return view('admin.sub_kriteria.index', ['kriteria' => $kriterium, 'subKriteria' => $subKriteria]);
    }

    public function create(Kriteria $kriterium)
    {
        return view('admin.sub_kriteria.create', ['kriteria' => $kriterium]);
    }

    public function store(Request $request, Kriteria $kriterium): RedirectResponse
    {
        $data = $request->validate([
            'nama_sub_kriteria' => ['required', 'string', 'max:255'],
            'nilai' => ['required', 'integer', 'min:1', 'max:5'],
        ]);

        $kriterium->subKriteria()->create($data);

        return redirect()->route('admin.kriteria.sub-kriteria.index', $kriterium)->with('success', 'Sub kriteria berhasil ditambahkan.');
    }

    public function edit(SubKriteria $sub_kriterium)
    {
        $kriteria = $sub_kriterium->kriteria()->firstOrFail();

        return view('admin.sub_kriteria.edit', ['kriteria' => $kriteria, 'sub_kriteria' => $sub_kriterium]);
    }

    public function update(Request $request, SubKriteria $sub_kriterium): RedirectResponse
    {
        $data = $request->validate([
            'nama_sub_kriteria' => ['required', 'string', 'max:255'],
            'nilai' => ['required', 'integer', 'min:1', 'max:5'],
        ]);

        $kriteriaId = $sub_kriterium->kriteria_id;

        $sub_kriterium->update($data);

        return redirect()->route('admin.kriteria.sub-kriteria.index', $kriteriaId)->with('success', 'Sub kriteria berhasil diperbarui.');
    }

    public function destroy(SubKriteria $sub_kriterium): RedirectResponse
    {
        $kriteriaId = $sub_kriterium->kriteria_id;

        $sub_kriterium->delete();

        return redirect()->route('admin.kriteria.sub-kriteria.index', $kriteriaId)->with('success', 'Sub kriteria berhasil dihapus.');
    }
}
