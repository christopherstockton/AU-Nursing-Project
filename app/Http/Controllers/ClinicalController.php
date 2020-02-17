<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clinical;

class ClinicalController extends Controller
{
  //

  public function listClinicals() {

    $clinicals = \DB::table('clinicals')
      ->join('courses', 'clinicals.courseID', '=', 'courses.courseID')
      ->join('sites', 'clinicals.siteID', '=', 'sites.siteID')
      ->join('people', 'clinicals.instructorID', '=', 'people.id')
      ->select('clinicals.*', 'courses.CourseName', 'courses.CourseSection', 'sites.address', 'people.firstName', 'people.lastName')
      ->where('clinicals.flag', 1)
      ->orderBy('clinicalID')
      ->get();

    return view('clinicals.list', [
      'clinicals' => $clinicals,
      'flag' => 0,
    ]);


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

    return view('clinicals.edit', compact('person'));
  }

  public function update($id) {

    $clinical = People::find($id);

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