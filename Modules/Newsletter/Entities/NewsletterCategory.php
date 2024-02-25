<?php

namespace Modules\Newsletter\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsletterCategory extends Model
{
    use HasFactory, Notifiable, Loggable, SoftDeletes;

    protected $fillable = ['serial', 'code', 'name', 'status'];

    public function newsletters()
    {
        return $this->hasMany('Modules\Blog\Entities\Newsletter','category_id');
    }
}
