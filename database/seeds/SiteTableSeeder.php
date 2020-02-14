<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,20) as $index) {
            DB::table('sites')->insert([
                'contactID' => $index+100,
                'address' => $faker->address,
                'unit' => rand(100,400),
            ]);
        }
    }
}
