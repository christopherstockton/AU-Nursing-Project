@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="mb-3">Logged in as {{ Auth::user()->name }}</h3> 

            <a href='/settings/clear'>Clear All Data?</a>
        </div>
    </div>
</div>

@endsection