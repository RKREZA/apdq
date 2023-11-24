<?php

namespace Modules\FrontEndManager\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class FrontendSetting extends Model
{
    use HasFactory, Notifiable, Loggable;

    protected $fillable = ['title', 'description', 'logo_light', 'logo_dark', 'favicon', 'meta_image', 'meta_title', 'meta_description', 'meta_keywords', 'social_title', 'social_description', 'preloader_status', 'copyright'];

}
