<?php namespace Modules\Blog\Traits;

trait PositionScopesTrait
{
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
