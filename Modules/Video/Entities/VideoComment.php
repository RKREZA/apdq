<?php

namespace Modules\Video\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class VideoComment extends Model
{
    use HasFactory,Notifiable, Loggable, SoftDeletes;

    protected $table = 'video_comments';

    protected $fillable = ['user_id', 'video_id', 'parent_id', 'body'];

    public function user()
    {
        return $this->belongsTo("Modules\User\Entities\User");
    }
    /**
    * The has Many Relationship
    *
    * @var array
    */
    public function replies()
    {
        return $this->hasMany('Modules\Video\Entities\VideoComment', 'parent_id');
    }

}
