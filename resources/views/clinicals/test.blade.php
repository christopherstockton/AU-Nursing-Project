<div style="column-count: 4">
    @foreach ($courses as $course)
        @foreach ($clinicals->retrieveClinicals($course->id) as $clinical)
            <h3>{{$clinical->CourseSection}}-0{{$clinical->section}}</h3>
            @foreach ($assignments->retrieveStudents($clinical->id) as $assignment)
                {{$assignment->firstName}} {{$assignment->lastName}}<br>
            @endforeach
        @endforeach
    @endforeach
</div>