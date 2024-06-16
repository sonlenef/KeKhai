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
        $hosos = HoSo::latest()->paginate(500);
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
            'he_so_22' => 'required',
            'he_so_12' => 'required',
            'he_so_17' => 'required',
            'tu_ky' => 'required',
            'den_ky' => 'required',
            'gia_22' => 'required',
            'gia_17' => 'required',
            'gia_12' => 'required'
        ]);

        if ($request->has('id')) {
            // Nếu request có chứa id, đây là cố gắng chỉnh sửa một HoSo hiện có
            $hoso = HoSo::find($request->id);

            if ($hoso) {
                // Cập nhật các thuộc tính của HoSo
                $hoso->update($request->all());

                return redirect()->route('kekhai.index')->with('success', 'Hoso updated successfully.');
            } else {
                return redirect()->route('kekhai.index')->with('success', 'Hoso not found.');
            }
        } else {
            // Nếu không có id, tạo một bản ghi HoSo mới
            $hosoData = $request->except('id');
            HoSo::create($hosoData);
        }

        return redirect()->route('kekhai.create')->with('success', 'Saved Successfully.');
    }

    public function show(HoSo $hoso)
    {
        return redirect()->route('kekhai.index')->with('success', 'Created Successfully.');
    }

    public function edit(int $id)
    {
        $hoso = HoSo::findOrFail($id); // Retrieve the HoSo record based on the provided $id
        $doans = Doan::pluck('doan_duong')->toArray();
        $duong_phos = DuongPho::pluck('duong_pho')->toArray();
        return view('create', compact('hoso', 'duong_phos', 'doans'));
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