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
                                <img src="http://placehold.it/150x150" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />
                                <div class="middle">
                                </div>
                            </div>
                            <div class="userData ml-3">
                                <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold">{{$people->firstName}} {{$people->lastName}}</h2>
                                @if ($people->flag == 0)
                                <h6 class="d-block">Type: <span class="flag">Instructor</span></h6>
                                @else
                                <h6 class="d-block">Type: <span class="flag">Student</span></h6>
                                @endif
                                <h6 class="d-block">ID: {{$people->id}}</h6>
                                <h6 class="d-block">Created: {{$people->created_at}}</h6>
                                <h6 class="d-block">Updated: {{$people->updated_at}}</h6>
                            </div>
                        </div>
                    </div>

                    <a class="btn btn-danger" href="/people/delete/{{$people->id}}">DELETE</a>
                    <a class="btn btn-info" href="/people/{{$people->id}}/edit">EDIT</a>
                    @if ($people->flag == 0)
                    <a class="btn btn-secondary" href="/instructors/">BACK</a>
                    @else
                    <a class="btn btn-secondary" href="/students/">BACK</a>
                    @endif

                    <div class="row mt-3">
                        <div class="col-12">
                                @if ($people->flag == 0)
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Email</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{ $people->emailAddress }}
                                        </div>
                                    </div>
                                    <hr />

                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Phone</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{ $people->phoneNumber }}
                                        </div>
                                    </div>
                                    <hr />
                                @endif
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Notes</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                        @if ($people->notes == NULL)
                                        N/A
                                        @else
                                            {{ $people->notes}}
                                        @endif
                                        </div>
                                    </div>
                                    @if ($people->flag == 1)
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Registered Courses</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                        @if ($assignments->isEmpty($people->id) == true)
                                        N/A
                                        @else
                                        @foreach ($assignments->retrieve($people->id) as $assignment)
                                            <a href="../clinicals/{{$assignment->id}}">{{$assignment->courseSection}} - {{$assignment->courseName}}</a>
                                            <br>
                                        @endforeach
                                        @endif
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
