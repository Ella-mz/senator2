<?php

namespace Modules\Advertising\Entities;

use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Category\Entities\Category;
use Modules\User\Entities\User;

class AdvertisingApplication extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'advertising_id', 'link', 'image', 'category', 'user', 'startDate', 'endDate', 'clickCount',
        'created_user', 'updated_user', 'deleted_user', 'image_title', 'active', 'isPaid', 'check_approve_by_admin',
        'responsive_image', 'responsive_image_title'];

//    public function user()
//    {
//        return $this->belongsTo(User::class, 'user_id')->withTrashed();
//    }

    public function userInfo()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function advertising()
    {
        return $this->belongsTo(Advertising::class, 'advertising_id')->withTrashed();
    }

    public function checkDate($i): bool
    {
        if (Verta::parse($this->endDate)->month == Verta::now()->addMonths($i)->month)
            return true;
        else
            return false;
    }

    public function checkCategory($category): bool
    {
        if ($category->parent_id == 0 && $category->id == $this->category) {
            return true;
        } elseif ($category->category && ($category->category->parent_id == 0 && ($category->category->id == $this->category
                    || $category->id == $this->category))) {
            return true;
        } elseif ($category->category && $category->category->category && ($category->category->parent_id != 0 && $category->category->category->parent_id == 0
                && $category->category->id == $this->category || $category->id == $this->category
                || ($category->category->parent_id != 0 && $category->category->category->parent_id == 0
                    && $category->category->category->id == $this->category)))
            return true;
        else
            return false;
    }
    public function category1()
    {
        return $this->belongsTo(Category::class, 'category')->withTrashed();
    }

    protected
        $table = 'advertising_user';

}
