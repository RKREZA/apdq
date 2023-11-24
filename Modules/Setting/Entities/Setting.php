<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory, Notifiable, Loggable;

    protected $fillable = ['title', 'description', 'logo_dark', 'logo_light', 'favicon', 'meta_image', 'meta_title', 'meta_description', 'meta_keywords', 'social_title', 'social_description', 'preloader_status', 'back_to_top_status', 'copyright'];

}
