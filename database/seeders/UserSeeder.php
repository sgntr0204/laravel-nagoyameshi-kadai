<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     // 100人のユーザーを作成
         User::factory()->count(100)->create();

        // //  固定のユーザー
        // $user = new User();
        // $user->email = 'user@example.com';
        // $user->password = Hash::make('password');
        // $user->save();
    }
}
