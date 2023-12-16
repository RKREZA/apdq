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
        'data',
        'status'
    ];
    

    public function subscription()
    {
        return $this->belongsTo('Modules\Subscription\Entities\Subscription');
    }

    public function user()
    {
        return $this->belongsTo('Modules\User\Entities\User');
    }

    public function paymentgateway()
    {
        return $this->belongsTo('Modules\Paymentgateway\Entities\Paymentgateway');
    }

}
