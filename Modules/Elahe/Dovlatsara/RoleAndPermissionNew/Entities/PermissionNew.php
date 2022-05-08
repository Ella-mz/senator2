<?php

namespace Modules\RoleAndPermissionNew\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionNew extends Model
{
    use SoftDeletes;

    /**define Order fallible fields.
     *
     * @var string[]
     */

    protected $fillable = ['id', 'name', 'slug', 'show', 'active', 'deleted_at', 'created_at', 'updated_at'];

    public function roles() {

        return $this->belongsToMany(RoleNew::class,'permission_role', 'permission_id', 'role_id');

    }
    /**
     * define permissions table.
     *
     * @var string
     */
    protected $table = 'permissions';

}
