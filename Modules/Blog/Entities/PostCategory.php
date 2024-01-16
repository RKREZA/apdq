<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCategory extends Model
{
    use HasFactory, Notifiable, Loggable, SoftDeletes;

    protected $fillable = ['code', 'name', 'status'];

    public function posts()
    {
        return $this->hasMany('Modules\Blog\Entities\Post','category_id');
    }
}
