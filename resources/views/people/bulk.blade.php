@extends('layouts.app')

@section('content')

<div class="container">
  <div class=row>
    <div class="col-lg-6">
      <h2 class="mb-3">Confirm Student List</h2>
        <div>
            <form>
                <p>
                    Add To Class:
                    <select id="course" name="course" class="form-control">
                        @foreach ($courses as $course)
                        <option value="{{$course->id}}">{{$course->CourseSection}}</option>
                        @endforeach
                    </select>
                </p>
                <table class="table table-bordered">

                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>

                    </tr>

                    @foreach($rows as $row)
                        <tr>
                            @foreach($row as $col)
                                <td><input value={{$col}} type="text" class="form-control"></td>
                            @endforeach
                        </tr>

                    @endforeach

                </table>
                <button type="submit" class="btn btn-primary mb-2">Upload</button>
            </form>
          </div>
        @endsection
      </div>
    </div>
  </div>
</div>
