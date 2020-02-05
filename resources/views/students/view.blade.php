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
                                    <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold">{{$student->firstName}} {{$student->lastName}}</h2>
                                    <h6 class="d-block">ID: {{$student->studentID}}</h6>
                                    <h6 class="d-block">Created: {{$student->createdOn}}</h6>
                                </div>
                            </div>
                        </div>

                        <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="/students/delete/{{$student->studentID}}">DELETE</a>

                        <div class="row">
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

@endsection
