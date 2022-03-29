<?php


namespace App\Models;


use Illuminate\Support\Facades\Auth;

class Utility
{
    public static function hasPermission($permission_key, $user_id = 0)
    {
        if ($user_id == 0) {
            $user_id = Auth::id();
        }
        return strcmp('admin', $permission_key) == 0 and $user_id == 1;
    }

}
