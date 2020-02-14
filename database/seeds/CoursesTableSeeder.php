<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courseCount = 9;
        $courseNum = array("NUR3065", "NUR3028", "NUR3125", "NUR3145", "NUR3445", "NUR3165", "NUR4535", "NUR4637", "NUR4257");
        $courseNames = array('Health Assessment', 'Nursing Practice', 'Pathophysiology', 'Pharmacology', 'Nursing Care of Families', 'Nursing Research', 'Psychiatric Mental Health', 'Public and Community Health Nursing', 'Critical Care Nursing');

        foreach (range(0, $courseCount-1) as $index) {
            $created_date = date("Y-m-d H:i:s");
            DB::table('courses')->insert([
                'coursesection' => $courseNum[$index],
                'coursename' => $courseNames[$index],
                'created_at' => $created_date,
                ]);
            }
    }
}
