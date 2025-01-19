<?php
namespace App\Http\Controllers;

use App\Models\ModeText;
use Illuminate\Http\Request;

class ModeTextController extends Controller
{
    // Mendapatkan konfigurasi display modes
    public function getModesText()
    {
        // Ambil semua konfigurasi display modes
        $modeText = ModeText::all();
        $currentTime = time();
        $wibTime = $currentTime + (7 * 3600);
        $missday = $wibTime - (5 *24 *3600);
        return response()->json([
            'modes' => $modeText,
            'gettime' => $missday
        ]);
    }
    public function updateModesText(Request $request)
    {
        // echo $request;
        try {
            $request->validate([
            'modes' => 'required|array',
            'modes.*.text1' => 'required|string',
            'modes.*.text2' => 'string|nullable',
            'modes.*.mode' => 'required|integer|min:1|max:3',
            'modes.*.delay1' => 'required|integer|min:0',
            'modes.*.delay2' => 'integer|nullable|min:0',
            'modes.*.direction1' => 'required|integer|min:0|max:4',
            'modes.*.direction2' => 'integer|nullable|min:0|max:4',
        ]);
            ModeText::truncate();
            foreach ($request->modes as $mode) {
                ModeText::create($mode);
            }
            return response()->json(['message' => 'Display modes updated successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update display modes.'], 500);
        }  
        //     $request->validate([
        //     'modes' => 'required|array',
        //     'modes.*.text1' => 'required|string',
        //     'modes.*.text2' => 'string|nullable',
        //     'modes.*.mode' => 'required|integer|min:1|max:3',
        //     'modes.*.delay1' => 'required|integer|min:0',
        //     'modes.*.delay2' => 'integer|nullable|min:0',
        //     'modes.*.direction1' => 'required|integer|min:0|max:3',
        //     'modes.*.direction2' => 'integer|nullable|min:0|max:3',
        // ]);

    }
    // Menyimpan atau memperbarui konfigurasi display modes
    // public function updateModesText(Request $request)
    // {
    //     // echo "test";
    //     $request->validate([
    //         'modes' => 'required|array',
    //         'modes.*.text1' => 'required|string',
    //         'modes.*.text2' => 'string|nullable',
    //         'modes.*.mode' => 'required|integer|min:1|max:3',
    //         'modes.*.delay1' => 'required|integer|min:0',
    //         'modes.*.delay2' => 'integer|nullable|min:0',
    //         'modes.*.direction1' => 'required|integer|min:0|max:3',
    //         'modes.*.direction2' => 'integer|nullable|min:0|max:3',
    //     ]);
    //     // echo "test";
    //     // Hapus data lama
    //     try {
    //         ModeText::truncate();
    //         foreach ($request->modes as $mode) {
    //             ModeText::create($mode);
    //         }
    //         return response()->json(['message' => 'Display modes updated successfully.'], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Failed to update display modes.'], 500);
    //     }    
    // }
}
