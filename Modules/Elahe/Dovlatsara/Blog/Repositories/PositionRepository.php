<?php

namespace Modules\Blog\Repositories;


use Modules\Blog\Entities\Position;

class PositionRepository
{
    public function create($request_array)
    {
        foreach ($request_array as $request)
            Position::create($request);
        return true;

    }


    public function delete_all()
    {
        $Positions = Position::all();
        foreach ($Positions as $Position)
            $Position->delete();
        return true;

    }

    public function all()
    {
        return Position::all();

    }

    public function find($position_id)
    {
        return Position::find($position_id);

    }

    public function destroy($position)
    {
        return $position->delete();
    }

    public function update($position, $array)
    {
        return $position->update($array);
    }

    public function get_articles($position)
    {
        return $position->articles()->where('status', 'active')->orderby('order', 'asc')->get();
    }

    public function attach_article_array($position, $articles)
    {
        $last_article = $this->get_articles($position)->last();
        $order = $last_article ? $last_article->pivot->order : 0;
        foreach ($articles as $article)
            if (!$position->articles()->where('articles.id', $article)->first())
                $position->articles()->attach($article, ['order' => ++$order]);
    }

    public function detach_article($position, $article_id)
    {
        return $position->articles()->detach($article_id);

    }

    public function updatePivot($position, $article,  $array)
    {
        return $position->articles()->updateExistingPivot($article, $array);

    }



    public function find_by_slug($position_slug)
    {
        return Position::where('slug',$position_slug)->first();

    }
}
