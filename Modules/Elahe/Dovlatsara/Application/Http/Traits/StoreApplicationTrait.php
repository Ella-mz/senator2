<?php namespace Modules\Application\Http\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\Ad\Entities\Ad;
use Modules\Application\Entities\Application;
use Modules\Attribute\Entities\Attribute;
use Modules\Setting\Entities\Setting;

trait StoreApplicationTrait
{

    public function attrss($request, $application)
    {
        foreach ($request as $key => $attribute) {
            if (Attribute::where('id', $key)->first()->attribute_type == 'select') {
                if (Attribute::where('id', $key)->first()->hasScale) {
                    if ($attribute['min'] != null && $attribute['max'] != null)
                        $application->attributes()->attach($key, [
                            'attribute_item_id1' => $attribute['min'],
                            'attribute_item_id2' => $attribute['max'],
                            'created_user' => \auth()->id(),
                        ]);
                } else {
                    if ($attribute != null)
                        $application->attributes()->attach($key, [
                            'attribute_item_id1' => $attribute,
                            'created_user' => \auth()->id(),
                        ]);
                }
            } elseif (Attribute::where('id', $key)->first()->attribute_type == 'int') {
                if (Attribute::where('id', $key)->first()->hasScale) {
                    if ($attribute['min'] != null && $attribute['max'] != null)
                        $application->attributes()->attach($key, [
                            'value1' => $this->convertToEnglish(str_replace(',', '', $attribute['min'])),
                            'value2' => $this->convertToEnglish(str_replace(',', '', $attribute['max'])),
                            'created_user' => \auth()->id(),
                        ]);
                } else {
                    if ($attribute != null)
                        $application->attributes()->attach($key, [
                            'value1' => $this->convertToEnglish(str_replace(',', '', $attribute)),
                            'created_user' => \auth()->id(),
                        ]);
                }
            } elseif (Attribute::where('id', $key)->first()->attribute_type == 'bool') {
                if ($attribute == 'on') {
                    if ($attribute != null)
                        $application->attributes()->attach($key, [
                            'value1' => 1,
                            'created_user' => \auth()->id(),
                        ]);
                }
            } else {
                if ($attribute != null)
                    $application->attributes()->attach($key, [
                        'value1' => $attribute,
                        'created_user' => \auth()->id(),
                    ]);
            }
        }
    }

    public function storeApplicationWithAttrs($request, $category)
    {
        $application = Application::create([
            'user_id' => \auth()->id(),
            'category_id' => $category->id,
            'city_id' => $request->city,
            'title' => $request->title,
            'description' => $request->description,
            'startDate' => Carbon::now(),
            'endDate' => Carbon::now()->add(Setting::where('title', 'duration_of_applications')->first()->str_value, 'day'),
            'phone' => isset($request->phone) ? $request->phone : \auth()->user()->mobile,
            'mobile' => isset($request->mobile) ? $request->mobile : \auth()->user()->mobile,
            'active' => 'inactive',
            'created_user' => \auth()->id(),
            'agency_id' => $request->agency_id ?? null,
            'dedicated_type' => isset($request->agency_id) ? 'user_to_agency' : null,
            'request_to_agency' => isset($request->agency_id) ? 'pending' : 'noRequest'
        ]);
        if (isset($request->attribute))
            $this->attrss($request->attribute, $application);
        return $application;
    }

    public function attributesApi($request, $application, $user)
    {
        foreach (json_decode($request, true) as $key => $attribute) {
            if (Attribute::where('id', $attribute['id'])->first()->attribute_type == 'select') {
                if (Attribute::where('id', $attribute['id'])->first()->hasScale) {
                    if ($attribute['min'] != null && $attribute['max'] != null)
                        $application->attributes()->attach($attribute['id'], [
                            'attribute_item_id1' => $attribute['min'],
                            'attribute_item_id2' => $attribute['max'],
                            'created_user' => $user->id,
                        ]);
                } else {
                    if ($attribute['min'] != null)
                        $application->attributes()->attach($attribute['id'], [
                            'attribute_item_id1' => $attribute['min'],
                            'created_user' => $user->id,
                        ]);
                }
            } elseif (Attribute::where('id', $attribute['id'])->first()->attribute_type == 'int') {
                if (Attribute::where('id', $attribute['id'])->first()->hasScale) {
                    if ($attribute['min'] != null && $attribute['max'] != null)
                        $application->attributes()->attach($attribute['id'], [
                            'value1' => $attribute['min'],
                            'value2' => $attribute['max'],
                            'created_user' => $user->id,
                        ]);
                }else {
                    if ($attribute['min'] != null)
                        $application->attributes()->attach($attribute['id'], [
                            'value1' => str_replace(',', '', $attribute['min']),
                            'created_user' => $user->id,
                        ]);
                }
            } elseif (Attribute::where('id', $attribute['id'])->first()->attribute_type == 'bool') {
//                if ($attribute['min'] == 'on') {
                    if ($attribute['min'] == 1)
                        $application->attributes()->attach($attribute['id'], [
                            'value1' => 1,
                            'created_user' => $user->id,
                        ]);
//                }
            } else {
                if ($attribute['value'] != null)
                    $application->attributes()->attach($attribute['id'], [
                        'value1' => $attribute['min'],
                        'created_user' => $user->id,
                    ]);
            }
        }
    }

    public function storeApplicationWithAttrsApi($request, $user)
    {
        $application = Application::create([
            'user_id' => $user->id,
            'category_id' => $request->categoryId,
            'city_id' => $request->city,
            'title' => $request->title,
            'description' => isset($request->description) ? $request->description : null,
            'type' => $request->adType,
            'startDate' => Carbon::now(),
            'endDate' => Carbon::now()->add(Setting::where('title', 'duration_of_applications')->first()->str_value, 'day'),
            'phone' => isset($request->phone) ? $request->phone : $user->mobile,
            'active' => 'inactive',
            'created_user' => $user->id,
            'agency_id' => $request->agency_id ?? null,
            'dedicated_type' => isset($request->agency_id) ? 'user_to_agency' : null,
            'request_to_agency' => isset($request->agency_id) ? 'pending' : 'noRequest'
        ]);
        if (isset($request->attribute))
            $this->attributesApi($request->attribute, $application, $user);
        return $application;
    }

}
