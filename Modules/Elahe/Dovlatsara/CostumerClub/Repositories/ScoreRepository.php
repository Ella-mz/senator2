<?php


namespace Modules\CostumerClub\Repositories;


use Modules\CostumerClub\Entities\Score;

class ScoreRepository
{
    public function create($request_array)
    {
        foreach ($request_array as $request) {
            if (!$this->find_with_slug($request['slug']))
                Score::create($request);
        }
        foreach ($this->all() as $score) {
            if (!$this->find_score_in_all_scores($request_array, $score->slug))
                $this->delete($score);
        }
        return true;
    }

    public function find_score_in_all_scores($request_array, $slug): bool
    {
        foreach ($request_array as $score) {
            if ($score['slug'] == $slug)
                return true;
        }
        return false;
    }

    public function delete_all()
    {
        $scores = $this->all();
        foreach ($scores as $score)
            $score->delete();
        return true;
    }

    public function find_with_id($id)
    {
        return Score::find($id);
    }

    public function find_with_slug($slug)
    {
        return Score::where('slug', $slug)->first();
    }

    public function all()
    {
        return Score::orderbyDesc('created_at')->get();
    }

    public function update($score, $request)
    {
        return $score->update($request);
    }

    public function delete($score)
    {
        $score->delete();
        return true;
    }
}
