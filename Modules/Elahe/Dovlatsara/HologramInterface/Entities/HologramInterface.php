<?php

namespace Modules\HologramInterface\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Ad\Entities\Ad;
use Modules\Hologram\Entities\Hologram;
use Modules\User\Entities\User;

class HologramInterface extends Model
{
    /**
     * type => 'ad' OR 'user'
     *status => pending OR approved notApproved
     *isPaid => 0 OR 1
     */
    protected $fillable = ['hologram_id', 'type', 'type_id', 'status', 'description', 'hologram_price', 'expert_id', 'expert_description',
        'expert_answer_time', 'isPaid', 'created_user', 'updated_user', 'deleted_user'];




    public function hologramInterfaceFiles()
    {
        return $this->hasMany(HologramInterfaceFile::class, 'hologram_interface_id');
    }

    public function hologram()
    {
        return $this->belongsTo(Hologram::class, 'hologram_id');
    }

    public function ad()
    {
        return $this->belongsTo(Ad::class, 'type_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'type_id');
    }
}
