@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="mb-4 col-md-12">
    @if ($flag == 0)
      <a class="btn btn-primary" href="/people/create">New Instructor</a>
    @else
      <a class="btn btn-primary" href="/people/create">New Student</a>
{{--      <a class="btn btn-primary" href="/people/bulk">Bulk Students</a>--}}
            <div class="border-dark">
                <form action='/people/bulk' enctype="multipart/form-data" method="post">
                    {{ csrf_field() }}
                    <input type='file' name='bulkData' id="bulkData" />

                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                </form>
            </div>
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

            @foreach ( $people->getList($flag) as $person)

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
