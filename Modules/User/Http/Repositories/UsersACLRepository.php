<?php

namespace Modules\User\Http\Repositories;

use Illuminate\Support\Facades\Auth;
use Alexusmai\LaravelFileManager\Services\ACLService\ACLRepository;
class UsersACLRepository implements ACLRepository
{
    /**
     * Get user ID
     *
     * @return mixed
     */
    public function getUserID()
    {
        return Auth::id();
    }

    /**
     * Get ACL rules list for user
     *
     * @return array
     */
    public function getRules(): array
    {

        if (Auth::user()->hasRole('Super Admin')) {
            return [
                ['disk' => 'public', 'path' => '*', 'access' => 2],
            ];
        }elseif(!empty(Auth::user()->mobile)) {
            return [
                ['disk' => 'public', 'path' => '/', 'access' => 1],                                  // main folder - read
                ['disk' => 'public', 'path' => 'users', 'access' => 1],                              // only read
                ['disk' => 'public', 'path' => 'users/'. \Auth::user()->mobile, 'access' => 1],        // only read
                ['disk' => 'public', 'path' => 'users/'. \Auth::user()->mobile .'/*', 'access' => 2],  // read and write
            ];
        }

        // return [
        //     ['disk' => 'public', 'path' => '/', 'access' => 1],
        //     ['disk' => 'public', 'path' => 'frontend', 'access' => 1],
        //     ['disk' => 'public', 'path' => 'frontend/', 'access' => 1],
        //     ['disk' => 'public', 'path' => 'frontend/*', 'access' => 2],
        // ];

    }
}
