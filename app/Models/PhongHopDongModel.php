<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PhongHopDongModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasFactory;
    protected $table = 'table_phong_hopdong';
}
