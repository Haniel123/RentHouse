<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DieuKhoanModel extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'table_dieukhoan';

}
