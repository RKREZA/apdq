<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasFactory,Notifiable, Loggable, SoftDeletes;
    use HasSlug;

    protected $table = 'posts';

    protected $fillable = [
        'publish_type',
        'content_type',
        'title',
        'description',
        'tag',
        'category_id',
        'subcategory_id',
        'status',
        'seo_title',
        'seo_description',
        'seo_keyword',
        'created_at',
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
        return $this->belongsToMany('Modules\Core\Entities\File')->withPivot('file_id','post_id');
    }

    public function category()
    {
        return $this->belongsTo('Modules\Blog\Entities\PostCategory');
    }

    public function subcategory()
    {
        return $this->belongsTo('Modules\Blog\Entities\PostSubcategory');
    }

    public function comments()
    {
        return $this->hasMany('Modules\Blog\Entities\PostComment')->whereNull('parent_id');
    }

}
