<?php

namespace Modules\HologramInterface\Entities;

use Illuminate\Database\Eloquent\Model;

class HologramInterfaceFile extends Model
{

    protected $fillable = ['hologram_interface_id', 'file_address', 'file_name', 'created_user',
        'updated_user', 'deleted_user'];

    public function hologramInterface()
    {
        return $this->belongsTo(HologramInterface::class, 'hologram_interface_id');
    }
}
