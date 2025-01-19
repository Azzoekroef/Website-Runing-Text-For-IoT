<?php
namespace App\Http\Controllers;

use App\Models\DisplayMode;
use Illuminate\Http\Request;

class DisplayModeController extends Controller
{
    // Mendapatkan konfigurasi display modes
    public function getModes()
    {
        // Ambil semua konfigurasi display modes
        $displayModes = DisplayMode::all();

        return response()->json([
            'modes' => $displayModes
        ]);
    }

    // Menyimpan atau memperbarui konfigurasi display modes
    public function updateModes(Request $request)
    {
        $request->validate([
            'modes' => 'required|array',
            'modes.*.text' => 'required|string',
            'modes.*.mode' => 'required|integer|min:1|max:3',
            'modes.*.delay' => 'required|integer|min:0',
            'modes.*.direction' => 'required|boolean',
        ]);

        // Hapus data lama
        DisplayMode::truncate();

        // Simpan data baru
        foreach ($request->modes as $mode) {
            DisplayMode::create($mode);
        }

        return response()->json(['message' => 'Display modes updated successfully.']);
    }
}
