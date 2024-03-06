<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoSo extends Model
{
    use HasFactory;
    public $fillable = [
        'mst',
        'ten',
        'to',
        'so_gcn',
        'ngay_cap',
        'tds',
        'tbd',
        'dt',
        'duong_pho',
        'doan_duong',
        'dia_chi',
        'han_muc',
        'vi_tri',
        'he_so',
        'tu_ky',
        'den_ky',
        'gia_22',
        'gia_17',
        'gia_12'
    ];
}