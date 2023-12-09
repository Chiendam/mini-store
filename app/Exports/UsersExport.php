<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $users = User::all()->map(function ($user) {
            return [
                'full_name' => $user->full_name,
                'phone_number' => $user->phone_number,
                'email' => $user->email,
                'username' => $user->username,
                'role' => $user->role,
            ];
        });
        return $users;
    }
}
