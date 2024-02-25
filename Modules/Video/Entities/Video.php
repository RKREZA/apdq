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
        'content_type',
        'publish_type',
        'title',
        'description',
        'embed_html',
        'thumbnail_url',
        'external_id',
        'tag',
        'category_id',
        'subcategory_id',
        'playlist_id',
        'status',
        'featured',
        'created_at',
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

    public function subcategory()
    {
        return $this->belongsTo('Modules\Video\Entities\VideoSubcategory');
    }

    public function playlist()
    {
        return $this->belongsTo('Modules\Video\Entities\VideoPlaylist');
    }

    public function comments()
    {
        return $this->hasMany('Modules\Video\Entities\VideoComment')->whereNull('parent_id');
    }

}
