@extends('layout')

@section('content')

  <div class="container">
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

            @foreach ( $people as $person)

            <tr>
              <th scope="row"> {{ $person->id }} </th>
              <td>{{ $person->firstName }}</td>
              <td>{{ $person->lastName }}</td>
              <td><a class="btn btn-primary" href="/people/{{ $person->id }}" role="button">View</a>
            </tr>

            @endforeach

        </tbody>
    </table>
  </div>
</div>

@endsection
