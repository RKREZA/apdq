<?php

namespace Modules\Video\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Video extends Model
{
    use HasFactory,Notifiable, Loggable, SoftDeletes;
    use HasSlug;

    protected $table = 'videos';

    protected $fillable = [
        'video_type',
        'title',
        'description',
        'embed_html',
        'thumbnail_url',
        'external_id',
        'tag',
        'category_id',
        'status',
        'seo_title',
        'seo_description',
        'seo_keyword',
        'like',
        'love',
        'haha',
        'wow',
        'sad',
        'angry',
        'dislike',

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

    public function category()
    {
        return $this->belongsTo('Modules\Video\Entities\VideoCategory');
    }

}
