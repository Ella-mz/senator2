<?php

namespace Modules\Association\Http\Controllers\Realestate;

use App\Http\Controllers\Controller;
use Modules\Association\Entities\Association;
use Modules\AssociationSkill\Entities\AssociationSkill;

class AssociationController extends Controller
{

    public function gettingAssociation()
    {
        $id = request('association');
        $ns=[];
        $associations = Association::whereIn('parent_id', $id)->get();
        if ($associations->count()>0) {
            foreach ($associations as $association) {
                $ns[$association->id] = $association->title;
            }
            return json_encode($ns);
        }else
            return json_encode($ns);
    }

    public function gettingSkills()
    {
        $id = request('association2');
//        return json_encode($id);

        $ns=[];
        $associationSkills = AssociationSkill::whereIn('association_id', $id)->get();
        if ($associationSkills->count()>0) {
            foreach ($associationSkills as $skill) {
                $ns[$skill->id] = $skill->title;
            }
            return json_encode($ns);
        }else
            return json_encode($ns);
    }
}
