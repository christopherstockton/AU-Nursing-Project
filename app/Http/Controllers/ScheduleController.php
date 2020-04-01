<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Sites;
use \DateTime;

class ScheduleController extends Controller
{
    public function listSchedule() {
        $placeHolderLink = "27";
        //$today = new DateTime('now');
        $today = new DateTime('2020-02-15');
        $month = $today->format("F Y");
        $firstDay = (new DateTime($today->format("Y-M") . "-01"))->format('w');
        $lastDay = $today->format('t');
        //dd($lastDay);

        // Create First Week
        $firstWeek = collect();
        $day = 1;
        for ($i = 1; $i <= 7; $i++) {
            if ($i > $firstDay) {
                $date = collect([['date' => $day, "ID" => $placeHolderLink]]);

                $date = $date->concat(self::searchClinicals($day));

                //$date = $date->concat($clinicals);
                //dd($date);
                $firstWeek = $firstWeek->concat($date);
                $day++;
            } else {
                $firstWeek = $firstWeek->concat(collect([['date' => "", "ID" => ""]]));
            }
        }

        // Create Rest of Month
        $calendar = collect([$firstWeek]);
        for (; $day <= 31; $day++) {
            $week = collect();
            for ($j = 0; $j < 7; $j++) {
                if ($day <= $lastDay) {
                    $date = collect(['date' => $day, "ID" => $placeHolderLink]);
                } else {
                    $date = collect(['date' => "", "ID" => ""]);
                }
                $week = $week->concat([$date]);
                $day++;
            }
            $calendar = $calendar->concat([$week]);
        }
        //$calendar = $calendar->chunk(7);
        //dd($calendar);
        return view('schedule.list', ['calendar' => $calendar, 'month' => $month,]);
    }

    function searchClinicals($day) {
        $clinicals = \DB::table('clinicals')
        ->join('courses', 'clinicals.courseID', '=', 'courses.id')
        ->join('sites', 'clinicals.siteID', '=', 'sites.id')
        ->join('people', 'clinicals.instructorID', '=', 'people.id')
        ->select('clinicals.*', 'courses.CourseName', 'courses.CourseSection', 'sites.siteName', 'people.firstName', 'people.lastName')
        ->where('clinicals.days', $day)
        ->orderBy('id')
        ->get();

        return $clinicals;
    }
}

