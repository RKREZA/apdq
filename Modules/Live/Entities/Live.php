<?php

namespace Modules\Live\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Live extends Model
{
    use HasFactory,Notifiable, Loggable, SoftDeletes;
    use HasSlug;

    protected $table = 'lives';

    protected $fillable = [
        'content_type',
        'publish_type',
        'title',
        'description',
        'embed_html',
        'thumbnail_url',
        'external_id',
        'live_url',
        'category_id',
        'status',
        'archive',
        'seo_title',
        'seo_description',
        'seo_keyword',

    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

}
