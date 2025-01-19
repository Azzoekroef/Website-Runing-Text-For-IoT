<?php

namespace App\Http\Controllers;

use App\Models\Mode;
use Illuminate\Http\Request;

class ModeController extends Controller
{
    public function index()
    {
        return Mode::all();
    }

    public function store(Request $request)
    {
        $mode = Mode::create($request->all());
        return response()->json($mode, 201);
    }

    public function show($id)
    {
        return Mode::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $mode = Mode::findOrFail($id);
        $mode->update($request->all());
        return response()->json($mode, 200);
    }

    public function destroy($id)
    {
        Mode::destroy($id);
        return response()->json(null, 204);
    }

    public function manageModesView()
{
    $modes = Mode::all();
    return view('manage-modes', compact('modes'));
}

}

