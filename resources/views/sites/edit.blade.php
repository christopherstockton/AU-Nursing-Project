@extends('layouts.app')

@section('content')

<div class="container">
  <div class=row>
    <div class="col-lg-6">
      <h2 class="flag mb-3">Edit Site</h2>
      <form method='POST' action='/sites/{{$sites->id}}'>
        @csrf
        @method('PUT')

        <div class="form-group">
          <label>Site Name</label>
          <input type="text" class="form-control" name="siteName" value="{{$sites->siteName}}"></input>
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
          <label>Site Address</label>
          <input type="text" class="form-control" name="address" value="{{$sites->address}}">
        </div>

        <div class="form-group instructor">
          <label>Unit Tag</label>
          <input type="text" class="form-control" name="unit" value="{{$sites->unit}}">
        </div>

        <button type="submit" class="btn btn-primary mb-2">Submit</button>

      </form>
    </div>
  </div>
</div>

@endsection
