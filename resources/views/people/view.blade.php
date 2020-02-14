@extends('layout')

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
                                <h6 class="d-block">Type: <span class="flag">{{$people->flag}}</span></h6>
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


                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Something</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            Something
                                        </div>
                                    </div>
                                    <hr />

                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Something</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            Something
                                        </div>
                                    </div>
                                    <hr />


                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Something</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            Something
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Something</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            Something
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Something</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            Something
                                        </div>
                                    </div>
                                    <hr />

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
