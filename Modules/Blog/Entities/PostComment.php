<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class PostComment extends Model
{
    use HasFactory,Notifiable, Loggable, SoftDeletes;

    protected $table = 'post_comments';

    protected $fillable = ['user_id', 'post_id', 'parent_id', 'body'];

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
        return $this->hasMany('Modules\Blog\Entities\PostComment', 'parent_id');
    }

}
