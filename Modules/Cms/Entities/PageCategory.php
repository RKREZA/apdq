<?php

namespace Modules\Cms\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageCategory extends Model
{
    use HasFactory, Notifiable, Loggable, SoftDeletes;

    protected $fillable = ['code', 'name', 'status'];

}
