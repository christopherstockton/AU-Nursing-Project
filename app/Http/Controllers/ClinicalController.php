<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clinical;
use App\Assignment;

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
      ->join('sites', 'clinicals.siteID', '=', 'sites.id')
      ->join('people', 'clinicals.instructorID', '=', 'people.id')
      ->select('clinicals.*', 'courses.CourseName', 'courses.CourseSection', 'sites.siteName', 'people.firstName', 'people.lastName')
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
    $clinicals = \DB::table('clinicals')
      ->join('courses', 'clinicals.courseID', '=', 'courses.id')
      ->join('sites', 'clinicals.siteID', '=', 'sites.id')
      ->join('people', 'clinicals.instructorID', '=', 'people.id')
      ->select('clinicals.*', 'courses.CourseName', 'courses.CourseSection', 'sites.siteName', 'people.firstName', 'people.lastName')
      ->where('clinicals.id', $id)
      ->orderBy('id')
      ->first();

    $assignments = new Assignment;

    //$clinicals = Clinical::find($id);

    return view('clinicals.view', compact('clinicals', 'assignments'));
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

    return redirect('/clinicals/' . $id);
  }
}