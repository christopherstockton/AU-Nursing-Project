@extends('layout')

@section('content')

  <div class="container">
    <div class="mb-4 col-md-12">
    @if ($flag == 1)
      <a class="btn btn-primary" href="/people/create">New Lab</a>
    @else
      <a class="btn btn-primary" href="/people/create">New Clinical</a>
    @endif
    </div>
    <div class="row">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">firstName</th>
            <th scope="col">lastName</th>
            <th scope="col">view</th>
          </tr>
        </thead>
        <tbody>

            @foreach ( $clinicals as $clinical)

            <tr>
              <th scope="row"> {{ $clinical->id }} </th>
              <td>{{ $clinical->courseID}}</td>
              <td>{{ $clinical->siteID}}</td>
              <td><a class="btn btn-primary" href="/people/{{ $clinical->id }}" role="button">View</a>
            </tr>

            @endforeach

        </tbody>
    </table>
  </div>
</div>

@endsection
