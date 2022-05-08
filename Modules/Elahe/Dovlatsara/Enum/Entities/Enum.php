<?php

namespace Modules\Enum\Entities;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enum extends Model
{
//    use HasFactory;

    protected $fillable = ['title', 'created_user', 'updated_user', 'deleted_user'];

//    protected static function newFactory()
//    {
//        return \Modules\Enum\Database\factories\EnumFactory::new();
//    }
}
