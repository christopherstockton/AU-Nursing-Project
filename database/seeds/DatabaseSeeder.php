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
        // Unit count per course, not overall count
        define("CLINICAL_COUNT",    4);
        define("CLINIC_DOUBLE_PCT", 50);
        define("ASSIGNMENT_COUNT",  120);
        $faker = Faker::create();

        $courseNum = array("NUR 3102z", "NUR 3101z", "NUR 3261z", "NUR 3112z", "NUR 3111z", "NUR 3402z", "NUR 4202z", "NUR 4302z", "NUR 4502z", "NUR 4503z", "NUR 4802z");
        $courseNames = array('Clinical 1', 'Lab 1', 'Lab 2', 'Clinical 2', 'Lab 3', 'Clinical 3', 'Clinical 4', 'Clinical 5', 'Clinical 6', 'Clinical 7', 'Clinical 8');
        $courseCount = count($courseNum);

        $clinicalsTotal = $courseCount * CLINICAL_COUNT;

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
                'siteName' => $faker->lastName." Hospital",
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
        foreach (range (1, $courseCount) as $courseIndex) {
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
            $timeOffset = rand(0,14);
            $starttime = new DateTime("7:00:00");
            $endtime = new DateTime("9:00:00");
            date_modify($starttime, '+'.($timeOffset*30).' minute');
            date_modify($endtime, '+'.($timeOffset*30).' minute');

            DB::table('clinicals')->insert([
                'courseID' => $courseIndex,
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
                'section' => $index,
            ]);
        }
    }

        // Assignments Seeder
        foreach(range(0,ASSIGNMENT_COUNT) as $index) {
            DB::table('assignments')->insert([
                'studentID' => $student_ids[rand(0, $student_qty-1)],
                'clinicalID' => rand(1, $clinicalsTotal),
            ]);
        }

        // Users Seeder
        DB::table('users')->insert([
            'name' => 'Test Account',
            'email' => 'nursing@au.edu',
            'password' => '$2y$10$r/4q9NolT5YUM3eviTVizeMCiwXoUEN3x4tWVc7/8b/O.nWNkWhT.',
        ]);
    }
}
