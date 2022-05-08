<?php

namespace Modules\ContractorProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\ContractorProjectImage\Entities\ContractorProjectImage;
use Modules\User\Entities\User;

class ContractorProject extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'title', 'description', 'active', 'created_user', 'updated_user', 'deleted_user'];

    public function contractorProjectImages()
    {
        return $this->hasMany(ContractorProjectImage::class, 'contractor_project_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }
}
