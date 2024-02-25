<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostSubcategory extends Model
{
    use HasFactory, Notifiable, Loggable, SoftDeletes;

    protected $fillable = ['serial','code', 'name', 'description', 'status'];


    public function posts()
    {
        return $this->hasMany('Modules\Blog\Entities\Post','subcategory_id');
    }
}
