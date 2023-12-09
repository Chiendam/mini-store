<?php


use App\Enums\RoleEnum;

if (!function_exists('checkPermission')) {
    function checkPermission($roleName): bool
    {
        $user = auth()->user();
        if ($roleName == 'user') {
            return ($user->role == RoleEnum::getBYKey($roleName)) || is_null($user->role) || ($user->role == RoleEnum::getBYKey($roleName));
        }
        if($roleName == 'admin') {
            return is_null($user->role) || ($user->role == RoleEnum::getBYKey($roleName));
        }
        return false;
    }
}
