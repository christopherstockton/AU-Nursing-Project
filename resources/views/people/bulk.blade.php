@extends('layouts.app')

@section('content')
    <div>
        <h3>Confirm Course Information</h3>
        <form>
            <table class="table table-bordered">

                <tr>
                    <th>First</th>
                    <th>Last</th>

                </tr>

                @foreach($rows as $row)
                    <tr>
                        @foreach($row as $col)
                            <td><textarea>{{ $col }}</textarea></td>
                        @endforeach
                    </tr>

                @endforeach

            </table>
            <button type="submit" class="btn btn-primary mb-2">Upload</button>
        </form>
    </div>
@endsection
