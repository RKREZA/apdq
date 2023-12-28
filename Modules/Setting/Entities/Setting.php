<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory, Notifiable, Loggable;

    protected $fillable = [
        'title',
        'description',
        'logo_dark',
        'logo_light',
        'favicon',
        'meta_image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'social_title',
        'social_description',
        'preloader_status',
        'back_to_top_status',
        'copyright',

        'google_login',
        'google_client_id',
        'google_client_secret',
        'google_redirect',

        'google_recaptcha_v3_site_key',
        'google_recaptcha_v3_secret_key',
        'google_adsense_publisher_id',
        'google_youtube_api_key',

        'facebook_login',
        'facebook_app_id',
        'facebook_client_secret',
        'facebook_redirect',

        'gdpr_cookie_title',
        'gdpr_cookie_text',
        'gdpr_cookie_url'
    ];

}
