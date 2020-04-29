<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clinical;
use App\Assignment;
use App\Courses;
use Illuminate\Support\Facades\Validator;

class ClinicalController extends Controller
{
  //

  public function listClinicals() {

    $clinicals = \DB::table('clinicals')
      ->join('courses', 'clinicals.courseID', '=', 'courses.id')
      ->join('sites', 'clinicals.siteID', '=', 'sites.id')
      ->join('people', 'clinicals.instructorID', '=', 'people.id')
      ->select('clinicals.*', 'courses.CourseName', 'courses.CourseSection', 'sites.siteName', 'people.firstName', 'people.lastName')
      ->where('clinicals.flag', 0)
      ->orderBy('id')
      ->get();

    return view('clinicals.list', [
      'clinicals' => $clinicals,
      'flag' => 0,
    ]);


  }

  public function listLabs() {

    $clinicals = \DB::table('clinicals')
      ->join('courses', 'clinicals.courseID', '=', 'courses.id')
      ->join('people', 'clinicals.instructorID', '=', 'people.id')
      ->select('clinicals.*', 'courses.CourseName', 'courses.CourseSection', 'people.firstName', 'people.lastName')
      ->where('clinicals.flag', 1)
      ->orderBy('id')
      ->get();

    return view('clinicals.list', [
      'clinicals' => $clinicals,
      'flag' => 1,
    ]);


  }
  public function delete($id) {

    $clinical = Clinical::find($id);
    $flag = request('flag');
    $clinical->delete();

    if ($flag == 1) {
      return redirect('/labs');
    } else {
      return redirect('/clinicals');
    }

  }

  public function create() {
    $courses = \DB::table('courses')->get();
    $sites = \DB::table('sites')->get();
    $instructors = \DB::table('people')->where('flag', 0)->get();

  return view('clinicals.create', [
      'courses' => $courses,
      'sites' => $sites,
      'instructors' => $instructors,
    ]);
  }

  public function store() {

    $clinical = new Clinical();


//      $clinical->validate([
//          'capacity' => 'numeric'
//      ]);
      $validator = Validator::make(request()->all(), [
          'capacity' => 'numeric|min:0|required',
          'startTime' => 'date_format:"H:i:s"|required',
          'endTime' => 'date_format:"H:i:s"|required',
          'days' => 'required',
          'startDate' => 'date_format:"Y-m-d"|required',
          'endDate' => 'date_format:"Y-m-d"|required',
          'roomNumber' =>'required',
      ]);

      if ($validator->fails()) {
          return redirect('clinicals/create')
              ->withErrors($validator)
              ->withInput();
      }

    $clinical->flag= request('flag');
    $clinical->courseID= request('courseID');
    $clinical->section= request('section');
    $clinical->siteID= request('siteID');
    $clinical->instructorID= request('instructorID');
    $clinical->instructorID2= request('instructorID2');
    if ($clinical->instructorID2 == "NULL") {
      $clinical->instructorID2 = NULL;
    }
    $clinical->roomNumber= request('roomNumber');
    $clinical->capacity= request('capacity');
    $clinical->enrolled = 0;
    $clinical->days= request('days');
    $clinical->startTime= request('startTime');
    $clinical->endTime= request('endTime');
    $clinical->startDate= request('startDate');
    $clinical->endDate= request('endDate');

    $clinical->save();

    return redirect('/clinicals');
  }

  public function edit($id) {
    $courses = \DB::table('courses')->get();
    $sites = \DB::table('sites')->get();
    $instructors = \DB::table('people')->where('flag', 0)->get();
    $clinical = Clinical::find($id);

    return view('clinicals.edit', [
      'courses' => $courses,
      'sites' => $sites,
      'instructors' => $instructors,
      'clinicals' => $clinical
    ]);
  }

  public function show($id) {

    $c = Clinical::find($id);
    if ($c->flag == 0) {
      $clinicals = \DB::table('clinicals')
        ->join('courses', 'clinicals.courseID', '=', 'courses.id')
        ->join('sites', 'clinicals.siteID', '=', 'sites.id')
        ->join('people', 'clinicals.instructorID', '=', 'people.id')
        ->select('clinicals.*', 'courses.id as courseID', 'courses.CourseName', 'courses.CourseSection', 'sites.siteName', 'people.firstName', 'people.lastName', 'people.id as personID', 'sites.id as siteID')
        ->where('clinicals.id', $id)
        ->orderBy('id')
        ->first();
    } else {
        $clinicals = \DB::table('clinicals')
        ->join('courses', 'clinicals.courseID', '=', 'courses.id')
        ->join('people', 'clinicals.instructorID', '=', 'people.id')
        ->select('clinicals.*', 'courses.id as courseID', 'courses.CourseName', 'courses.CourseSection',  'people.firstName', 'people.lastName', 'people.id as personID')
        ->where('clinicals.id', $id)
        ->orderBy('id')
        ->first();
    }

    $instructor2 = \DB::table('clinicals')
      ->join('people', 'clinicals.instructorID2', '=', 'people.id')
      ->select('firstName', 'lastName', 'people.id')
      ->where('clinicals.id', $id)
      ->first();

    $assignments = new Assignment;

    //$clinicals = Clinical::find($id);

    //dd($clinicals);

    return view('clinicals.view', compact('clinicals', 'assignments', 'instructor2'));
  }

  public function update($id) {

    $clinical = Clinical::find($id);

    $clinical->flag= request('flag');
    $clinical->courseID= request('courseID');
    $clinical->siteID= request('siteID');
    $clinical->instructorID= request('instructorID');
    $clinical->roomNumber= request('roomNumber');
    $clinical->capacity= request('capacity');
    $clinical->days= request('days');
    $clinical->startTime= request('startTime');
    $clinical->endTime= request('endTime');
    $clinical->startDate= request('startDate');
    $clinical->endDate= request('endDate');

    $clinical->save();

    return $this->show($id);
  }

  public function export() {


    $assignments = new Assignment;
    $clinicals = new Clinical;
    //$clinicals = Clinical::all();
    $courses = Courses::all();

    return view('clinicals.export', compact('clinicals', 'assignments', 'courses'));

  }

  public function unregister($id, Request $request) { 
    
    $input = $request->all();
    $courseID = $input['courseID'];
    $clinicalID = $input['clinicalID'];

    \DB::table('assignments')
      ->where([
        ['studentID',  '=', $id],
        ['courseID',   '=', $courseID],
        ['clinicalID', '=', $clinicalID]])
      ->update(['clinicalID' => null]);

    //return($clinicalID);
  }


}
