<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doan extends Model
{
    use HasFactory;
    public $fillable = [
        "doan_duong"
    ];
}