<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Member;
use Illuminate\Support\Facades\DB;

class MembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // $faker = Faker::create();

        // for ($i = 0; $i <= 20; $i++) {
        //     $member = new Member;
        //     $member->name = $faker->name;
        //     $member->email = $faker->email;
        //     $member->contact = $faker->phoneNumber;
        //     $member->group_id = $faker->randomNumber();
        //     $member->save();

        $faker = Faker::create();

        $groupIds = DB::table('groups')->pluck('id');

        for ($i = 0; $i <= 20; $i++) {
            $member = new Member;
            $member->name = $faker->name;
            $member->email = $faker->email;
            $member->contact = $faker->phoneNumber;
            $member->group_id = $faker->randomElement($groupIds);
            $member->save();
        }
    }
}
