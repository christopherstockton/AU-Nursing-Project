<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\People;

class PeopleController extends Controller
{

  public function show($id) {

    $people = People::find($id);

    return view('people.view', ['people' => $people]);

  }

  public function listStudents() {

  $people = \DB::table('people')->where('flag', 1)->get();
  //dd($students);

  return view('people.list', [
    'people' => $people
  ]);

}

  public function listInstructors() {

    $people = \DB::table('people')->where('flag', 0)->get();
    //dd($students);

    return view('people.list', [
      'people' => $people
    ]);

  }

  public function delete($id) {

    DB::table('people')->where('id', $id)->delete();


    //TODO - redirect to list page depending on type of person deleted
    return redirect('/students');

  }


    public function create() {

      return view('people.create');

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

    public function edit($id) {

      $person = People::find($id);

      return view('people.edit', compact('person'));
    }

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
