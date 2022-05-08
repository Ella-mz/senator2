<?php namespace Modules\General\Http\Traits;


trait AttributeFilterTrait
{
    public function attributeFilter($attributeGroups)
    {
        $content = '';
        foreach ($attributeGroups as $attributeGroup) {
            foreach($attributeGroup->attributes->where('isFilterField', 1) as $attr){
                if($attr->attribute_type == 'int'){
                    $content.='<div class="box-sidebar"><span class="box-header-sidebar "> <i class="fa fa-chevron-down arrow"></i>حدود ';
                    $content.=$attr->title.'</span><div class="catalog" style="display: none;"> <div class="price minimum"><p>حداقل ';
                    $content.=$attr->title.':</p><input type="text" name="attributeTypeNumber['.$attr->id.'][min]" class="minimum-price attributeTypeNumber" onkeyup="separateNum(this.value,this);">';
                    $content.='</div><div class="price maximum"><p>حداکثر '.$attr->title;
                    $content.=':</p><input type="text" name="attributeTypeNumber['.$attr->id.'][max]" class="maximum-price attributeTypeNumber" onkeyup="separateNum(this.value,this);">';
                    $content.='</div></div></div>';
                }elseif($attr->attribute_type == 'bool'){
                    $content.='<div class="box-sidebar"><div class="filter-switch"><div class="switch-box"><div class="centered hidden-xs"><div class=""><label for="switch2'.$attr->id.'"> ';
                    $content.='<input type="checkbox" class="attributeTypeBool" value="1" id="switch2'.$attr->id.'" name="attributeTypeBool['.$attr->id.'][]">';
                    $content.='<span class="switch"><h1 class="switch-title">'.$attr->title.'</h1></span>';
                    $content.='<span class="toggle"></span></label></div><br></div></div></div></div>';
                }elseif($attr->attribute_type == 'select'){
                    $content.='<div class="box-sidebar"><span class="box-header-sidebar activeacc"><i class="fa fa-chevron-down arrow"></i>'.$attr->title.'</span>';
                    $content.='<div class="catalog" style="display: none;"><div class="select-box">';
                    $content.='<select class="js-example-basic-multiple attributeTypeSelect" style="width: 100%;" name="attributeTypeSelect['.$attr->id.'][]" multiple="multiple">';
                    foreach($attr->attributeItems as $item){
                        $content.='<option value="'.$item->id.'">'.$item->title.'</option>';

                    }
                    $content.='</select></div></div></div>';
                }
            }

        }
        return $content;
    }
}
