<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Courses;
use Illuminate\Http\Request;
use \DateTime;
use Illuminate\Support\Facades\Validator;

class CoursesController extends Controller
{
    public function show($id) {

        $courses = Courses::find($id);

//        $courseStudents = \DB::table('assignments')
//          ->join('clinicals', 'assignments.clinicalID', '=', 'clinicals.id')
//          ->join('people', 'assignments.studentID', '=', 'people.id')
//          ->where('clinicals.courseID', $id)
//          ->orderBy('section')
//          ->get();

        $courseStudents = \DB::table('people')
            ->select('people.firstName', 'people.lastName', 'people.id', 'assignments.clinicalID')
            ->join('assignments', 'people.id', '=', 'assignments.studentID')
            ->where('assignments.courseID', $id)
            ->get();

        $sections = \DB::table('clinicals')
          ->select('clinicals.id', 'clinicals.section', 'people.firstName', 'people.lastName', 'sites.siteName', 'clinicals.startTime', 'clinicals.endTime', 'clinicals.days')
          ->join('sites', 'clinicals.siteID', '=', 'sites.id')
          ->join('people', 'clinicals.instructorID', '=', 'people.id')
          ->where('courseID', $id)
          ->get();

        //dd($courses);

        return view('courses.view', ['courses' => $courses,
        'courseStudents' => $courseStudents,
        'sections' => $sections,
        ]);

    }

    public function assign($id) {
//        $courseStudents = \DB::table('assignments')
//            ->select('assignments.studentID', 'assignments.clinicalID', 'assignments.courseID')
//            ->where('assignments.courseID', $id)
//            ->get();

        $clinicals = \DB::table('clinicals')
            ->select('clinicals.id', 'clinicals.courseID', 'clinicals.section', 'clinicals.capacity', 'clinicals.enrolled', \DB::raw("clinicals.capacity - clinicals.enrolled AS ava"))
            ->where('clinicals.courseID', $id)
            ->get();
        $nullassign = \DB::table('assignments')
            ->select('assignments.clinicalID')
            ->where('assignments.courseID', $id)
            ->get();
        $amt = $nullassign->count();

        print_r($amt);
        foreach($clinicals as $clinical) {
            while($clinical->ava > 0 && $amt > 0) {
                //print_r($clinical->ava);
                \DB::table('assignments')
                    ->where([['assignments.courseID', $clinical->courseID], ['assignments.clinicalID', null]])
                    ->limit(1)
                    ->update(['assignments.clinicalID' => $clinical->id]);
                $clinical->ava -= 1;
                $amt -= 1;
                $clinical->enrolled += 1;
            }
            \DB::table('clinicals')
                ->where([['clinicals.courseID', $clinical->courseID], ['clinicals.id', $clinical->id]])
                ->limit(1)
                ->update(['clinicals.enrolled' => $clinical->enrolled]);
        }

        //dd($nullassign);
        return redirect('/courses/' . $id);
    }
    public function listCourses() {

        $courses = \DB::table('courses')->get();

        return view('courses.list', [
            'courses' => $courses,
        ]);

    }
    public function create() {

        return view('courses.create');

    }
    public function store() {

        $courses = new Courses();

        $validator = Validator::make(request()->all(), [
            'CourseName' => 'required',
            'CourseSection' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('courses/create')
                ->withErrors($validator)
                ->withInput();
        }

        $courses->CourseName = request('CourseName');
        $courses->CourseSection = request('CourseSection');

        $courses->save();

        return redirect('/courses');
    }
    public function edit($id) {

        $course = Courses::find($id);

        return view('courses.edit', compact('course'));
    }
    public function update($id) {

        $course = Courses::find($id);

        $course->CourseSection = request('CourseSection');
        $course->CourseName = request('CourseName');

        $course->save();

        return redirect('/courses/' . $course->id);

    }
    public function delete($id) {


        \DB::table('courses')->where('id', $id)->delete();
        $courses = \DB::table('courses')->get();

        return view('courses.list', [
            'courses' => $courses
        ]);
    }
}
