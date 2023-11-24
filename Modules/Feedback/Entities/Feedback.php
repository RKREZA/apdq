<?php

namespace Modules\Feedback\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
    use HasFactory,Notifiable, Loggable, SoftDeletes;

    protected $table = 'feedbacks';

    protected $fillable = ['title', 'description', 'category_id', 'name', 'mobile','status'];



    public function category()
    {
        return $this->belongsTo('Modules\Feedback\Entities\FeedbackCategory');
    }

}
