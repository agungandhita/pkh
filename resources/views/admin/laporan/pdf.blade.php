<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laporan Hasil SAW</title>
        <style>
            :root { color-scheme: light; }
            body { font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial; font-size: 12px; color: #0f172a; }
            h1 { font-size: 18px; margin: 0 0 6px; }
            .muted { color: #475569; }
            table { width: 100%; border-collapse: collapse; margin-top: 14px; }
            th, td { border: 1px solid #e2e8f0; padding: 8px; vertical-align: top; }
            th { background: #f8fafc; text-align: left; }
            .badge { display: inline-block; padding: 2px 8px; border-radius: 999px; font-weight: 600; font-size: 11px; }
            .ok { background: #ecfdf5; color: #047857; }
            .no { background: #fff1f2; color: #be123c; }
        </style>
    </head>
    <body>
        <h1>Laporan Hasil Rekomendasi PKH (SAW)</h1>
        <div class="muted">Tanggal cetak: {{ now()->format('d/m/Y H:i') }}</div>

        <table>
            <thead>
                <tr>
                    <th style="width: 80px;">Peringkat</th>
                    <th style="width: 160px;">NIK</th>
                    <th>Nama</th>
                    <th style="width: 140px;">Nilai</th>
                    <th style="width: 120px;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($hasil as $row)
                    <tr>
                        <td>{{ $row->peringkat }}</td>
                        <td>{{ $row->warga->nik ?? '-' }}</td>
                        <td>{{ $row->warga->nama ?? '-' }}</td>
                        <td>{{ number_format((float) $row->nilai_preferensi, 6) }}</td>
                        <td>
                            @if ($row->status_kelayakan === 'layak')
                                <span class="badge ok">Layak</span>
                            @else
                                <span class="badge no">Tidak Layak</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Belum ada data hasil.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </body>
</html>

