<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Subscription extends Model
{
    use HasFactory,Notifiable, Loggable, SoftDeletes;
    use HasSlug;

    protected $table = 'subscriptions';

    protected $fillable = [
        'title',
        'description',
        'duration',
        'duration_type',
        'price',
        'status',
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
