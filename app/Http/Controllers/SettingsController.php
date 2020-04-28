<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Clinical;
use App\Courses;
use App\People;
use App\Sites;
use App\Schedule;
use App\Assignment;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function listSettings()
    {
        return view('settings.list');
    }

    public function clear()
    {
        \DB::table('assignments')->delete();
        \DB::table('clinicals')->delete();
        \DB::table('sites')->delete();
        \DB::table('people')->delete();
        \DB::table('courses')->delete();

        \DB::statement("ALTER TABLE assignments AUTO_INCREMENT = 1;");
        \DB::statement("ALTER TABLE clinicals AUTO_INCREMENT = 1;");
        \DB::statement("ALTER TABLE sites AUTO_INCREMENT = 1;");
        \DB::statement("ALTER TABLE people AUTO_INCREMENT = 1;");
        \DB::statement("ALTER TABLE courses AUTO_INCREMENT = 1;");

        return view('settings.list');
    }
}
