@extends('layout')

@section('content')

<div class="container">
  <div class=row>
    <div class="col-lg-6">
      <h2 class="mb-3">New Clinical</h2>
      <form method='post' action='/clinicals'>
        @csrf

        <div class="form-group">
          <label>Select Type:</label>
            <select class="form-control" name="flag" id="flag">
              <option class="flag" value="0">Lab</option>
              <option class="flag" value="1" selected>Clinical</option>
            </select>
        </div>

        <div class="form-group">
          <label>Course</label>
          <select class="form-control" name="courseID" id="courseID">
          @foreach ($courses as $course)
            <option class="courseID" value={{ $course->courseID }}>{{ $course->CourseSection }} - {{ $course->CourseName }}</option>
          @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Site</label>
          <select class="form-control" name="siteID" id="siteID">
          @foreach ($sites as $site)
            <option class="siteID" value={{ $site->siteID }}>{{ $site->address }}</option>
          @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Instructor</label>
          <select class="form-control" name="instructorID" id="instructorID">
          @foreach ($instructors as $instructor)
            <option class="instructorID" value={{ $instructor->id }}>{{ $instructor->firstName }} {{ $instructor->lastName }}</option>
          @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Room Number</label>
          <input type="text" class="form-control" name="roomNumber">
        </div>

        <div class="form-group instructor">
          <label>Capacity</label>
          <input type="text" class="form-control" name="capacity">
        </div>

        <div class="form-group instructor">
          <label>Days</label>
          <input type="text" class="form-control" name="days" value="0">
        </div>

        <div class="form-group instructor">
          <label>Start Time</label>
          <input type="text" class="form-control" name="startTime" value="10:00:00">
        </div>

        <div class="form-group instructor">
          <label>End Time</label>
          <input type="text" class="form-control" name="endTime" value="14:00:00">
        </div>

        <div class="form-group instructor">
          <label>Start Date</label>
          <input type="text" class="form-control" name="startDate" value="2020-01-06">
        </div>

        <div class="form-group instructor">
          <label>End Date</label>
          <input type="text" class="form-control" name="endDate" value="2020-04-27">
        </div>

        <button type="submit" class="btn btn-primary mb-2">Submit</button>

      </form>
    </div>
  </div>
</div>

<script>

  $( "#flag" ).change(function() {
    console.log($('#flag').val());

    if ( ($('#flag').val()) == 1 ) {
      $(".instructor").hide(1000);
    }
    else if ( ($('#flag').val()) == 0 ) {
      $(".instructor").show(1000);
    }


  });

</script>

@endsection
