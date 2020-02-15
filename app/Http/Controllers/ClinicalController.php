<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClinicalController extends Controller
{
    //

  public function listClinicals() {

  $clinicals = \DB::table('clinicals')->where('flag', 1)->get();
  //dd($students);

  return view('clinicals.list', [
    'clinicals' => $clinicals,
    'flag' => 0,
  ]);

}

}