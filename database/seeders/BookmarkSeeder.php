<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\job;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $test_user = User::where("email","test@test.com")->firstOrFail();
        $jobIds = Job::pluck("id")->toArray();
        $randomJobs = array_rand($jobIds,3);
        foreach($randomJobs as $single_job){
            $test_user->bookmarkedJobs()->attach($jobIds[$single_job]);
        }
    }
}
