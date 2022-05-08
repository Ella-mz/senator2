<?php


namespace Modules\AssociationSkill\Repositories;


use Modules\Association\Entities\Association;
use Modules\AssociationSkill\Entities\AssociationSkill;

class AssociationSkillRepository
{

    public function associationSkills()
    {
        return AssociationSkill::orderByDesc('created_at')->get();
    }
    public function findAssociationSkillById($id)
    {
        return AssociationSkill::find($id);
    }

    public function findAssociationById($id)
    {
        return Association::find($id);
    }

    public function getAssociationSkillsByAssociationId($id)
    {
        return AssociationSkill::where('association_id', $id)->orderByDesc('created_at')->get();
    }
    public function getAssociationSkillsByAssociationIds($ids)
    {
        return AssociationSkill::whereIn('association_id', $ids)->orderByDesc('created_at')->get();
    }
    public function create($request, $image)
    {
        return AssociationSkill::create(
            [
                'association_id' => $request->association_id,
                'title' => $request->title,
                'image' => $image,
                'created_user' => \auth()->id(),
            ]
        );
    }
    public function update($id, $request, $image)
    {
        return AssociationSkill::where('id', $id)->update(
            [
                'title' => $request->title,
                'image' => $image,
                'updated_user' => \auth()->id(),
            ]
        );
    }

    public function delete($id)
    {
        $associationSkill = $this->findAssociationSkillById($id);
        $associationSkill->users()->detach();
        $associationSkill->update(['deleted_user' => \auth()->id()]);
        $associationSkill->delete();
    }
}
