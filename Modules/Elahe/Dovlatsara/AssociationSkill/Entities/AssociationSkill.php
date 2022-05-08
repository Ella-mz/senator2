<?php

namespace Modules\AssociationSkill\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Association\Entities\Association;
use Modules\User\Entities\User;

class AssociationSkill extends Model
{
    use SoftDeletes;

    protected $fillable = ['association_id', 'image', 'title', 'created_user', 'updated_user', 'deleted_user'];

    public function association()
    {
        return $this->belongsTo(Association::class, 'association_id')->withTrashed();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'association_skill_user', 'association_skill_id',
            'user_id');
    }
}
