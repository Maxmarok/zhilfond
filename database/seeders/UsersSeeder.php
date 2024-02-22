<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr = [
            'email' => 'test@admin.ru',
            'password' => Hash::make('12345678'),
        ];

        User::insert($arr);
    }
}
