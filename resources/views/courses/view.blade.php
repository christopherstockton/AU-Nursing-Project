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
                                    <h6 class="d-block">ID: {{$courses->CourseName}}</h6>
                                    <h6 class="d-block">Created: {{$courses->created_at}}</h6>
                                    <h6 class="d-block">Updated: {{$courses->updated_at}}</h6>
                                </div>
                            </div>
                        </div>

                        <a class="btn btn-danger" href="/courses/delete/{{$courses->id}}">DELETE</a>
                        <a class="btn btn-primary" href="/courses/{{$courses->id}}/edit">EDIT</a>
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
