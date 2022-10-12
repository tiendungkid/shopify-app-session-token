<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends \Secomapp\Models\User
{
    public function updateFromShopInfoExtended($shopInfo): User
    {
        $this->plan_name = $shopInfo->plan_name;
        return $this;
    }
}
