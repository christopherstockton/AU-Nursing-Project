<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\People;
use App\Assignment;
use Illuminate\Support\Facades\Validator;

class PeopleController extends Controller
{

  //List all 'people' this includes students and instructors
  public function show($id) {

    $people = People::find($id);
    $assignments = new Assignment;

    return view('people.view', compact('people', 'assignments'));

  }

  //Listing all students
  public function listStudents() {

  $people = new People;

  return view('people.list', [
    'people' => $people,
    'flag' => 1,
  ]);

}

  //List all instructors
  public function listInstructors() {

    $people = new People;

    return view('people.list', [
      'people' => $people,
      'flag' => 0,
    ]);

  }

  //Delete the specififed id number. This can be student/instructor
  public function delete($id) {

    $person = People::find($id);
    $flag = request('flag');
    $person->delete();

    if ($flag == 1) {
      return redirect('/instructors');
    } else {
      return redirect('/students');
    }

  }

    //function that present the users with the people creation page
    public function create() {

      return view('people.create');

    }

    public function bulk(Request $request) {

        //PhpSpreadsheet Stuff
        $filename = $request->file('bulkData')->getClientOriginalName();
        $file = $request->file('bulkData')->storeAs('people', $filename);
        $fileLocation = storage_path("app/people/") . $filename;

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader->setReadDataOnly(true);
        //disables empty cells
        $reader->setReadEmptyCells(false);
        $spreadsheet = $reader->load($fileLocation);

        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        //Everything Else
        $courses = \DB::table('courses')->get();

      return view('people.bulk', [
          'rows' => $rows,
          'courses' => $courses
      ]);
    }

    public function bulkUpload(Request $request) {

      $input = $request->all();
      //\Log::info($input);
 
      $list = $input['names'];
      $courseID = $input['courseID'];
      $courseID2 = $input['courseID2'];
      $courseID3 = $input['courseID3'];
      $size = sizeof($list);

      
      for ($i=0; $i<$size; $i+=2) {
          $person = new People;
          $person->firstName =  $list[$i];
          $person->lastName =   $list[$i+1];
          $person->flag =       1;
          $person->created_at = \Carbon\Carbon::now();
          $person->updated_at = \Carbon\Carbon::now();
          $person->save();

          $assignment = new Assignment;
          $assignment->studentID = $person->id;
          $assignment->courseID =  $courseID;
          $assignment->created_at = \Carbon\Carbon::now();
          $assignment->updated_at = \Carbon\Carbon::now();
          $assignment->save();

          if ($courseID2 != "none") {
            $assignment2 = new Assignment;
            $assignment2->studentID = $person->id;
            $assignment2->courseID =  $courseID2;
            $assignment2->created_at = \Carbon\Carbon::now();
            $assignment2->updated_at = \Carbon\Carbon::now();
            $assignment2->save();
          }
          if ($courseID3 != "none") {
            $assignment3 = new Assignment;
            $assignment3->studentID = $person->id;
            $assignment3->courseID =  $courseID3;
            $assignment3->created_at = \Carbon\Carbon::now();
            $assignment3->updated_at = \Carbon\Carbon::now();
            $assignment3->save();
          }

    }
    

    //get last person->id, courseid

      return "Bulk Upload Success";


    }

    //Creates a new people object using this function.
    public function store() {

      $people = new People();

        $validator = Validator::make(request()->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('people/create')
                ->withErrors($validator)
                ->withInput();
        }

      $people->firstName = request('firstName');
      $people->lastName = request('lastName');
      $people->phoneNumber = request('phoneNumber');
      $people->emailAddress = request('emailAddress');
      $people->notes = request('notes');
      $people->flag = request('flag');

      $flag = request('flag');

      $people->save();

      if ($flag == 0) {
        return redirect('/instructors');
      } else {
        return redirect('/students');
      }
    }

    //Find the 'people' with the specified id and open that data into the edit page
    public function edit($id) {

      $person = People::find($id);

      return view('people.edit', compact('person'));
    }

    //Upon updating, grab the data again and "re-store" into the DB. Then reload the /people page
    public function update($id) {
      if (request('inputType' == "createPerson")) {

        $person = People::find($id);

        $person->firstName = request('firstName');
        $person->lastName = request('lastName');
        $person->phoneNumber = request('phoneNumber');
        $person->emailAddress = request('emailAddress');
        $person->notes = request('notes');
        $person->flag = request('flag');

        $person->save();

        return redirect('/people/' . $person->id);
      }

    }


}
