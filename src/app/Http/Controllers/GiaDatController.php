<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GiaDat;
use App\Models\Doan;
use App\Models\DuongPho;
use App\Models\ViTri;

class GiaDatController extends Controller
{
    public function search(Request $request)
    {
        $duongStr = $request->get('duong');
        $doanStr = $request->get('doan');
        $viTriStr = $request->get('vi_tri');

        $duong = DuongPho::where('duong_pho', $duongStr)->first();
        $doan = Doan::where('doan_duong', $doanStr)->first();
        $viTri = ViTri::where('vi_tri', $viTriStr)->first();

        if (!$duong || !$doan || !$viTri) {
            return response()->json([]);
        }

        $results = GiaDat::where('duong_id', $duong->id)
            ->where('doan_id', $doan->id)
            ->where('vi_tri_id', $viTri->id)
            ->get();

        return response()->json($results);
    }
}