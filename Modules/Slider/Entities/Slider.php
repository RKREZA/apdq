<?php

namespace Modules\Slider\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use HasFactory,Notifiable, Loggable, SoftDeletes;

    protected $table = 'sliders';

    protected $fillable = [
        'title',
        'url',
        'description',
        'category_id',
        'video_id',
        'live_id',
        'status',

    ];

    public function files()
    {
        return $this->belongsToMany('Modules\Core\Entities\File')->withPivot('file_id','slider_id');
    }

    public function category()
    {
        return $this->belongsTo('Modules\Blog\Entities\SliderCategory');
    }

    public function video()
    {
        return $this->belongsTo('Modules\Video\Entities\Video');
    }

    public function live()
    {
        return $this->belongsTo('Modules\Live\Entities\Live');
    }

}
