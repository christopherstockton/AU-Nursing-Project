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
                                    <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold">{{$courses->CourseSection}}</h2>
                                    <h6 class="d-block">Name: {{$courses->CourseName}}</h6>
                                    <h6 class="d-block">Created: {{$courses->created_at}}</h6>
                                    <h6 class="d-block">Updated: {{$courses->updated_at}}</h6><br/>
                                    <h5 class="d-block">Course Sections</h5>
                                    @foreach ($units as $unit)
                                    <h6 class="d-block"><a href="/clinicals/{{ $unit->id }}">{{ $courses->CourseSection }}-0{{ $unit->section }}</a> - {{ $unit->firstName }} {{ $unit->lastName }} at {{ $unit->siteName }}, {{ date_format(date_create($unit->startTime), "g:iA") }}-{{ date_format(date_create($unit->endTime), "g:iA") }}</h6>
                                    @endforeach
                                    <h5 class="d-block">Registered Students</h5>
{{--                                    @foreach ($courseStudents as $student)--}}
{{--                                    <h6 class="d-block"><a href="/people/{{ $student->studentID }}">{{ $student->firstName }} {{ $student->lastName }}</a></h6>--}}
{{--                                    @endforeach--}}
                                    @foreach ($courseStudents as $student)
                                        @if(!is_null($student->clinicalID))
                                            <h6 class="d-block"><a href="/people/{{ $student->id }}">{{ $student->firstName }} {{ $student->lastName }}</a></h6>
                                        @else
                                            <h6 class="d-block"><a href="/people/{{ $student->id }}"><span style="color: red">*</span>{{ $student->firstName }} {{ $student->lastName }}</a></h6>
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                        </div>

                        <a class="btn btn-danger" href="/courses/delete/{{$courses->id}}">DELETE</a>
                        <a class="btn btn-primary" href="/courses/{{$courses->id}}/edit">EDIT</a>
                        <a class="btn btn-primary" href="/courses/">BACK</a>
                            <!-- Trigger Button HTML -->
                            <input type="button" class="btn btn-primary" data-toggle="collapse" data-target="#myCollapsible" value="Add New Person">
                            <!-- Collapsible Element HTML -->
                            <div id="myCollapsible" class="collapse">
                                <form method='post' action='/newstud'>
                                    @csrf

                                    <div class="form-group">
                                        <select class="form-control" name="flag" id="flag">
                                            <option class="flag" value="1">Student</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName">
                                        @error('firstName')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName">
                                        @error('lastName')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group instructor">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" name="phoneNumber">
                                    </div>

                                    <div class="form-group instructor">
                                        <label>Email Address</label>
                                        <input type="text" class="form-control" name="emailAddress">

                                    </div>

                                    <div class="form-group instructor">
                                        <input type="hidden" class="form-control" name="courseID" value="{{$courses->id}}">
                                    </div>

                                    <div class="form-group">
                                        <label>Notes</label>
                                        <textarea type="text" class="form-control" name="notes"></textarea>
                                    </div>



                                    <input type="hidden" name="inputType" value="createPerson">

                                    <button type="submit" class="btn btn-primary mb-2">Submit</button>

                                </form>
                            </div>

                    </div>
                </div>


            </div>

        </div>
    </div>

    <script>
        /*This will check the 'flag span' at that top of the view page and
        mark the 'people' as either a student or instructor based on their flag.
        */
        $(document).ready(function(){
            if ( ($(".flag").text()) === "1") {
                $(".flag").text("Student");
            }
            else if ( ($(".flag").text()) === "0") {
                $(".flag").text("Instructor");
            }
        });
    </script>


@endsection
