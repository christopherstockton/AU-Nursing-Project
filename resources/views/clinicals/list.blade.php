@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="mb-4 col-md-12">
    @if ($flag == 1)
      <a class="btn btn-primary" href="/clinicals/create">New Lab</a>
    @else
      <a class="btn btn-primary" href="/clinicals/create">New Clinical</a>
    @endif
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by Course Section #">
    </div>
    <div class="row">
      <table class="table table-striped table-hover" id="myTable2">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col" onclick="sortTable(0)">Course Section</th>
            <th scope="col" onclick="sortTable(1)">Course Name</th>
            <th scope="col" onclick="sortTable(2)">Instructor</th>
            @if ($flag == 0)
            <th scope="col" onclick="sortTable(3)">Site Name</th>
            @endif
            @if ($flag == 1)
            <th scope="col">Room Number</th>
            @endif
            <th scope="col">Capacity</th>
            <th scope="col">Time</th>
            <th scope="col">Dates</th>
          </tr>
        </thead>
        <tbody>

            @foreach ( $clinicals as $clinical)

            <tr>
              <th scope="row"> {{ $clinical->id}} </th>
              <td>{{ $clinical->CourseSection}}</td>
              <td>{{ $clinical->CourseName}}</td>
              <td>{{ $clinical->firstName}} {{ $clinical->lastName}}</td>
            @if ($flag == 0)
              <td>{{ $clinical->siteName}}</td>
            @endif
            @if ($flag == 1)
              <td>{{ $clinical->roomNumber}}</td>
            @endif
              <td>{{ $clinical->capacity}}</td>
              <td>{{ $clinical->startTime}} - {{ $clinical->endTime}}</td>
              <td>{{ $clinical->startDate}} - {{ $clinical->endDate}}</td>
              <td><a class="btn btn-primary" href="/clinicals/{{ $clinical->id}}" role="button">View</a>
            </tr>

            @endforeach

        </tbody>
    </table>
  </div>
</div>

<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable2");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc";
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}

function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable2");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

</script>

@endsection
