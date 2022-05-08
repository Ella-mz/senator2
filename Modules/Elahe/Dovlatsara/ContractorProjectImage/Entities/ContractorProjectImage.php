<?php

namespace Modules\ContractorProjectImage\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\ContractorProject\Entities\ContractorProject;

class ContractorProjectImage extends Model
{

    protected $fillable = ['contractor_project_id', 'image', 'created_user', 'updated_user', 'deleted_user'];

    public function contractorProject()
    {
        return $this->belongsTo(ContractorProject::class, 'contractor_project_id')->withTrashed();
    }

}
