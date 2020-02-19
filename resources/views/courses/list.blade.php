@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="mb-4 col-md-12">
                <a class="btn btn-primary" href="/courses/create">New Course</a>
        </div>
        <div class="row">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">CourseSection</th>
                    <th scope="col">CourseName</th>
                    <th scope="col">view</th>
                </tr>
                </thead>
                <tbody>

                @foreach ( $courses as $course)

                    <tr>
                        <th scope="row"> {{ $course->id }} </th>
                        <td>{{ $course->CourseSection }}</td>
                        <td>{{ $course->CourseName }}</td>
                        <td><a class="btn btn-primary" href="/courses/{{ $course->id }}" role="button">View</a>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection
