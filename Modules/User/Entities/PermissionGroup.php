<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class PermissionGroup extends Model
{
    use HasFactory, Notifiable, Loggable;

    protected $fillable = ['name', 'display_name', 'description'];

    public function permission()
    {
        return $this->belongsTo('Modules\User\Entities\Permission');
    }

}
