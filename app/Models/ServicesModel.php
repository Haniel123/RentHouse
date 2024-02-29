<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ServicesModel extends Model
{
    use HasFactory;
    protected $table = 'table_dichvu';
    /**
     * The room that belong to the ServicesModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function room(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'table_phong_dichvu', 'id_dichvu', 'id_phong')->withTimestamps();
    }
}
