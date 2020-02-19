<?php

namespace App\Http\Controllers;

use App\Courses;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function show($id) {

        $courses = Courses::find($id);

        return view('courses.view', ['courses' => $courses]);

    }
    public function listCourses() {

        $courses = \DB::table('courses')->get();

        return view('courses.list', [
            'courses' => $courses
        ]);

    }
    public function create() {

        return view('courses.create');

    }
    public function store() {

        $courses = new Courses();

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
