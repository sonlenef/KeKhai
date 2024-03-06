<?php

namespace App\Http\Controllers;

use App\Models\DuongPho;
use App\Models\GiaDat;
use App\Models\Doan;
use Illuminate\Http\Request;

class DoanDuongController extends Controller
{
    public function search(Request $request)
    {
        $duongStr = $request->get('duong');

        $duong = DuongPho::where('duong_pho', $duongStr)->first();

        if (!$duong) {
            return response()->json([]);
        }

        $giaDats = GiaDat::where('duong_id', $duong->id)
            ->get();

        if ($giaDats->isEmpty()) {
            return response()->json([]);
        }

        $doanIds = $giaDats->pluck('doan_id');
        $results = Doan::whereIn('id', $doanIds)->get();

        return response()->json($results);
    }
}