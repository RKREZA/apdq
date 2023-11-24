<?php

namespace Modules\Language\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Language extends Model
{
    use HasFactory,Notifiable, Loggable, SoftDeletes;

    protected $fillable = ['code', 'name', 'default', 'status'];

    protected static function newFactory()
    {
        // return \Modules\Language\Database\factories\LanguageFactory::new();
    }
}
