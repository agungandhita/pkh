<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function edit()
    {
        $pengaturan = Pengaturan::query()->firstOrCreate(
            [],
            ['threshold_kelayakan' => 0.600000],
        );

        return view('admin.pengaturan.edit', compact('pengaturan'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'threshold_kelayakan' => ['required', 'numeric', 'min:0', 'max:1'],
        ]);

        Pengaturan::query()->updateOrCreate(
            [],
            ['threshold_kelayakan' => $data['threshold_kelayakan']],
        );

        return redirect()->route('admin.pengaturan.edit')->with('success', 'Pengaturan berhasil disimpan.');
    }
}
