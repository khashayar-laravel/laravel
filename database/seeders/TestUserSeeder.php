<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Mockery\Matcher\Any;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user= User::create([
            'name' => "Test_User",
            'email' => "test@test.com",
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('123')
        ]);
        return($user);
    }
}
