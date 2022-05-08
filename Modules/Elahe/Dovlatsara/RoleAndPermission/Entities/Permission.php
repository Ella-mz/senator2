<?php

namespace Modules\RoleAndPermission\Entities;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
//    use HasFactory;
    use SoftDeletes;
    /**
     * define permissions table.
     *
     * @var string
     */
    protected $table = 'permissions';

    /**define Order fallible fields.
     *
     * @var string[]
     */

    protected $fillable = ['id', 'name', 'slug', 'show', 'active', 'deleted_at', 'created_at', 'updated_at'];

    public function roles() {

        return $this->belongsToMany(Role::class,'permission_role');

    }
//    protected static function newFactory()
//    {
//        return \Modules\RoleAndPermission\Database\factories\PermissionFactory::new();
//    }


}
