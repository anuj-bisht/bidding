
@extends('layouts.master', ['activePage' => 'users', 'titlePage' => "users"])
@section('title', 'Users')

@section('content')

<div class="content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">

                <div class="card card-chart">
                  <div class="card-header card-header-warning">
                    <div class="ct-chart">User Detail</div>
                  </div>
                  <div class="card-body">
                    <h4 class="card-title">Name:&nbsp;{{$data->name}}</h4>
                    <h4 class="card-title">Phone:&nbsp;{{$data->mobile}}</h4>
                    <h4 class="card-title">Email:&nbsp;{{$data->email}}</h4>
                  </div>
                  <div class="card-footer">

                  </div>
                </div>


          </div>
       </div>
    </div>
 </div>



  @endsection

