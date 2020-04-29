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

        if ($courses->flag == 0) {
            $sections = \DB::table('clinicals')
            ->select('clinicals.id', 'clinicals.section', 'people.firstName', 'people.lastName', 'sites.siteName', 'clinicals.startTime', 'clinicals.endTime', 'clinicals.days')
            ->join('sites', 'clinicals.siteID', '=', 'sites.id')
            ->join('people', 'clinicals.instructorID', '=', 'people.id')
            ->where('courseID', $id)
            ->get();
        } else if ($courses->flag == 1) {
            $sections = \DB::table('clinicals')
            ->select('clinicals.id', 'clinicals.section', 'people.firstName', 'people.lastName', 'clinicals.startTime', 'clinicals.endTime', 'clinicals.days')
            ->join('people', 'clinicals.instructorID', '=', 'people.id')
            ->where('courseID', $id)
            ->get();
        }

        //dd($courses);

        return view('courses.view', ['courses' => $courses,
        'courseStudents' => $courseStudents,
        'sections' => $sections,
        ]);

    }

    public function singleAssign(Request $request) {
        $personid = request('flag');
        $sectionid = request('section');
        $courseid = request('courseID');
        \DB::table('assignments')
            ->where([['assignments.studentID', $personid]])
            ->limit(1)
            ->update(['assignments.clinicalID' => $sectionid]);

        //return $this->listCourses();
        return redirect('/courses/' . $courseid);
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

        $even = ceil($amt/sizeof($clinicals));
        //dd($even);


        print_r($amt);
        for ($i = 0; $i < $even; $i++) {
        foreach($clinicals as $clinical) {

                //select count(id) from assignments where clinicalId = 1;
                $e = \DB::table("assignments")
                    ->select('*')
                    ->where('clinicalID', '=', $clinical->id)
                    ->count();

                if ($clinical->capacity - $e > 0) {
                    \DB::table('assignments')
                        ->where([['assignments.courseID', $clinical->courseID], ['assignments.clinicalID', null]])
                        ->limit(1)
                        ->update(['assignments.clinicalID' => $clinical->id]);
                }

            }
            /*
            \DB::table('clinicals')
                ->where([['clinicals.courseID', $clinical->courseID], ['clinicals.id', $clinical->id]])
                ->limit(1)
                ->update(['clinicals.enrolled' => $clinical->enrolled]);
            */
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
        $courses->flag = request('flag');

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

    public function unregister($id, Request $request) { 
    
        $input = $request->all();
        $courseID = $input['courseID'];
    
        \DB::table('assignments')
          ->where([
            ['studentID',  '=', $id],
            ['courseID',   '=', $courseID]])
          ->delete();
    
        //return($clinicalID);
      }

      public function clearAssign($id) {
          \DB::table('assignments')
            ->where('courseID', '=', $id)
            ->delete();

        return redirect('/courses/' . $id);
      }
}
