<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RoomsModel extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'table_phong';
    /**
     * The contracts that belong to the RoomsModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function contracts(): BelongsToMany
    {
        return $this->belongsToMany(ContractsModel::class, 'table_phong_hopdong', 'id_phong', 'id_hopdong')->withTimestamps();
    }
    /**
     * The services that belong to the RoomsModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(ServicesModel::class, 'table_phong_dichvu', 'id_phong', 'id_dichvu')->withTimestamps();
    }
}
