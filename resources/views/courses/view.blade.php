@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title mb-4">
                            <div class="d-flex justify-content-start">
                                <div class="userData ml-3">
                                    <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold">{{$courses->CourseSection}}</h2>
                                    <h6 class="d-block">Name: {{$courses->CourseName}}</h6>
                                    <h6 class="d-block">Created: {{$courses->created_at}}</h6>
                                    <h6 class="d-block">Updated: {{$courses->updated_at}}</h6><br/>
                                    <h5 class="d-block">New Sections</h5>
                                    @foreach ($clinicals->retrieveClinicals($courses->id) as $clinical)
                                    @if ($courses->flag == 0)
                                    <h6 class="d-block"><a href="/clinicals/{{ $clinical->id }}">{{ $courses->CourseSection }}-0{{ $clinical->section }}</a> - {{ $clinical->firstName }} {{ $clinical->lastName }} at {{ $clinical->siteName }}, {{ date_format(date_create($clinical->startTime), "g:iA") }}-{{ date_format(date_create($clinical->endTime), "g:iA") }}</h6>
                                    @else
                                    <h6 class="d-block"><a href="/clinicals/{{ $clinical->id }}">{{ $clinical->CourseSection }}-0{{ $clinical->section }}</a> - {{ $clinical->firstName }} {{ $clinical->lastName }}, {{ date_format(date_create($clinical->startTime), "g:iA") }}-{{ date_format(date_create($clinical->endTime), "g:iA") }}</h6>
                                    @endif
                                            @foreach ($assignments->retrieveStudents($clinical->id) as $assignment)
                                                <a href="/people/{{ $assignment->id }}">{{$assignment->firstName}} {{$assignment->lastName}}</a><br>
                                            @endforeach
                                    @endforeach
                                    <h5 class="d-block">Labs and Clinicals</h5>
                                    @foreach ($sections as $section)
                                    @if ($courses->flag == 0)
                                    <h6 class="d-block"><a href="/clinicals/{{ $section->id }}">{{ $courses->CourseSection }}-0{{ $section->section }}</a> - {{ $section->firstName }} {{ $section->lastName }} at {{ $section->siteName }}, {{ date_format(date_create($section->startTime), "g:iA") }}-{{ date_format(date_create($section->endTime), "g:iA") }}</h6>
                                    @else
                                    <h6 class="d-block"><a href="/clinicals/{{ $section->id }}">{{ $courses->CourseSection }}-0{{ $section->section }}</a> - {{ $section->firstName }} {{ $section->lastName }}, {{ date_format(date_create($section->startTime), "g:iA") }}-{{ date_format(date_create($section->endTime), "g:iA") }}</h6>
                                    @endif
                                    @endforeach
                                    <h5 class="d-block">
                                        Registered Students
                                        <button onclick=showControls() class="btn btn-outline-warning btn-sm">Delete Assignments</a>
                                        <button onclick=deleteAll() class="btn btn-outline-danger btn-sm">Delete All</a>
                                    </h5>
                                    @foreach ($courseStudents as $student)
                                    <h6 class="d-block student">
                                        <a href="javascript:void(0);" onclick="del(this, {{$student->id}}, {{$courses->id}})" style="color:red" class="controls">&#10006</a>
                                        @if(!is_null($student->clinicalID))
                                        <a href="/people/{{ $student->id }}">{{ $student->firstName }} {{ $student->lastName }}</a>
                                        @else
                                            <a href="/people/{{ $student->id }}"><span style="color: red">*</span>{{ $student->firstName }} {{ $student->lastName }}</a>
                                        @endif
                                    </h6>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                        <a class="btn btn-danger" href="/courses/delete/{{$courses->id}}">DELETE</a>
                        <a class="btn btn-info" href="/courses/{{$courses->id}}/edit">EDIT</a>
                        <a class="btn btn-secondary" href="/courses/">BACK</a>
                        <br><br>
                        <a class="btn btn-success" href="/courses/{{$courses->id}}/assign">Automatically Assign All</a>
                            <!-- Trigger Button HTML -->
                            <input type="button" class="btn btn-primary" data-toggle="collapse" data-target="#myCollapsible" value="Assign to Course">
                            <input type="button" class="btn btn-primary" data-toggle="collapse" data-target="#assignsingle" value="Assign to Section">

                            <!-- Collapsible Element HTML -->
                            <br><br>
                            <div id="myCollapsible" class="collapse col-6">
                                <form method='post' action='/courseAssign'>
                                    @csrf

                                    <div class="form-group">
                                        <select class="form-control" name="studentID" id="studentID">
                                        @foreach ($nonCourseStudents as $student)
                                                <option value="{{$student->id}}">{{ $student->firstName }} {{ $student->lastName }}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <input type="hidden" name="courseID" value="{{$courses->id}}">

                                    <button type="submit" class="btn btn-primary mb-2">Submit</button>

                                </form>
                            </div>

                        <!-- Collapsible Element HTML -->
                        <div id="assignsingle" class="collapse col-6">
                            <form method='post' action='/singleAssign'>
                                @csrf

                                <br>
                                <div class="form-group">
                                    <select id="DD" class="form-control" name="flag" id="flag">
                                        @foreach ($courseStudents as $student)
                                            @if(is_null($student->clinicalID))
                                                <option value="{{$student->id}}">{{ $student->firstName }} {{ $student->lastName }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group ">
                                    <select class="form-control" name="section" id="section">
                                        @foreach ($sections as $section)
                                                <option value="{{$section->id}}">{{ $courses->CourseSection }}-0{{ $section->section }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <input type="hidden" name="courseID" value="{{$courses->id}}">

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

        function deleteAll() {
            if (confirm("Are you sure you want to delete all students assigned to this course?")) {
                window.location.replace("/courses/clearAssignments/{{ $courses->id }}");
            }
        }

        function del(e, studentID, courseID) {
            $.ajax({
                url:'/courses/unregister/'+studentID,
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(){
                    e.parentNode.parentNode.removeChild(e.parentNode);
                    var select=document.getElementById('DD');
                    for (i=0;i<select.length;  i++) {
                        if (select.options[i].value==studentID) {
                            select.remove(i);
                        }
                    }
                },
                data: { courseID : courseID }
            });
        }
    </script>


@endsection
