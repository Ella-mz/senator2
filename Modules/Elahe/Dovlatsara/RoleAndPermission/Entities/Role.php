<?php

namespace Modules\RoleAndPermission\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes, Sluggable;

    /**
     * define Attribute table.
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
//    protected static function newFactory()
//    {
//        return \Modules\RoleAndPermission\Database\factories\RoleFactory::new();
//    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'enName'
            ]
        ];
    }

    public function permissions() {

        return $this->belongsToMany(Permission::class,'permission_role');
    }
}
