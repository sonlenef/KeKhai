<?php

namespace App\Http\Controllers;

use App\Models\HoSo;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date as SharedDate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\GiaDat;
use App\Models\Doan;
use App\Models\DuongPho;
use App\Models\ViTri;
use Illuminate\Support\Facades\Log;

class ExcelController extends Controller
{
    public function export()
    {
        $hosos = HoSo::all();

        // Tạo một đối tượng Spreadsheet
        $spreadsheet = new Spreadsheet();

        // Lấy active sheet
        $sheet1 = $spreadsheet->getActiveSheet();
        $sheet1->setTitle('DS Tờ Khai');

        $sheet2 = $spreadsheet->createSheet();
        $sheet2->setTitle('DS DP Tờ Khai');

        // // Đặt giá trị cho tiêu đề các cột
        // $sheet->setCellValue('A1', 'MST');
        // $sheet->setCellValue('B1', 'Tên');
        // $sheet->setCellValue('C1', 'Tổ');
        // $sheet->setCellValue('D1', 'Số GCN');
        // $sheet->setCellValue('E1', 'Ngày cấp');
        // $sheet->setCellValue('F1', 'Thửa');
        // $sheet->setCellValue('G1', 'TBD');
        // $sheet->setCellValue('H1', 'DT');
        // $sheet->setCellValue('I1', 'Đường/phố');
        // $sheet->setCellValue('J1', 'Đoạn đường');
        // $sheet->setCellValue('K1', 'Địa chỉ thửa đất');
        // $sheet->setCellValue('L1', 'Hạn mức');
        // $sheet->setCellValue('M1', 'Vị trí');
        // $sheet->setCellValue('N1', 'Hệ số 22-26');
        // $sheet->setCellValue('O1', 'Hệ số 12-16');
        // $sheet->setCellValue('P1', 'Hệ số 17-21');
        // $sheet->setCellValue('Q1', 'Từ kỳ');
        // $sheet->setCellValue('R1', 'Đến kỳ');
        // $sheet->setCellValue('S1', 'Giá đất 22-26CN');
        // $sheet->setCellValue('T1', 'Giá 1 m2 đất 22-23CN');
        // $sheet->setCellValue('U1', 'Thuế/năm GĐ 22-26CN');
        // $sheet->setCellValue('V1', 'Thuế GĐ 22-26CN ');
        // $sheet->setCellValue('W1', 'Giá đất GĐ 17-21CN');
        // $sheet->setCellValue('X1', 'Thuế/năm GĐ 17-21CN ');
        // $sheet->setCellValue('Y1', 'Thuế GĐ 17-21CN ');
        // $sheet->setCellValue('Z1', 'Giá đất GĐ 12-16CN');
        // $sheet->setCellValue('AA1', 'Thuế/năm GĐ 12-16CN ');
        // $sheet->setCellValue('AB1', 'Thuế GĐ 12-16CN ');

        // Tô màu cho hàng 1
        // $styleArray = [
        //     'fill' => [
        //         'fillType' => Fill::FILL_SOLID,
        //         'startColor' => [
        //             'rgb' => 'FFFF00', // Màu vàng
        //         ],
        //     ],
        // ];
        // $sheet->getStyle('1')->applyFromArray($styleArray);

        // Dòng bắt đầu ghi dữ liệu, ở đây bắt đầu từ dòng 2 vì dòng 1 đã dành cho tiêu đề
        $row = 1;
        $rowDP = 1;

        foreach ($hosos as $hoso) {
            $tuKyDate = Carbon::createFromFormat('m/Y', $hoso->tu_ky);
            $tuKyString = $tuKyDate->format('m/Y');

            $gia1m22223 = floatval($hoso->gia_22) * floatval($hoso->he_so_22);

            $dtHM = 0.0;
            $dt3HM = 0.0;
            $dtQuaHM = 0.0;
            if (floatval(str_replace(',', '.', $hoso->dt)) < floatval($hoso->han_muc)) {
                $dtHM = floatval(str_replace(',', '.', $hoso->dt));
            } else if (floatval(str_replace(',', '.', $hoso->dt)) > floatval($hoso->han_muc) && floatval(str_replace(',', '.', $hoso->dt)) <= 4 * floatval($hoso->han_muc)) {
                $dt3HM = floatval(str_replace(',', '.', $hoso->dt)) - floatval($hoso->han_muc);
                $dtHM = floatval($hoso->han_muc);
            } else {
                $dt3HM = 3 * floatval($hoso->han_muc);
                $dtHM = floatval($hoso->han_muc);
                $dtQuaHM = floatval(str_replace(',', '.', $hoso->dt)) - 4 * floatval($hoso->han_muc);
            }

            $thuenam2226 = $gia1m22223 * ($dtHM * (0.03 / 100) + $dt3HM * (0.07 / 100) + $dtQuaHM * (0.15 / 100));
            $thuenam1721 = floatval($hoso->gia_17) * floatval($hoso->he_so_17) * ($dtHM * (0.03 / 100) + $dt3HM * (0.07 / 100) + $dtQuaHM * (0.15 / 100));
            $thuenam1217 = floatval($hoso->gia_12) * floatval($hoso->he_so_12) * ($dtHM * (0.03 / 100) + $dt3HM * (0.07 / 100) + $dtQuaHM * (0.15 / 100));

            $start_date = $tuKyDate->startOfMonth();
            $end_date = Carbon::createFromFormat('d/m/Y', $hoso->den_ky)->endOfMonth();

            $giai_doan_1_start = Carbon::createFromFormat('d/m/Y', '01/01/2012');
            $giai_doan_1_end = Carbon::createFromFormat('d/m/Y', '31/12/2016');

            $giai_doan_2_start = Carbon::createFromFormat('d/m/Y', '01/01/2017');
            $giai_doan_2_end = Carbon::createFromFormat('d/m/Y', '31/12/2021');

            $giai_doan_3_start = Carbon::createFromFormat('d/m/Y', '01/01/2022');

            $so_thang_giai_doan_1 = 0;
            $so_thang_giai_doan_2 = 0;
            $so_thang_giai_doan_3 = 0;

            if ($start_date->format('Y') < 2012) {
                if ($end_date->format('Y') < 2017) {
                    $so_thang_giai_doan_1 = $giai_doan_1_start->diffInMonths($end_date, false) + 1;
                    $so_thang_giai_doan_2 = 0;
                    $so_thang_giai_doan_3 = 0;
                } else if ($end_date->format('Y') < 2022) {
                    $so_thang_giai_doan_1 = $giai_doan_1_start->diffInMonths($giai_doan_1_end, false) + 1;
                    $so_thang_giai_doan_2 = $giai_doan_2_start->diffInMonths($end_date, false) + 1;
                    $so_thang_giai_doan_3 = 0;
                } else {
                    $so_thang_giai_doan_1 = $giai_doan_1_start->diffInMonths($giai_doan_1_end, false) + 1;
                    $so_thang_giai_doan_2 = $giai_doan_2_start->diffInMonths($giai_doan_2_end, false) + 1;
                    $so_thang_giai_doan_3 = $giai_doan_3_start->diffInMonths($end_date, false) + 1;
                }
            } else if ($start_date->format('Y') < 2017) {
                if ($end_date->format('Y') < 2017) {
                    $so_thang_giai_doan_1 = $start_date->diffInMonths($end_date, false) + 1;
                    $so_thang_giai_doan_2 = 0;
                    $so_thang_giai_doan_3 = 0;
                } else if ($end_date->format('Y') < 2022) {
                    $so_thang_giai_doan_1 = $start_date->diffInMonths($giai_doan_1_end, false) + 1;
                    $so_thang_giai_doan_2 = $giai_doan_2_start->diffInMonths($end_date, false) + 1;
                    $so_thang_giai_doan_3 = 0;
                } else {
                    $so_thang_giai_doan_1 = $start_date->diffInMonths($giai_doan_1_end, false);
                    $so_thang_giai_doan_2 = $giai_doan_2_start->diffInMonths($giai_doan_2_end, false) + 1;
                    $so_thang_giai_doan_3 = $giai_doan_3_start->diffInMonths($end_date, false) + 1;
                }
            } else if ($start_date->format('Y') < 2022) {
                if ($end_date->format('Y') < 2022) {
                    $so_thang_giai_doan_1 = 0;
                    $so_thang_giai_doan_2 = $start_date->diffInMonths($end_date, false) + 1;
                    $so_thang_giai_doan_3 = 0;
                } else {
                    $so_thang_giai_doan_1 = 0;
                    $so_thang_giai_doan_2 = $start_date->diffInMonths($giai_doan_2_end, false) + 1;
                    $so_thang_giai_doan_3 = $giai_doan_3_start->diffInMonths($end_date, false) + 1;
                }
            } else {
                $so_thang_giai_doan_1 = 0;
                $so_thang_giai_doan_2 = 0;
                $so_thang_giai_doan_3 = $start_date->diffInMonths($end_date, false) + 1;
            }

            $thueGD2226 = $thuenam2226 * $so_thang_giai_doan_3 / 12;
            $thueGD1721 = $thuenam1721 * $so_thang_giai_doan_2 / 12;
            $thueGD1217 = $thuenam1217 * $so_thang_giai_doan_1 / 12;

            // Ghi dữ liệu từ đối tượng vào các cột tương ứng
            $sheet1->setCellValue('B' . $row, $hoso->mst);
            $sheet1->setCellValue('C' . $row, $hoso->ten);
            $sheet1->setCellValue('D' . $row, $hoso->to);
            $sheet1->setCellValue('E' . $row, $hoso->so_gcn);
            $sheet1->setCellValue('F' . $row, $hoso->ngay_cap);
            $sheet1->setCellValue('G' . $row, $hoso->tds);
            $sheet1->setCellValue('H' . $row, $hoso->tbd);
            $sheet1->setCellValue('I' . $row, $hoso->dt);
            $sheet1->setCellValue('J' . $row, $hoso->duong_pho);
            $sheet1->setCellValue('K' . $row, $hoso->doan_duong);
            $sheet1->setCellValue('L' . $row, $hoso->dia_chi);
            $sheet1->setCellValue('M' . $row, $hoso->han_muc);
            $sheet1->setCellValue('N' . $row, $hoso->vi_tri);
            $sheet1->setCellValue('O' . $row, $hoso->he_so_22);
            $sheet1->setCellValue('P' . $row, $hoso->he_so_12);
            $sheet1->setCellValue('Q' . $row, $hoso->he_so_17);
            $sheet1->setCellValue('R' . $row, "01/$tuKyString");
            $sheet1->setCellValue('S' . $row, $hoso->den_ky);
            $sheet1->setCellValue('T' . $row, $hoso->gia_22);
            $sheet1->setCellValue('U' . $row, $gia1m22223);
            $sheet1->setCellValue('V' . $row, round($thuenam2226));
            $sheet1->setCellValue('W' . $row, round($thueGD2226));
            $sheet1->setCellValue('X' . $row, $hoso->gia_17);
            $sheet1->setCellValue('Y' . $row, round($thuenam1721));
            $sheet1->setCellValue('Z' . $row, round($thueGD1721));
            $sheet1->setCellValue('AA' . $row, $hoso->gia_12);
            // $sheet->setCellValue('AB' . $row, $thuenam1217);
            // $sheet->setCellValue('AC' . $row, $thueGD1217);
            // Thêm các cột khác nếu cần thiết
            $sheet1->setCellValue('AK' . $row, $dtHM);
            $sheet1->setCellValue('AL' . $row, $dt3HM);
            $sheet1->setCellValue('AM' . $row, $dtQuaHM);

            // Tăng chỉ số dòng
            $row++;

            if ($tuKyDate->year < 2022) {
                for ($i = $tuKyDate->year; $i < 2022; $i++) {
                    if ($i < 2012) {
                        continue;
                    } else if ($i < 2017) {
                        $thue = 0;
                        if ($i === $tuKyDate->year) {
                            $thue = $thueGD1217 - $thuenam1217 * (2017 - $i - 1);
                        } else {
                            $thue = $thuenam1217;
                        }
                        $sheet2->setCellValue('F' . $rowDP, round($thue));
                    } else {
                        $thue = 0;
                        if ($i == $tuKyDate->year) {
                            $thue = $thueGD1721 - $thuenam1721 * (2022 - $i - 1);
                        } else {
                            $thue = $thuenam1721;
                        }
                        $sheet2->setCellValue('F' . $rowDP, round($thue));
                    }
                    $sheet2->setCellValue('C' . $rowDP, $hoso->mst);
                    $sheet2->setCellValue('I' . $rowDP, $hoso->ma_pnn);
                    $sheet2->setCellValue('H' . $rowDP, '01.11.' . $i);
                    $sheet2->setCellValue('J' . $rowDP, 'Phát sinh NVT từ ' . $tuKyString . ' (TĐS ' . $hoso->tds . '-' . $hoso->tbd . ')');
                    $rowDP++;
                }
            } else {
                $sheet2->setCellValue('C' . $rowDP, $hoso->mst);
                $sheet2->setCellValue('I' . $rowDP, $hoso->ma_pnn);
                $sheet2->setCellValue('H' . $rowDP, '01.11.' . $tuKyDate->year);
                $sheet2->setCellValue('J' . $rowDP, 'Phát sinh NVT từ ' . $tuKyString . ' (TĐS ' . $hoso->tds . '-' . $hoso->tbd . ')');
                $thue = $thueGD2226 - $thuenam2226 * (2024 - $tuKyDate->year + 1);
                $sheet2->setCellValue('F' . $rowDP, round($thue));
                $rowDP++;
            }
        }

        // Tạo một đối tượng Writer để ghi tệp Excel
        $writer = new Xlsx($spreadsheet);

        // Đặt header cho tệp Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="data.xlsx"');
        header('Cache-Control: max-age=0');

        // Ghi dữ liệu vào tệp Excel
        $writer->save('php://output');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        $path = $request->file('file')->getRealPath();

        $spreadsheet = IOFactory::load($path);
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();

        for ($row = 2; $row <= $highestRow; ++$row) {
            if ($worksheet->getCell('A' . $row)->getValue() == '') {
                continue;
            }
            $tu_ky_excel_value = $worksheet->getCell('P' . $row)->getValue();
            $tu_ky_timestamp = SharedDate::excelToTimestamp($tu_ky_excel_value);
            $tu_ky = date('m/Y', $tu_ky_timestamp);

            $duongStr = $worksheet->getCell('I' . $row)->getValue();
            $doanStr = $worksheet->getCell('J' . $row)->getValue();
            $viTriStr = $worksheet->getCell('L' . $row)->getValue();

            $duong = DuongPho::where('duong_pho', $duongStr)->first();
            $doan = Doan::where('doan_duong', $doanStr)->first();
            $viTri = ViTri::where('vi_tri', $viTriStr)->first();

            if (!$duong || !$doan || !$viTri) {
                continue;
            }

            $results = GiaDat::where('duong_id', $duong->id)
                ->where('doan_id', $doan->id)
                ->where('vi_tri_id', $viTri->id)
                ->get();

            $resultsArray = $results->toArray();

            $ngay_cap_excel_value = $worksheet->getCell('E' . $row)->getValue();
            $ngay_cap_timestamp = SharedDate::excelToTimestamp($ngay_cap_excel_value);
            $ngay_cap = date('d/m/Y', $ngay_cap_timestamp);

            // Convert $ngay_cap to dd/mm/YYYY format
            list($day, $month, $year) = explode('/', $ngay_cap);
            $ngay_cap_formatted = sprintf('%02d/%02d/%04d', $day, $month, $year);

            $gia17 = null;

            if (isset($resultsArray[0]) && isset($resultsArray[1]) && isset($resultsArray[2])) {
                $gia17 = ($year > 2019 || ($year == 2019 && ($month > 2 || ($month == 2 && $day > 10)))) ? $resultsArray[0]['gia_dat'] : $resultsArray[1]['gia_dat'];
                $gia22 = $resultsArray[0]['gia_dat'];
                $gia12 = $resultsArray[2]['gia_dat'];
            } else {
                $gia17 = 0;
                $gia22 = 0;
                $gia12 = 0;
            }

            $dia_chi = 'TĐS ' . $worksheet->getCell('F' . $row)->getValue() . '-' . $worksheet->getCell('G' . $row)->getValue() . ', ' . $worksheet->getCell('I' . $row)->getValue();

            $rowData = [
                'mst' => $worksheet->getCell('A' . $row)->getValue(),
                'ten' => $worksheet->getCell('B' . $row)->getValue(),
                'to' => $worksheet->getCell('C' . $row)->getValue(),
                'ma_pnn' => $worksheet->getCell('Q' . $row)->getValue(),
                'so_gcn' => $worksheet->getCell('D' . $row)->getValue(),
                'ngay_cap' => $ngay_cap_formatted,
                'tds' => $worksheet->getCell('F' . $row)->getValue(),
                'tbd' => $worksheet->getCell('G' . $row)->getValue(),
                'dt' => $worksheet->getCell('H' . $row)->getValue(),
                'duong_pho' => $duongStr,
                'doan_duong' => $doanStr,
                'dia_chi' => $dia_chi,
                'han_muc' => $worksheet->getCell('K' . $row)->getValue(),
                'vi_tri' => $viTriStr,
                'he_so_22' => $worksheet->getCell('M' . $row)->getValue(),
                'he_so_12' => $worksheet->getCell('N' . $row)->getValue(),
                'he_so_17' => $worksheet->getCell('O' . $row)->getValue(),
                'tu_ky' => $tu_ky,
                'den_ky' => '31/12/2024',
                'gia_22' => $gia22,
                'gia_17' => $gia17,
                'gia_12' => $gia12,
            ];

            HoSo::create($rowData);
        }

        return redirect()->route('kekhai.index')->with('success', 'File uploaded successfully and data imported into database.');
    }

}