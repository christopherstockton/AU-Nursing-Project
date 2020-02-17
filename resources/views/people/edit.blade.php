@extends('layout')

@section('content')

<div class="container">
  <div class=row>
    <div class="col-lg-6">
      <h2 class="flag mb-3">Edit Person</h2>
      <form method='POST' action='/people/{{$person->id}}'>
        @csrf
        @method('PUT')

        <div class="form-group">
          <label>First Name</label>
          <input type="text" class="form-control" name="firstName" value="{{$person->firstName}}"></input>
        </div>

        <div class="form-group">
          <label>Last Name</label>
          <input type="text" class="form-control" name="lastName" value="{{$person->lastName}}">
        </div>

        <div class="form-group instructor">
          <label>Phone Number</label>
          <input type="text" class="form-control" name="phoneNumber" value="{{$person->phoneNumber}}">
        </div>

        <div class="form-group instructor">
          <label>Email Address</label>
          <input type="text" class="form-control" name="emailAddress" value="{{$person->emailAddress}}">
        </div>

        <div class="form-group">
          <label>Notes</label>
          <textarea type="text" class="form-control" name="notes">{{$person->notes}}</textarea>
        </div>

        <div class="form-group">
          <label>Type</label>
          <!--This text field is currently set to 'read only' as it pertains to the status flag-->
          <input type="text" class="form-control" name="flag" id="flag" value="{{$person->flag}}" readonly>
        </div>

        <button type="submit" class="btn btn-primary mb-2">Submit</button>

      </form>
    </div>
  </div>
</div>

<script>

$(document).ready(function(){


  if ( $("#flag").val()  == 1) {
    $(".flag").text("Edit Student");
    $(".instructor").hide(1000);
  }
  else if ( $("#flag").val()  == 0) {
    $(".flag").text("Edit Instructor");
    $(".instructor").show(1000);
  }

});

</script>

@endsection
