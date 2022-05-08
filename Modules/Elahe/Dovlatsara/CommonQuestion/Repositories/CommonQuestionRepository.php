<?php


namespace Modules\CommonQuestion\Repositories;


use Modules\CommonQuestion\Entities\CommonQuestion;

class CommonQuestionRepository
{
    public function commonQuestions()
    {
        return CommonQuestion::all();
    }

    public function searchInQuestions($tag)
    {
        return CommonQuestion::where('title', 'LIKE', '%' . $tag . '%')->get();
    }
}
