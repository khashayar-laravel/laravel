<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use function Laravel\Prompts\table;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sample_data = include database_path("seeders/data/job_listings.php");
        $test_user_id = User::where("email","test@test.com")->value("id");
        $user_id = User::where("email","!=","test@test.com")->pluck("id")->toArray();

        foreach($sample_data as $index=>&$data){
            if($index < 2){
                $data['user_id'] = $test_user_id;
            }else{
                $data['user_id'] = $user_id[array_rand($user_id)];
            }
            $data['created_at'] = now();
            $data['updated_at'] = now();
        }
        DB::table("job_list")->insert($sample_data);
    }
}
