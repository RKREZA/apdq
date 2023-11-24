<?php

namespace Modules\Video\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory,Notifiable, Loggable, SoftDeletes;

    protected $table = 'videos';

    protected $fillable = [
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
    
    public function category()
    {
        return $this->belongsTo('Modules\Video\Entities\VideoCategory');
    }

}
