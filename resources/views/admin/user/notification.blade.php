
@extends('layouts.master', ['activePage' => 'users', 'titlePage' => "users"])
@section('title', 'Users')

@section('content')

<div class="content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
             <div class="card">
                <div class="card-header card-header-primary">
                   <h4 class="card-title ">Users</h4>
                   <p class="card-category"> Here you can manage users</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="pull-left">
                                <h2>&nbsp;</h2>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-primary" href=""> Send Notification to All</a>
                            </div>
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-sm-7">
                          <form method="post" action="{{ route('sendNotificationUser') }}">


                           {{ csrf_field() }}
                               <div class="form-group">



                                   <div class="row">
                                    <label class="col-sm-2 col-form-label">User Notification(select one):</label>
                                    <div class="col-sm-7">
                                        <select multiple class="form-control" id="sel2" name="name[]" required="required" style="height:70px;">
                                            <option selected disabled>Select User</option>
                                            @foreach($user as $data)

                                 <option value="{{$data->id}}">{{$data->name}}</option>

                                  @endforeach
                                    </select>
                                  </div>
                                </div>






                            <div class="row">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-7">
                                   <div class="form-group bmd-form-group is-filled">
                                      <input class="form-control" name="title"  type="text" placeholder="name" value="" required="">
                                   </div>
                                </div>
                             </div>

                             <div class="row">
                                <label class="col-sm-2 col-form-label">Mesagage</label>
                                <div class="col-sm-7">
                                    <textarea id="form7" name="message" class="md-textarea form-control" rows="3"></textarea>

                                </div>
                             </div>

                               </div>
                               <button type="submit" class="btn btn-primary">Send Notification</button>
                          </form>
                        </div>
                        </div>



             </div>

          </div>
       </div>
    </div>
 </div>



  @endsection

