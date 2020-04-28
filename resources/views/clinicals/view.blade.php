@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title mb-4">
                        <div class="d-flex justify-content-start">
                            <div class="userData ml-3">
                                @if ($clinicals->flag == 0)
                                <h6 class="d-block">Type: <span class="flag">Clinical</span></h6>
                                @else
                                <h6 class="d-block">Type: <span class="flag">Lab</span></h6>
                                @endif
                                <h6 class="d-block">ID: {{$clinicals->id}}</h6>
                                <h6 class="d-block">Created: {{$clinicals->created_at}}</h6>
                                <h6 class="d-block">Updated: {{$clinicals->updated_at}}</h6>
                            </div>
                        </div>
                    </div>

                    <a class="btn btn-danger" href="/clinicals/delete/{{$clinicals->id}}">DELETE</a>
                    <a class="btn btn-primary" href="/clinicals/{{$clinicals->id}}/edit">EDIT</a>
                    <a class="btn btn-primary" href="/clinicals/">BACK</a>

                    <div class="row mt-3">
                        <div class="col-12">
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Course</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                        <a href="/courses/{{ $clinicals->courseID }}">{{ $clinicals->CourseSection}} - {{ $clinicals->CourseName }}</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Instructor</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                        <a href="/people/{{$clinicals->personID}}">{{ $clinicals->firstName }} {{ $clinicals->lastName}}</a>@if ($instructor2 != NULL) and <a href="/people/{{$instructor2->id}}">{{ $instructor2->firstName }} {{ $instructor2->lastName }}</a>@endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Site Name</label>
                                        </div>
                                        @if ($clinicals->flag == 0)
                                        <div class="col-md-8 col-6">
                                        <a href="/sites/{{$clinicals->siteID}}">{{ $clinicals->siteName}}</a>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Room Number</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                        {{ $clinicals->roomNumber }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Capacity</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                        {{ $clinicals->capacity }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Enrolled</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{ $clinicals->enrolled }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Day</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                        {{ $clinicals->days }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Times</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                        {{ $clinicals->startTime}} - {{ $clinicals->endTime}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Dates</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                        {{ $clinicals->startDate}} - {{ $clinicals->endDate}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Registered Students</label>
                                            <button onclick=showControls() class="btn btn-outline-warning btn-sm">Delete Students</a>
                                        </div>
                                        <div class="col-md-8 col-6">
                                        @foreach ($assignments->retrieveStudents($clinicals->id) as $assignment)
                                        <span>
                                            <a href="javascript:void(0);" onclick="del(this, {{$assignment->id}}, {{$clinicals->id}}, {{$clinicals->courseID}})" style="color:red" class="controls">&#10006</a>
                                            <a href ="../people/{{$assignment->Studentid}}"> {{$assignment->firstName}} {{$assignment->lastName}} </a> <br>
                                        </span>
                                        @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>

    <script>
        var display = false;
        $(".controls").hide(0);

        function showControls() {
            display = !display;

            if (display == true) {
                $(".controls").show(300);
            } else if (display == false) {
                $(".controls").hide(300);
            }
        }

        function del(e, studentID,  clinicalID, courseID) {
            $.ajax({
                url:'/clinicals/unregister/'+studentID,
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(){e.parentNode.parentNode.removeChild(e.parentNode);},
                data: {clinicalID : clinicalID, courseID : courseID}

            });
        }
    </script>

@endsection
