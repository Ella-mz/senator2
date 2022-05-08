<?php

namespace Modules\Category\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ad\Entities\Ad;
use Modules\AdFee\Entities\AdFee;
use Modules\Application\Entities\Application;
use Modules\GroupAttribute\Entities\GroupAttribute;
use Modules\User\Entities\Level2CategoryOfAgency;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['id', 'title', 'depth', 'path', 'node', 'active', 'image', 'order', 'selected',
        'parent_id', 'created_at', 'updated_at', 'deleted_at', 'created_user', 'updated_user', 'deleted_user'];

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function ads()
    {
        return $this->hasMany(Ad::class, 'category_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'category_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'parent_id')->withTrashed();
    }

    public function groupAttributes()
    {
        return $this->hasMany(GroupAttribute::class, 'category_id');

    }

    public function adFees()
    {
        return $this->hasMany(AdFee::class, 'category_id');

    }

    public function createStringAsParents(): string
    {
        $parentStr = '';
        if ($this->path) {
            $parents = explode(',', $this->path);
            foreach ($parents as $key => $parent) {
                $category = Category::find($parent);
                $parentStr .= $category->title . " / ";
            }
        }
        $parentStr .= $this->title;

        return $parentStr;
    }

    public function createStringAsParents3(): string
    {
        $parentStr = '';
        if ($this->path) {
            $parents = explode(',', $this->path);
//            $parents=array_reverse($parents);
            foreach ($parents as $key => $parent) {
                $category = Category::find($parent);
//                if($key!=0)
                $parentStr .= $category->title . " > ";
//                $parentStr.='<-';
            }
        }
        $parentStr .= $this->title;

        return $parentStr;
    }

    public function createStringAsParents2($path)
    {
        $parentStr = '';
        if ($path) {
            $parents = explode(',', $path);
//            $parents=array_reverse($parents);
            foreach ($parents as $key => $parent) {
                $category = Category::find($parent);
//                if($key!=0)
                $parentStr .= $category->title . " > ";
//                $parentStr.='<-';
            }
        }
        $parentStr .= $this->title;

        return $parentStr;
    }

    public function getGrandParent()
    {
        if ($this->path == null) {
            return $this->id;
        } else {
            return explode(',', $this->path)[0];
        }
    }

    public function allAdsOfParentCategory($agency_id)
    {
        $nodes = $this->allNodesIds();
        return Ad::with('attributes')
            ->where(function ($query) use ($nodes, $agency_id) {
                $query->whereIn('category_id', $nodes)
                    ->where('agency_id', $agency_id)
                    ->where('isPaid', 'paid')
                    ->where('active', 'active')
                    ->where('userStatus', '!=', 'inactive')
                    ->where('endDate', '>', Carbon::now())
                    ->where('advertiser', 'supplier')
                    ->where('request_to_agency', 'approved');
            })->orWhere(function ($query) use ($nodes, $agency_id) {
                $query->whereIn('category_id', $nodes)
                    ->where('agency_id', $agency_id)
                    ->where('isPaid', 'paid')
                    ->where('active', 'active')
                    ->where('userStatus', '!=', 'inactive')
                    ->where('endDate', '>', Carbon::now())
                    ->where('advertiser', 'supplier')
                    ->where('request_to_agency', 'noRequest');
            })->get();
    }

    public function allNodesIds(): array
    {
        $categoryIds = [];
        array_push($categoryIds, $this->id);
        if ($this->categories()->count() > 0) {
            foreach ($this->categories as $category) {
                array_push($categoryIds, $category->id);
                if ($category->categories()->count() > 0) {
                    foreach ($category->categories as $sub_category) {
                        array_push($categoryIds, $sub_category->id);
                    }
                }
            }
        }
        return $categoryIds;
    }

    public function level2CategoryOfAgencies()
    {
        return $this->hasMany(Level2CategoryOfAgency::class, 'category_id');
    }
}
