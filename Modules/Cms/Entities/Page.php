<?php

namespace Modules\Cms\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Page extends Model
{
    use HasFactory,Notifiable, Loggable, SoftDeletes;
    use HasSlug;

    protected $table = 'pages';

    protected $fillable = [
        'title',
        'description',
        'tag',
        'category_id',
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

    public function files()
    {
        return $this->belongsToMany('Modules\Core\Entities\File')->withPivot('file_id','page_id');
    }

    public function category()
    {
        return $this->belongsTo('Modules\Cms\Entities\PageCategory');
    }

}
