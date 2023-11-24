<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleHasPermission extends Model
{
    use HasFactory, Notifiable, Loggable;

    public $timestamps = false;
    protected $table = 'role_has_permissions';
    protected $fillable = [
        'permission_id',
        'role_id'
    ];

}
