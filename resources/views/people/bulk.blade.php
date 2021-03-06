@extends('layouts.app')

@section('content')

<div class="container">
  <div class=row>
    <div class="col-lg-6">
      <h2 class="mb-3">Confirm Student List</h2>
        <div>
            <form id="students" method="post" action="bulk/upload">
                @csrf
                <p>
                    Add To Class:
                    <select id="course" name="course" class="form-control">
                        @foreach ($courses as $course)
                        <option value="{{$course->id}}">{{$course->CourseSection}}</option>
                        @endforeach
                    </select>
                    <br>
                    <select id="course2" name="course2" class="form-control">
                        <option value="none"></option>
                        @foreach ($courses as $course)
                        <option value="{{$course->id}}">{{$course->CourseSection}}</option>
                        @endforeach
                    </select>
                    <br>
                    <select id="course3" name="course3" class="form-control">
                        <option value="none"></option>
                        @foreach ($courses as $course)
                        <option value="{{$course->id}}">{{$course->CourseSection}}</option>
                        @endforeach
                    </select>
                </p>
                <table id="table1" class="table table-bordered">

                    <tr>
                        <th>Ommit?</th>
                        <th>First Name</th>
                        <th>Last Name</th>

                    </tr>

                    @foreach($rows as $row)
                        <tr>
                        <td><input type="checkbox" class="checkbox" style="width: 30px; height: 30px;"/></td>
                            @foreach($row as $col)
                                <td><input value={{$col}} type="text" class="form-control"></td>
                            @endforeach
                        </tr>

                    @endforeach

                </table>
            </form>
            <button onclick="checkboxes()" class="btn btn-primary mb-2">Upload</button>
            <p class="text-success" id="results"></p>
          </div>
        @endsection
      </div>
    </div>
  </div>
</div>  

<script>

    function checkboxes() {
        
        //Reference the Table.
        var grid = document.getElementById("table1");
 
        //Reference the CheckBoxes in Table.
        var checkBoxes = grid.getElementsByClassName("checkbox");
        var names = [];

        //Loop through the CheckBoxes.
        for (var i = 0; i < checkBoxes.length; i++) {
            if (!checkBoxes[i].checked) {
                var row = checkBoxes[i].parentNode.parentNode;
                names.push(row.cells[1].children[0].value);
                names.push(row.cells[2].children[0].value);
            }
        }

        //get checkbox value
        var e = document.getElementById("course");
        var courseID = e.options[e.selectedIndex].value;
        var f = document.getElementById("course2");
        var courseID2 = f.options[f.selectedIndex].value;
        var g = document.getElementById("course3");
        var courseID3 = g.options[g.selectedIndex].value;

        //Display selected Row data in Alert Box.
        console.log(names);

        $.ajax({
            url:'bulk/upload',
            type: 'POST',
            //dataType:'json',
            //contentType: 'application/json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            //success: function(response){$('#results').replaceWith(response);},
            success: function(response){window.location.replace("/students")},
            error: function(response){$('#results').replaceWith(response);},

            data: {names : names, courseID : courseID, courseID2 : courseID2, courseID3 : courseID3}
        });
}

</script>
