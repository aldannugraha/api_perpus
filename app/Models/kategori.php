<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $table = "kategoris";

    // public $timestamps = false;
    protected $fillable = [
        'nama',
    ];
}
