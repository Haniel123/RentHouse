<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PhongDichVuModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasFactory;
    protected $table = 'table_phong_dichvu';
}
