<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,100) as $index) {
            $flag = true;
            if (rand(1,100) < 6) {
                $flag = false;
            }
            DB::table('people')->insert([
            'firstName' => $faker->firstName,
            'lastName' => $faker->lastName,
            'phoneNumber' => $faker->phoneNumber,
            'emailAddress' => $faker->email,
            'flag' => $flag,
        ]);
            }
    }
}
