<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        define("STUDENT_COUNT",     200);
        define("INSTRUCTOR_PCT",    5);
        define("SITE_COUNT",        20);
        define("CLINICAL_COUNT",    60);
        define("CLINIC_DOUBLE_PCT", 50);
        define("ASSIGNMENT_COUNT",  120);
        $faker = Faker::create();

        $courseNum = array("NUR3065", "NUR3028", "NUR3125", "NUR3145", "NUR3445", "NUR3165", "NUR4535", "NUR4637", "NUR4257");
        $courseNames = array('Health Assessment', 'Nursing Practice', 'Pathophysiology', 'Pharmacology', 'Nursing Care of Families', 'Nursing Research', 'Psychiatric Mental Health', 'Public and Community Health Nursing', 'Critical Care Nursing');
        $courseCount = count($courseNum);

        // People Seeder
        foreach (range(1,STUDENT_COUNT) as $index) {
            $created_date = date("Y-m-d H:i:s");
            $flag = true;
            if (rand(1,100) <= INSTRUCTOR_PCT) {
                $flag = false;
            }
            if (!$flag) {
                $phoneNumber = $faker->phoneNumber;
                $emailAddress = $faker->email;
            } else {
                $phoneNumber = NULL;
                $emailAddress = NULL;
            }
            DB::table('people')->insert([
            'firstName' => $faker->firstName,
            'lastName' => $faker->lastName,
            'phoneNumber' => $phoneNumber,
            'emailAddress' => $emailAddress,
            'flag' => $flag,
            'created_at' => $created_date,
            'updated_at' => $created_date,
            ]);
        }

        // Splits instructors and student ids for next seeders
        $instructors =  DB::table('people')->where('flag', 0)->get();
        $instructor_ids = array();
        foreach ($instructors as $instructor) {
            $instructor_ids[] = $instructor->id;
        }
        $instructor_qty = count($instructor_ids);

        $students =  DB::table('people')->where('flag', 1)->get();
        $student_ids = array();
        foreach ($students as $student) {
            $student_ids[] = $student->id;
        }
        $student_qty = count($student_ids);

        // Sites Seeder
        foreach (range(1,SITE_COUNT) as $index) {
            DB::table('sites')->insert([
                'contactID' => $instructor_ids[rand(0, $instructor_qty - 1)],
                'address' => $faker->address,
                'unit' => rand(100,400),
                ]);
        }

        // Course Seeder
        foreach (range(0, $courseCount-1) as $index) {
            $created_date = date("Y-m-d H:i:s");
            DB::table('courses')->insert([
                'coursesection' => $courseNum[$index],
                'coursename' => $courseNames[$index],
                'created_at' => $created_date,
                'updated_at' => $created_date,
                ]);
            }

        // Clinical Seeder
        foreach (range(1, CLINICAL_COUNT) as $index) {
            // Check if clinical is taught by two instructors
            $instructor = $instructor_ids[rand(0, $instructor_qty-1)];
            if (rand(1,100) <= CLINIC_DOUBLE_PCT) {
                $instructor2 = $instructor_ids[rand(0, $instructor_qty-1)];
                while ($instructor == $instructor2) {
                    $instructor2 = $instructor_ids[rand(0, $instructor_qty-1)];
                }
            } else {
                $instructor2 = NULL;
            }

            $created_date = date("Y-m-d H:i:s");
            $days = rand(0, 6);
            $startdate = new DateTime("2020-1-6");
            $enddate = new DateTime("2020-4-27");
            date_modify($startdate, '+'.$days.' day');
            date_modify($enddate, '+'.$days.' day');
            $timeOffset = rand(0,30);
            $starttime = new DateTime("6:00:00");
            $endtime = new DateTime("10:00:00");
            date_modify($starttime, '+'.($timeOffset*30).' minute');
            date_modify($endtime, '+'.($timeOffset*30).' minute');

            DB::table('clinicals')->insert([
                'courseID' => rand(1, $courseCount),
                'siteID' => rand(1,SITE_COUNT),
                'instructorID' => $instructor,
                'instructorID2' => $instructor2,
                'startDate' => $startdate,
                'endDate' => $enddate,
                'startTime' => $starttime,
                'endTime' => $endtime,
                'days' => $days,
                'capacity' => rand(8,15),
                'flag' => rand(0, 1),
                'roomNumber' => rand(100,150),
                'created_at' => $created_date,
                'updated_at' => $created_date,
            ]);
        }

        // Assignments Seeder
        foreach(range(0,ASSIGNMENT_COUNT) as $index) {
            DB::table('assignments')->insert([
                'studentID' => $student_ids[rand(0, $student_qty-1)],
                'clinicalID' => rand(1, CLINICAL_COUNT),
            ]);
        }

        // Users Seeder
        DB::table('users')->insert([
            'name' => 'Nursing',
            'email' => 'nursing@au.edu',
            'password' => '$2y$10$r/4q9NolT5YUM3eviTVizeMCiwXoUEN3x4tWVc7/8b/O.nWNkWhT.',
        ]);
    }
}
