<?php namespace Modules\Comment\Traits;

trait CommentScopesTrait
{
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
