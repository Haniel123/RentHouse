<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ContractsModel extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'table_hopdong';
    /**
     * The rooms that belong to the ContractsModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(RoomsModel::class, 'table_phong_hopdong', 'id_hopdong', 'id_phong')->withTimestamps();
    }
    public function terms(): BelongsToMany
    {
        return $this->belongsToMany(TermsModel::class, 'table_hopdong_dieukhoan', 'id_hopdong', 'id_dieukhoan')->withTimestamps();
    }
}
