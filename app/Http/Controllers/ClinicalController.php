<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
  //dd($students);

  return view('clinicals.list', [
    'clinicals' => $clinicals,
    'flag' => 0,
  ]);

}
public function store() {

  $people = new People();

  $people->firstName = request('firstName');
  $people->lastName = request('lastName');
  $people->phoneNumber = request('phoneNumber');
  $people->emailAddress = request('emailAddress');
  $people->notes = request('notes');
  $people->flag = request('flag');

  $people->save();

  return redirect('/students');
}


}