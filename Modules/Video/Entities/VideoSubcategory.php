<?php

namespace Modules\Video\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoSubcategory extends Model
{
    use HasFactory, Notifiable, Loggable, SoftDeletes;

    protected $fillable = ['serial','code', 'name', 'description', 'status'];


    public function videos()
    {
        return $this->hasMany('Modules\Video\Entities\Video','category_id');
    }
}
