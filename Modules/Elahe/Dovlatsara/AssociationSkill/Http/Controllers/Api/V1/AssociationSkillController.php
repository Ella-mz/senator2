<?php

namespace Modules\AssociationSkill\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\AssociationSkill\Entities\AssociationSkill;
use Modules\AssociationSkill\Repositories\AssociationSkillRepository;
use Modules\AssociationSkill\Transformers\AssociationSkillCollection;
use RealRashid\SweetAlert\Facades\Alert;
use Modules\AdminMasterNew\Http\Traits;
use Illuminate\Http\Response;

class AssociationSkillController extends Controller
{
    use Traits\UploadFileTrait;

    public $repo;

    public function __construct(AssociationSkillRepository $associationSkillRepository)
    {
        $this->repo = $associationSkillRepository;
    }

    public function index(Request $request)
    {
        $associationSkills = $this->repo->getAssociationSkillsByAssociationIds(json_decode($request->association, true));

        return response()->json([
            'status_code' => 200,
            'data' =>  new AssociationSkillCollection($associationSkills),
        ], Response::HTTP_OK);
    }


}
