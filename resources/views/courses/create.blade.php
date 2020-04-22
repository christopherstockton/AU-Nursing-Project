@extends('layouts.app')

@section('content')

    <div class="container">
        <div class=row>
            <div class="col-lg-6">
                <h2 class="mb-3">New Course</h2>
                <form method='post' action='/courses'>
                    @csrf

                    <div class="form-group">
                        <label>Course Name<span style="color: red">*</span></label>
                        <input type="text" class="form-control @error('CourseName') is-invalid @enderror" name="CourseName">
                        @error('CourseName')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Course Section<span style="color: red">*</span></label>
                        <input type="text" class="form-control @error('CourseSection') is-invalid @enderror" name="CourseSection">
                        @error('CourseSection')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mb-2">Submit</button>

                </form>
            </div>
        </div>
    </div>

    <script>

        $( "#flag" ).change(function() {
            console.log($('#flag').val());

            if ( ($('#flag').val()) == 1 ) {
                $(".instructor").hide(1000);
            }
            else if ( ($('#flag').val()) == 0 ) {
                $(".instructor").show(1000);
            }


        });

    </script>

@endsection
