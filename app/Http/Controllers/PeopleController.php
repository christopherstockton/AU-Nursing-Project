<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\People;

class PeopleController extends Controller
{

  //List all 'people' this includes students and instructors
  public function show($id) {

    $people = People::find($id);

    return view('people.view', ['people' => $people]);

  }

  //Listing all students
  public function listStudents() {

  $people = \DB::table('people')->where('flag', 1)->get();
  //dd($students);

  return view('people.list', [
    'people' => $people,
    'flag' => 0,
  ]);

}

  //List all instructors
  public function listInstructors() {

    $people = \DB::table('people')->where('flag', 0)->get();
    //dd($students);

    return view('people.list', [
      'people' => $people,
      'flag' => 1,
    ]);

  }

  //Delete the specififed id number. This can be student/instructor
  public function delete($id) {

    $person = DB::table('people')->where('id',$id)->get();
    $flag = request('flag');
    DB::table('people')->where('id', $id)->delete();

    if ($flag == 0) {
      return redirect('/instructors');
    } else {
      return redirect('/students');
    }

  }

    //function that present the users with the people creation page 
    public function create() {

      return view('people.create');

    }
    
    //Creates a new people object using this function. 
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

    //Find the 'people' with the specified id and open that data into the edit page
    public function edit($id) {

      $person = People::find($id);

      return view('people.edit', compact('person'));
    }

    //Upon updating, grab the data again and "re-store" into the DB. Then reload the /people page
    public function update($id) {

      $person = People::find($id);

      $person->firstName = request('firstName');
      $person->lastName = request('lastName');
      $person->phoneNumber = request('phoneNumber');
      $person->emailAddress = request('emailAddress');
      $person->notes = request('notes');
      $person->flag = request('flag');

      //dd($person);

      $person->save();

      return redirect('/people/' . $person->id);

    }


}
