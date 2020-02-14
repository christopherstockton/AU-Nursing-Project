<?php

use Illuminate\Database\Seeder;

class ClincalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courseCount = 9;
        // Course ID, 1 through Courses
        // Site ID, null
        // Instructor ID, random ID of instructor
        // Instructor ID 2, random ID, possibly null
        // Start Date, random January Date
        // End Date, random May Date
        // Start Time, integer time
        // End Time, integer time
        // Days, integer starting with 1 as Monday
        // Capacity, random integer between 8-15
        // Flag, true
        // Room Number, random integer between 100-150
    }
}
