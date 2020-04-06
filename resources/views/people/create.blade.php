@extends('layouts.app')

@section('content')

<div class="container">
  <div class=row>
    <div class="col-lg-6">
      <h2 class="mb-3">New Person</h2>
      <form method='post' action='/people'>
        @csrf

        <div class="form-group">
          <label>Select Type:</label>
            <select class="form-control" name="flag" id="flag">
              <option class="flag" value="0">Instructor</option>
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

        <div class="form-group">
          <label>Notes</label>
          <textarea type="text" class="form-control" name="notes"></textarea>
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
