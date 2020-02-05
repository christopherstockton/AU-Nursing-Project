@extends('layout')

@section('content')

    <div class="container">
        <div class="row">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Creation Date</th>
                    <th scope="col">View Record</th>
                </tr>
                </thead>
                <tbody>

                @foreach ( $students as $student)

                    <tr>
                        <th scope="row"> {{ $student->studentID }} </th>
                        <td>{{ $student->firstName }}</td>
                        <td>{{ $student->lastName }}</td>
                        <td>{{ $student->created_at }}</td>
                        <td><a class="btn btn-primary" href="/students/{{ $student->studentID }}" role="button">View</a>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
