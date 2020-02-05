@extends('layout')

@section('content')

    <div class="container">
        <div class=row>
            <form method='post' action='/students'>
                @csrf

                <h2>New Student</h2>

                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" name="firstName" id="firstName">
                </div>

                <div class="form-group">
                    <label>LastName</label>
                    <input type="text" class="form-control" name="lastName" id="lastName">
                </div>

                <button type="submit" class="btn btn-primary mb-2">Submit</button>

            </form>
        </div>
    </div>

@endsection
