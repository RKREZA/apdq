<?php

namespace Modules\Faq\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use HasFactory,Notifiable, Loggable, SoftDeletes;

    protected $table = 'faqs';

    protected $fillable = ['title', 'description', 'category_id', 'status'];



    public function category()
    {
        return $this->belongsTo('Modules\Faq\Entities\FaqCategory');
    }

}
