<?php

namespace App\Http\Controllers;

use App\Models\WifiConfig;
use Illuminate\Http\Request;

class WifiConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil konfigurasi Wi-Fi pertama
        $wifiConfig = WifiConfig::first();
        
        // Mengirimkan data ke view
        return view('wifi', ['wifiConfig' => $wifiConfig]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function getWiFiConfigJson()
    {
        // Mengambil konfigurasi Wi-Fi pertama
        $wifiConfig = WifiConfig::first();

        if ($wifiConfig) {
            // Mengembalikan data Wi-Fi dalam format JSON
            return response()->json([
                'ssid' => $wifiConfig->ssid,
                'password' => $wifiConfig->password
            ]);
        } else {
            return response()->json([
                'error' => 'No Wi-Fi configuration found'
            ], 404);
        }
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ssid' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        // Cek jika sudah ada konfigurasi, jika ada update, jika tidak simpan baru
        $wifiConfig = WifiConfig::first();

        if ($wifiConfig) {
            $wifiConfig->update($validated);
        } else {
            WifiConfig::create($validated);
        }

        return redirect()->route('wifi')->with('success', 'Wifi telah diperbarui.');
    }

    /**
     * Display the specified resource.
     */
    public function show(WifiConfig $wifiConfig)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WifiConfig $wifiConfig)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WifiConfig $wifiConfig)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WifiConfig $wifiConfig)
    {
        //
    }
}
