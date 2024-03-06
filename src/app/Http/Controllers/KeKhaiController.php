<?php

namespace App\Http\Controllers;

use App\Models\Doan;
use App\Models\HoSo;
use App\Models\DuongPho;
use Illuminate\Http\Request;

class KeKhaiController extends Controller
{
    public function index()
    {
        $hosos = HoSo::latest()->paginate(50);
        return view("index", compact('hosos'))->with('i', (request()->input('page', 1) - 1) * 50);
    }

    public function create()
    {
        $doans = Doan::pluck('doan_duong')->toArray();
        $duong_phos = DuongPho::pluck('duong_pho')->toArray();
        return view('create', compact('duong_phos', 'doans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mst' => 'required',
            'ten' => 'required',
            'to' => 'required',
            'so_gcn' => 'required',
            'ngay_cap' => 'required',
            'tds' => 'required',
            'tbd' => 'required',
            'dt' => 'required',
            'duong_pho' => 'required',
            'doan_duong' => 'required',
            'dia_chi' => 'required',
            'han_muc' => 'required',
            'vi_tri' => 'required',
            'he_so' => 'required',
            'tu_ky' => 'required',
            'den_ky' => 'required',
            'gia_22' => 'required',
            'gia_17' => 'required',
            'gia_12' => 'required'
        ]);

        HoSo::create($request->all());
        return redirect()->route('kekhai.create')->with('success', 'Created Successfully.');
    }

    public function show(HoSo $hoso)
    {
        return redirect()->route('kekhai.index')->with('success', 'Created Successfully.');
    }

    public function edit(HoSo $hoso)
    {
        return redirect()->route('kekhai.index')->with('success', 'Created Successfully.');
    }

    public function destroy(int $id)
    {
        $hoso = HoSo::find($id);
        $hoso->delete();
        return redirect()->route('kekhai.index')->with('success', 'Hoso deleted successfully.');
    }

    public function reset()
    {
        HoSo::truncate();
        return response()->json(['message' => 'Success'], 200);
    }
}