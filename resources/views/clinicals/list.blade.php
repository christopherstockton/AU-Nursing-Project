@extends('layout')

@section('content')

  <div class="container">
    <div class="mb-4 col-md-12">
    @if ($flag == 1)
      <a class="btn btn-primary" href="/clinicals/create">New Lab</a>
    @else
      <a class="btn btn-primary" href="/clinicals/create">New Clinical</a>
    @endif
    </div>
    <div class="row">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Course Section</th>
            <th scope="col">Course Name</th>
            <th scope="col">Instructor</th>
            @if ($flag == 0)
            <th scope="col">Site Address</th>
            @endif
            @if ($flag == 1)
            <th scope="col">Room Number</th>
            @endif
            <th scope="col">Capacity</th>
            <th scope="col">Time</th>
            <th scope="col">Dates</th>
          </tr>
        </thead>
        <tbody>

            @foreach ( $clinicals as $clinical)

            <tr>
              <th scope="row"> {{ $clinical->clinicalID }} </th>
              <td>{{ $clinical->CourseSection}}</td>
              <td>{{ $clinical->CourseName}}</td>
              <td>{{ $clinical->firstName}} {{ $clinical->lastName}}</td>
            @if ($flag == 0)
              <td>{{ $clinical->address}}</td>
            @endif
            @if ($flag == 1)
              <td>{{ $clinical->roomNumber}}</td>
            @endif
              <td>{{ $clinical->capacity}}</td>
              <td>{{ $clinical->startTime}} - {{ $clinical->endTime}}</td>
              <td>{{ $clinical->startDate}} - {{ $clinical->endDate}}</td>
              <td><a class="btn btn-primary" href="/clinicals/{{ $clinical->clinicalID }}" role="button">View</a>
            </tr>

            @endforeach

        </tbody>
    </table>
  </div>
</div>

@endsection
