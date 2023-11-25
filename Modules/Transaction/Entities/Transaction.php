<?php

namespace Modules\Transaction\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory,Notifiable, Loggable, SoftDeletes;

    protected $table = 'transactions';

    protected $fillable = [
        'email',
        'payment_amount',
        'transaction_id',
        'subscription_id',
        'user_id',
        'paymentgateway_id',
        'status'
    ];

}
