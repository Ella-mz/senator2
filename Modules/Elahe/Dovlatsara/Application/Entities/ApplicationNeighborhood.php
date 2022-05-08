<?php

namespace Modules\Application\Entities;

use Illuminate\Database\Eloquent\Model;

class ApplicationNeighborhood extends Model
{

    protected $fillable = ['application_id', 'neighborhood_id', 'created_user', 'updated_user', 'deleted_user'];

}
