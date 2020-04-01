@extends('layouts.app')

@section('content')

  <div class="container">

    <h1> {{ $month }} </h1>
    <table class="calendar" style="width:100%;border: 1px solid black;">
  <tr>
  <th>Sunday</th>
  <th>Monday</th>
  <th>Tuesday</th>
  <th>Wednesday</th>
  <th>Thursday</th>
  <th>Friday</th>
  <th>Saturday</th>
  </tr>
  @foreach ($calendar as $week)
  <tr>
    @foreach ($week as $day)
    <td>{{ $day->get(date) }}
    </td>
    @endforeach
  </tr>
  @endforeach
</table> 
  </div>
</div>

@endsection
