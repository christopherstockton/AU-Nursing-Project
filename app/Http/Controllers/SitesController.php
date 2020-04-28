<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Sites;
use Illuminate\Support\Facades\Validator;

class SitesController extends Controller
{

    //Used for viewing a single 'site'
    public function show($id) {

        $sites = Sites::find($id);
        $sites = \DB::table('sites')
        ->join('people', 'sites.contactID', '=', 'people.id')
        ->select('sites.*', 'people.firstName', 'people.lastName') //Select only the fields you need otherwise it will be overwritten.
        ->where('sites.id', $id)
        ->first();

        return view('sites.view', ['sites' => $sites ]);

    }

    //Listing all the 'sites' on a single view
    public function listSites() {

        $sites = \DB::table('sites')
        ->join('people', 'sites.contactID', '=', 'people.id')
        ->select('sites.*', 'people.firstName', 'people.lastName') //Select only the fields you need otherwise it will be overwritten.
        ->get();

        //$instructors = \DB::table('people')->where('flag', 0)->get();

        return view('sites.list', [
            'sites' => $sites,
            //'instructors' => $instructors
        ]);
    }

    //Deleting a specified 'site' based on its 'id'
    public function delete($id) {

        $sites = DB::table('sites')->where('id',$id)->get();
        DB::table('sites')->where('id', $id)->delete();

        return redirect('/sites');
      }

    //Creating a new 'site' by bringing up the 'sites.create' page
    public function create() {
        $instructors = \DB::table('people')->where('flag', 0)->get();

        return view('sites.create', [
            'instructors' => $instructors
        ]);

    }

    //Used when storing a newly created 'site'
    public function store() {

        $sites = new Sites();

        $validator = Validator::make(request()->all(), [
            'siteName' => 'required',
            'address' => 'required',
            'unit' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('sites/create')
                ->withErrors($validator)
                ->withInput();
        }

        $sites->siteName = request('siteName');
        $sites->contactID = request('instructorID'); //CHECK HERE
        $sites->address = request('address');
        $sites->unit = request('unit');

        $sites->save();

        return redirect('/sites');
    }

    //Brings up the 'sites.edit' view for the selected 'site'
    public function edit($id) {

        $sites = Sites::find($id);
        $instructors = \DB::table('people')->where('flag', 0)->get();

        return view('sites.edit', compact('sites'), [
            'instructors' => $instructors
        ]);
    }

    //Used for when updating currently existing records for a 'site'
    public function update($id) {

        $sites = Sites::find($id);

        $sites->siteName = request('siteName');
        $sites->contactID = request('instructorID'); //CHECK HERE
        $sites->address = request('address');
        $sites->unit = request('unit');

        //dd($sites);

        $sites->save();

        return redirect('/sites/' . $sites->id);

    }

}
