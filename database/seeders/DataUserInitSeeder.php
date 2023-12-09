<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataUserInitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        self::checkIssetBeforeCreate([
            'username' => 'admin',
            'password' => '123456',
            'status' => 1
        ]);
    }

    private function checkIssetBeforeCreate($data) {
        $admin = User::where('username', $data['username'])->first();
        if (empty($admin)) {
            User::create($data);
        } else {
            $admin->update($data);
        }
    }
}
