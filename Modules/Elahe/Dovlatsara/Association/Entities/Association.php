<?php

namespace Modules\Association\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ad\Entities\Ad;
use Modules\AdminMaster\Http\Middleware\AdminAuth;
use Modules\AssociationSkill\Entities\AssociationSkill;
use Modules\User\Entities\User;

class Association extends Model
{
    use SoftDeletes;

    protected $fillable = ['id', 'title', 'depth','path', 'node', 'active', 'image',
        'parent_id', 'created_at', 'updated_at', 'deleted_at', 'created_user','updated_user', 'deleted_user'];

    public function subAssociations()
    {
        return $this->hasMany(Association::class,'parent_id');
    }

    public function associations()
    {
        return $this->hasMany(Association::class,'parent_id');
    }

    public function association()
    {
        return $this->belongsTo(Association::class,'parent_id')->withTrashed();
    }

//    public function groupAttributes()
//    {
//        return $this->hasMany(GroupAttribute::class, 'category_id');
//
//    }
//
//    public function adFees()
//    {
//        return $this->hasMany(AdvertisingFee::class, 'category_id');
//
//    }

    public function createStringAsParents2($path)
    {
        $parentStr='';
        if($path)
        {
            $parents=explode(',',$path);
//            $parents=array_reverse($parents);
            foreach($parents as $key=>$parent)
            {
                $association=Association::find($parent);
//                if($key!=0)
                $parentStr.=$association->title ." / ";
//                $parentStr.='<-';
            }
        }
        $parentStr.=$this->title;

        return $parentStr;
    }
    public function getGrandParent()
    {
        if ($this->path == null){
            return $this->id;
        }else{
            return explode(',', $this->path)[0];
        }
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'association_user', 'association_id',
            'user_id');
    }

    public function associationSkills()
    {
        return $this->hasMany(AssociationSkill::class, 'association_id');
    }
}
