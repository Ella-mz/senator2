<?php

namespace Modules\Hologram\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ad\Entities\Ad;
use Modules\HologramInterface\Entities\HologramInterface;
use Modules\User\Entities\User;

class Hologram extends Model
{

    use SoftDeletes;

    protected $fillable = ['title', 'logo', 'price', 'type', 'description', 'created_user', 'updated_user', 'deleted_user'];

    public function ads()
    {
        return $this->belongsToMany(Ad::class, 'hologram_interfaces', 'hologram_id', 'type_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'hologram_interfaces', 'hologram_id', 'type_id');
    }

    public function hologramInterfaces()
    {
        return $this->hasMany(HologramInterface::class, 'hologram_id');
    }
}
