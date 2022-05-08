<?php namespace Modules\Ad\Traits;

trait AdScopesTrait
{
    public function scopeType($query, $arg)
    {
        return $query->where('type', $arg);
    }

    public function scopeMobile($query, $arg)
    {
        return $query->where('mobile', $arg);
    }

    public function scopeIsPaid($query, $arg)
    {
        return $query->where('isPaid', $arg);
    }

    public function scopeActive($query, $arg)
    {
        return $query->where('active', $arg);
    }

    public function scopeRequestToAgency($query, $arg)
    {
        return $query->where('request_to_agency', $arg);
    }

    public function scopeAdvertiser($query, $arg)
    {
        return $query->where('advertiser', $arg);
    }

    public function scopeEndDateGreaterThan($query, $arg)
    {
        return $query->where('endDate', '>', $arg);
    }

    public function scopeEndDateSmallerThan($query, $arg)
    {
        return $query->where('endDate', '<', $arg);
    }

    public function scopeUserStatusNotEqualTo($query, $arg)
    {
        return $query->where('userStatus', '!=', $arg);
    }

    public function scopeUserStatus($query, $arg)
    {
        return $query->where('userStatus', $arg);
    }

    public function scopeCity($query, $arg)
    {
        return $query->where('city_id', $arg);
    }

    public function scopeCategory($query, $arg)
    {
        return $query->where('category_id', $arg);
    }

    public function scopeAgency($query, $arg)
    {
        return $query->where('agency_id', $arg);
    }

    public function scopeUser($query, $arg)
    {
        return $query->where('user_id', $arg);
    }
}
