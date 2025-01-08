<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table("job_list")->delete();
        DB::table("users")->delete();
        DB::table("job_user_bookmarks")->delete();
        DB::table("applicants")->delete();
//        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->call(TestUserSeeder::class);
        $this->call(RandomUserSeeder::class);
        $this->call(JobSeeder::class);
        $this->call(BookmarkSeeder::class);


        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
    }
}
