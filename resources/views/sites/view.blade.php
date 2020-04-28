@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title mb-4">
                        <div class="d-flex justify-content-start">
                            <div class="image-container">
                                <div class="middle">
                                </div>
                            </div>
                            <div class="userData ml-3">
                                <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold">Site Name: {{$sites->siteName}}</h2>
                                <h6 class="d-block">Site ID: {{$sites->id}}</h6>
                                <h6 class="d-block">Contact ID: <a href="/people/{{$sites->contactID}}"> {{ $sites->firstName }} {{ $sites->lastName }}</a></h6>
                                <h6 class="d-block">Address: {{$sites->address}}</h6>
                                <h6 class="d-block">Unit Tag: {{$sites->unit}}</h6>
                            </div>
                        </div>
                    </div>

                    <a class="btn btn-danger" href="/sites/delete/{{$sites->id}}">DELETE</a>
                    <a class="btn btn-primary" href="/sites/{{$sites->id}}/edit">EDIT</a>
                    <a class="btn btn-primary" href="/sites/">BACK</a>

                </div>

            </div>
        </div>

@endsection
