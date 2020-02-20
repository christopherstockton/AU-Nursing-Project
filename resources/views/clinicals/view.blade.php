@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title mb-4">
                        <div class="d-flex justify-content-start">
                            <div class="userData ml-3">
                                @if ($clinicals->flag == 0)
                                <h6 class="d-block">Type: <span class="flag">Clinical</span></h6>
                                @else
                                <h6 class="d-block">Type: <span class="flag">Lab</span></h6>
                                @endif
                                <h6 class="d-block">ID: {{$clinicals->id}}</h6>
                                <h6 class="d-block">Created: {{$clinicals->created_at}}</h6>
                                <h6 class="d-block">Updated: {{$clinicals->updated_at}}</h6>
                            </div>
                        </div>
                    </div>

                    <a class="btn btn-danger" href="/clinicals/delete/{{$clinicals->id}}">DELETE</a>
                    <a class="btn btn-primary" href="/clinicals/{{$clinicals->id}}/edit">EDIT</a>
                    <a class="btn btn-primary" href="/clinicals/">BACK</a>

                    <div class="row mt-3">
                        <div class="col-12">
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Course</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                        {{ $clinicals->CourseSection}} - {{ $clinicals->CourseName }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Instructor</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                        {{ $clinicals->firstName }} {{ $clinicals->lastName}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Site Address</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                        {{ $clinicals->address}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Room Number</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                        {{ $clinicals->roomNumber }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Capacity</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                        {{ $clinicals->capacity }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Day</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                        {{ $clinicals->days }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Times</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                        {{ $clinicals->startTime}} - {{ $clinicals->endTime}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Dates</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                        {{ $clinicals->startDate}} - {{ $clinicals->endDate}}
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

@endsection
