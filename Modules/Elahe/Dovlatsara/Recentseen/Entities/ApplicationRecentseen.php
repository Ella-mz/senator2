<?php

namespace Modules\Recentseen\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Application\Entities\Application;
use Modules\User\Entities\User;

class ApplicationRecentseen extends Model
{
    protected $fillable = ['application_id', 'user_id', 'active', 'created_user', 'updated_user', 'deleted_user', 'isSeen'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id')->withTrashed();
    }
}
