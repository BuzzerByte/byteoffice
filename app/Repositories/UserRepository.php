<?php

namespace App\Repositories;

use App\User;
use Auth;

class UserRepository
{
    /**
     * Get all of the vendor for the given user.
     *
     * @param  Vendor  $vendor
     * @return Collection
     */
    public function getAuthUser()
    {
        return Auth::user();
    }
}