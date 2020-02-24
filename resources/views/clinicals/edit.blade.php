@extends('layouts.app')

@section('content')

<div class="container">
  <div class=row>
    <div class="col-lg-6">
      <h2 class="mb-3">New Clinical</h2>
      <form method='post' action='/clinicals/{{$clinicals->id}}'>
        @csrf
        @method('PUT')

        <div class="form-group">
          <label>Select Type:</label>
            <select class="form-control" name="flag" id="flag">
              <option class="flag" value="0"@if ($clinicals->flag == 0) selected @endif >Clinical</option>
              <option class="flag" value="1"@if ($clinicals->flag == 1) selected @endif >Lab</option>
            </select>
        </div>

        <div class="form-group">
          <label>Course</label>
          <select class="form-control" name="courseID" id="courseID">
          @foreach ($courses as $course)
            <option class="courseID" value={{ $course->id}} @if ($clinicals->courseID == $course->id) selected @endif >{{ $course->CourseSection }} - {{ $course->CourseName }}</option>
          @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Site</label>
          <select class="form-control" name="siteID" id="siteID">
          @foreach ($sites as $site)
            <option class="siteID" value={{ $site->id}} @if ($clinicals->siteID == $site->id) selected @endif >{{ $site->address }}</option>
          @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Instructor</label>
          <select class="form-control" name="instructorID" id="instructorID">
          @foreach ($instructors as $instructor)
            <option class="instructorID" value={{ $instructor->id }} @if ($instructor->id == $clinicals->instructorID) selected @endif>{{ $instructor->firstName }} {{ $instructor->lastName }}</option>
          @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Room Number</label>
          <input type="text" class="form-control" name="roomNumber" value="{{ $clinicals->roomNumber }}">
        </div>

        <div class="form-group instructor">
          <label>Capacity</label>
          <input type="text" class="form-control" name="capacity" value="{{ $clinicals-> capacity }}">
        </div>

        <div class="form-group instructor">
          <label>Days</label>
          <input type="text" class="form-control" name="days" value="{{ $clinicals -> days }}">
        </div>

        <div class="form-group instructor">
          <label>Start Time</label>
          <input type="text" class="form-control" name="startTime" value="{{ $clinicals->startTime }}">
        </div>

        <div class="form-group instructor">
          <label>End Time</label>
          <input type="text" class="form-control" name="endTime" value="{{ $clinicals->endTime }}">
        </div>

        <div class="form-group instructor">
          <label>Start Date</label>
          <input type="text" class="form-control" name="startDate" value="{{ $clinicals->startDate }}">
        </div>

        <div class="form-group instructor">
          <label>End Date</label>
          <input type="text" class="form-control" name="endDate" value="{{ $clinicals->endDate }}">
        </div>

        <button type="submit" class="btn btn-primary mb-2">Submit</button>
        <a href="/clinicals/{{$clinicals->id}}" class="btn btn-primary mb-2">Back</a>

      </form>
    </div>
  </div>
</div>

@endsection
