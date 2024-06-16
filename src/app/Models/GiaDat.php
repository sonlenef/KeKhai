<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiaDat extends Model
{
    use HasFactory;
    public $fillable = [
        "duong_id",
        "doan_id",
        "vi_tri_id",
        "giai_doan_id",
        "gia_dat",
    ];
}