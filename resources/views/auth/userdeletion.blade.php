@extends('layouts.app')

@section('content')
    <div>

        <script>
            var msg = '{{Session::get('alert')}}';
            var exist = '{{Session::has('alert')}}';
            if(exist) {
                alert(msg);
            }
        </script>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
            </tr>
            </thead>
            <tbody>

            @foreach ( $users as $user)

                <tr>
                    <th scope="row"> {{ $user->id }} </th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>

                    <td><a class="btn btn-primary" href="/deleteuser/{{ $user->id }}" role="button">Delete</a>
                </tr>

            @endforeach

            </tbody>
        </table>
    </div>
@endsection
