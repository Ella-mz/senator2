<?php

namespace Modules\RoleAndPermissionNew\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleNew extends Model
{
    use SoftDeletes, Sluggable;

    /**
     * define permissions table.
     *
     * @var string
     */
    protected $table = 'roles';

    /**define Order fallible fields.
     *
     * @var string[]
     */

    protected $fillable = ['id', 'name', 'enName', 'slug', 'show', 'editPermission', 'active','deleted_at', 'created_at', 'updated_at'];

    /**
     * define Roles casts.
     *
     * @var string[]
     */
    protected $casts = [
        'name'=>'string',
        'slug'=>'string',
//        'deleted_at'=>'timestamp',
//        'created_at'=>'timestamp',
//        'updated_at'=>'timestamp',
    ] ;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'enName'
            ]
        ];
    }

    public function permissions() {

        return $this->belongsToMany(PermissionNew::class,'permission_role', 'role_id', 'permission_id');
    }
}
