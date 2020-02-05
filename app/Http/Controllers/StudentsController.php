<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Student;

class StudentsController extends Controller
{
    public function show($studentID) {

        //$student = \DB::table('students')->where('studentID', $studentID)->first();

        return view('students.view', [
            'student' => $student = Student::where('studentID', $studentID)->firstOrFail()
        ]);

    }

    //List all the students
    public function list() {

        $students = \DB::table('students')->get();
        //dd($students);

        return view('students.list', [
            'students' => $students
        ]);

    }

    //deleting a student
    public function delete($studentID) {

        DB::table('students')->where('studentID', $studentID)->delete();

        return redirect('/students');

    }

    //creating a student
    public function create() {

        return view('students.create');

    }

    //Storing/edit a student
    public function store() {


        $student = new Student();
        $student->firstName = request('firstName');
        $student->lastName = request('lastName');
        $student->save();

        return redirect('/students');
    }
}
