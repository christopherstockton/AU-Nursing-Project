@extends('layouts.app')

@section('content')

    <div class="container">
        <div class=row>
            <div class="col-lg-6">
                <h2 class="flag mb-3">Edit Person</h2>
                <form method='POST' action='/courses/{{$course->id}}'>
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Course Name</label>
                        <input type="text" class="form-control" name="CourseName" value="{{$course->CourseName}}"></input>
                    </div>

                    <div class="form-group">
                        <label>Course Section</label>
                        <input type="text" class="form-control" name="CourseSection" value="{{$course->CourseSection}}">
                    </div>

                    <button type="submit" class="btn btn-primary mb-2">Submit</button>

                </form>
            </div>
        </div>
    </div>

@endsection
