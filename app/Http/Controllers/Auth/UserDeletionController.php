<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserDeletionController extends Controller
{
    public function index()
    {

        $users = \DB::table('users')->get();

        return view('auth/userdeletion', [
            'users' => $users
        ]);
    }

    public function delete($id) {

        $user = User::find($id);
        $currentUser = auth()->user();


        print($user->email);
        if($id != $currentUser->id) {
            $user->delete();
            return redirect('/deleteuser');
        } else {
            return redirect()->back()->with('alert', 'Unable to delete Logged in account!');
        }
    }
}
