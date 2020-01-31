<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Instructor;

class InstructorsController extends Controller
{
    function list()
    {
        $data = Instructor::orderBy('instructorID','asc')->get();
        return view('testPage', ['data'=>$data]);
    }
}
