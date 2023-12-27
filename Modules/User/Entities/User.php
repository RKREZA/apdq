<?php

namespace Modules\User\Entities;

use Exception;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Session;
use Modules\Sms\Entities\Sms;

class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable, Loggable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'mobile',
        'email',
        'password',
        'status',
        'password_changed_at',

        'fb_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function newFactory()
    {
        // return \Modules\Admin\Database\factories\UserFactory::new();
    }

    public function files()
    {
        return $this->belongsToMany('Modules\Core\Entities\File')->withPivot('file_id','user_id');
    }

    public function role()
    {
        return $this->hasMany('Modules\User\Entities\Role');
    }

    public static function current_roles()
    {
        $user = User::find(auth()->user()->id);
        $roles = $user->getRoleNames();
        return $roles;
    }

    public function emails()
    {
        return $this->belongsToMany('Modules\Email\Entities\Email')->withPivot('user_id','email_id');
    }

    public function smss()
    {
        return $this->belongsToMany('Modules\Sms\Entities\Sms')->withPivot('user_id','sms_id');
    }

    public function generateCode()
    {
        $code = rand(1000, 9999);

        UserCode::updateOrCreate(
            [ 'user_id' => auth()->user()->id ],
            [ 'code' => $code ]
        );

        $receiverNumber = auth()->user()->mobile;
        $message = "2FA login code is ". $code;

        Sms::send_sms($receiverNumber, $message);
    }

    public function transactions()
    {
        return $this->hasMany('Modules\Transaction\Entities\Transaction', 'user_id');
    }

    public function subscriptions()
    {
        return $this->hasMany('Modules\Subscription\Entities\Subscription', 'user_id');
    }

    public function subscriptionStatus()
    {
        $transactions = $this->transactions;

        if ($transactions->isEmpty()) {
            return $this->buildStatusResponse('no_subscription');
        }

        $currentTransaction = $transactions->first();
        $currentSubscription = $currentTransaction->subscription;

        if (!$currentSubscription) {
            return $this->buildStatusResponse('no_subscription');
        }

        $subscriptionDuration = $currentSubscription->duration;
        $subscriptionDurationType = $currentSubscription->duration_type;
        $subscriptionDurationInDays = $this->convertToDays($subscriptionDuration, $subscriptionDurationType);

        $transactionCreatedAt = $currentTransaction->created_at;
        $currentDate = now();

        $daysPassed = $currentDate->diffInDays($transactionCreatedAt);

        if ($daysPassed >= $subscriptionDurationInDays) {
            return $this->buildStatusResponse('expired');
        } else {
            $daysLeft = $subscriptionDurationInDays - $daysPassed;
            $status = "expires_in_$daysLeft";

            // Fetch option statuses and include in the response
            $optionAdFree = $currentSubscription->option_ad_free;
            $optionLiveContent = $currentSubscription->option_live_content;
            $optionPremiumContent = $currentSubscription->option_premium_content;

            return $this->buildStatusResponse($status, compact('optionAdFree', 'optionLiveContent', 'optionPremiumContent'));
        }
    }

    private function buildStatusResponse($status, $options = [])
    {
        $response = compact('status');
        $response = array_merge($response, $options);

        return $response;
    }


    // Helper function to convert subscription duration to days
    private function convertToDays($duration, $durationType)
    {
        switch ($durationType) {
            case 'Day(s)':
                return $duration;
            case 'Month(s)':
                return $duration * 30; // Assuming 1 month = 30 days
            case 'Year(s)':
                return $duration * 365; // Assuming 1 year = 365 days
            default:
                return 0;
        }
    }


}
