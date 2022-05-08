<?php

namespace Modules\Blog\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Article\Repositories\ArticleGroupRepository;
use Modules\Article\Repositories\ArticleRepository;
use Modules\Blog\Repositories\PositionRepository;
use Modules\Comment\Repositories\CommentRepository;

class BlogController extends Controller
{
    private $articleRepository;
    private $positionRepository;
    private $articleGroupRepository;
    private $commentRepository;

    public function __construct(ArticleRepository $articleRepository,ArticleGroupRepository  $articleGroupRepository,
                                PositionRepository $positionRepository, CommentRepository $commentRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->positionRepository = $positionRepository;
        $this->commentRepository=$commentRepository;
        $this->articleGroupRepository=$articleGroupRepository;
    }
    public function index()
    {
        $articles=$this->get_articles_array();
        $groups=$this->articleGroupRepository::get_active();
        return view('Blogs::general.index',compact('articles','groups'));
    }
    public function single($article_id)
    {
        $article=$this->articleRepository->findArticleById($article_id);
        $similar_articles=$this->articleRepository->get_similar($article);
        $article->load('group');
        $comments=$this->commentRepository->get_comments_level_1($article);

        return view('Blogs::general.single',compact('article','similar_articles','comments'));
    }
    private function get_articles_array()
    {
        return [
            'row-1'=>$this->get_row('row-1'),
            'row-2'=>$this->get_row('row-2'),
            'row-3'=>$this->get_row('row-3'),
            'row-4-1-1'=>$this->get_row('row-4-1-1'),
            'row-4-1-2'=>$this->get_row('row-4-1-2'),
            'row-4-2-1'=>$this->get_row('row-4-2-1'),
            'row-5'=>$this->get_row('row-5'),
            'row-6-1'=>$this->get_row('row-6-1'),
            'row-6-2-1'=>$this->get_row('row-6-2-1'),
            'row-6-2-2'=>$this->get_row('row-6-2-2'),
            'row-6-2-3'=>$this->get_row('row-6-2-3'),
            'row-7'=>$this->get_row('row-7'),
        ];
    }
    private function get_row($position_slug)
    {
        $position=$this->positionRepository->find_by_slug($position_slug);

        return [
            'articles'=>$this->positionRepository->get_articles($position)->take(4),
            'position'=>$position
        ];
    }
}
