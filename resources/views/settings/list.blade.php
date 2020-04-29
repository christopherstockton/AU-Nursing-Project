@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="mb-3">Logged in as {{ Auth::user()->name }}</h3>

            <a class="btn btn-primary" href="/test">Export Student List</a>
            <br><br>
            <a class ="btn btn-warning" href="">Manage User Accounts</a>
            <br><br>
            <a class = "btn btn-danger" href='/settings/clear'>Clear All Data?</a>
            <br><br>
            <a class="btn btn-primary" href="/deleteuser" role="button">Delete User</a>
            <br><br>
            @if (Route::has('password.request'))
                <a class="btn btn-primary" href="{{ route('password.request') }}">
                    {{ __('Change Password') }}
                </a>
            @endif

        </div>
    </div>
</div>

@endsection
