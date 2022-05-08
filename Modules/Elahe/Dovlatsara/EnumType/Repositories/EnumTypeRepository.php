<?php


namespace Modules\EnumType\Repositories;


use Modules\Enum\Entities\Enum;
use Modules\EnumType\Entities\EnumType;

class EnumTypeRepository
{
    public function findEnumTypeByEnumTitle($title)
    {
        $Enum = Enum::where('title', $title)->first();
        return EnumType::where('enum_id', $Enum->id)->first();
    }

    public function findEnumTypeById($id)
    {
        return EnumType::where('id', $id)->first();
    }

    public function findEnumTypesByEnumTitle($title)
    {
        $Enum = Enum::where('title', $title)->first();
        return EnumType::where('enum_id', $Enum->id)->get();
    }

    public function findEnumTypeByTitle($title)
    {
        return EnumType::where('title', $title)->first();
    }
}
