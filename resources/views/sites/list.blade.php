@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="mb-4 col-md-12">
      <a class="btn btn-primary" href="/sites/create">New Site</a>
    </div>
    <div class="row">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">SITE ID - TEST</th>
            <th scope="col">INSTRUCTOR</th>
            <th scope="col">SITE NAME</th>
            <th scope="col">ADDRESS</th>
            <th scope="col">UNIT TAG</th>
            <th scope="col">VIEW</th>
          </tr>
        </thead>
        <tbody>

            @foreach ( $sites as $site )
            <tr>
              <th scope="row"> {{ $site->id }} </th>
              <th scope='row'>{{ $site->firstName }} {{ $site->lastName }}</th>
              <td>{{ $site->siteName }}</td>
              <td>{{ $site->address }}</td>
              <td>{{ $site->unit }}</td>
              <td><a class="btn btn-primary" href="/sites/{{ $site->id }}" role="button">View</a>
            </tr>

            @endforeach

        </tbody>
    </table>
  </div>
</div>

@endsection