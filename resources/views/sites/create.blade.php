@extends('layouts.app')

@section('content')

<div class="container">
  <div class=row>
    <div class="col-lg-6">
      <h2 class="mb-3">New Site</h2>
      <form method='post' action='/sites'>
        @csrf

        <div class="form-group">
          <label>Site Name<span style="color: red">*</span></label>
          <input type="text" class="form-control @error('siteName') is-invalid @enderror" name="siteName">
            @error('siteName')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
          <label>Instructor</label>
          <select class="form-control" name="instructorID" id="instructorID">
          @foreach ( $instructors as $instructor)
            <option class="instructorID" value={{ $instructor->id }}>{{ $instructor->firstName }} {{ $instructor->lastName }}</option>
          @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Site Address<span style="color: red">*</span></label>
          <input type="text" class="form-control @error('address') is-invalid @enderror" name="address">
            @error('address')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group instructor">
          <label>Unit Tag<span style="color: red">*</span></label>
          <input type="text" class="form-control @error('unit') is-invalid @enderror" name="unit">
            @error('unit')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mb-2">Submit</button>

      </form>
    </div>
  </div>
</div>

@endsection
