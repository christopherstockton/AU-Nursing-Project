@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title mb-4">
                        <div class="d-flex justify-content-start">
                            <div class="image-container">
                                <img src="http://placehold.it/150x150" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />
                                <div class="middle">
                                </div>
                            </div>
                            <div class="userData ml-3">
                                <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold">{{$people->firstName}} {{$people->lastName}}</h2>
                                @if ($people->flag == 0)
                                <h6 class="d-block">Type: <span class="flag">Instructor</span></h6>
                                @else
                                <h6 class="d-block">Type: <span class="flag">Student</span></h6>
                                @endif
                                <h6 class="d-block">ID: {{$people->id}}</h6>
                                <h6 class="d-block">Created: {{$people->created_at}}</h6>
                                <h6 class="d-block">Updated: {{$people->updated_at}}</h6>
                            </div>
                        </div>
                    </div>

                    <a class="btn btn-danger" href="/people/delete/{{$people->id}}">DELETE</a>
                    <a class="btn btn-primary" href="/people/{{$people->id}}/edit">EDIT</a>

                    <div class="row mt-3">
                        <div class="col-12">


                                @if ($people->flag == 0)
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Email</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{ $people->emailAddress }}
                                        </div>
                                    </div>
                                    <hr />

                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Phone</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{ $people->phoneNumber }}
                                        </div>
                                    </div>
                                    <hr />
                                @endif
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Notes</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                        @if ($people->notes == NULL)
                                        N/A
                                        @else
                                            {{ $people->notes}}
                                        @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="connectedServices" role="tabpanel" aria-labelledby="ConnectedServices-tab">
                                    Facebook, Google, Twitter Account that are connected to this account
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>

<script>

  $(document).ready(function(){
    if ( ($(".flag").text()) === "1") {
      $(".flag").text("Student");
    }
    else if ( ($(".flag").text()) === "0") {
      $(".flag").text("Instructor");
    }
  });
</script>


@endsection
