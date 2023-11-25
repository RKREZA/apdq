<?php

namespace Modules\PaymentGateway\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentGateway extends Model
{
    use HasFactory,Notifiable, Loggable, SoftDeletes;

    protected $table = 'paymentgateways';

    protected $fillable = [
        'name',
        'code',
        'info',
        'status',
    ];

}
