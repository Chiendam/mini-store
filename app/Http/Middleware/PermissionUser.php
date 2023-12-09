<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionUser
{
    public function handle(Request $request, Closure $next, $nameRole)
    {
        try {
            $user = auth()->user();

            $isPermission = $this->hasPermission($user, $nameRole);
            if ($isPermission) {
                return $next($request);
            }

            abort(403);

        } catch (\Exception $e) {
            \Log::error('Error middleware permission for user', [
                'method' => __METHOD__,
                'message' => $e->getMessage()
            ]);
            session()->flash('error', 'Bạn không có quyền truy cập chức năng này');

            return redirect()->back();
        }

    }

    private function hasPermission(mixed $user, $roleName): bool
    {
        if ($roleName == 'user') {
            return ($user->role == RoleEnum::getBYKey($roleName)) || is_null($user->role) || ($user->role == RoleEnum::getBYKey($roleName));
        }
        if($roleName == 'admin') {
            return is_null($user->role) || ($user->role == RoleEnum::getBYKey($roleName));
        }
        return false;
    }
}
