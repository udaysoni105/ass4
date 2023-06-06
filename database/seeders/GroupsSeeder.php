<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;
use Faker\Factory as Faker;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();

        for ($i = 0; $i <= 20; $i++) {
            $group = new Group;
            $group->name = $faker->name;
            $group->description = $faker->sentence;
            $group->save();
        }
    }
}
