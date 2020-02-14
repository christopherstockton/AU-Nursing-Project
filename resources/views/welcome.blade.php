@extends('layouts.app')
@section('welcomecontent')
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    @auth
                        Hello, {{ Auth::user()->name }}
                    @else
                        AU Nursing Schedule Tool
                    @endauth
                </div>

            </div>
        </div>
@endsection
