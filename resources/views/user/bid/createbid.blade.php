@extends('layout.index')
@section('content')
<div class="container">


    <div class="row pt-5">
        <div class=" main-content-area">
            <div class="wrap-contacts ">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="contact-box contact-form">
                        <h2 class="box-title">Create Bid</h2>
                        <form action="{{route('submit.bid')}}" method="post" >
@csrf
                            <label for="name">Category<span>*</span></label>

                            <select class="form-control form-control-sm pt-2" name="category">
                                <option>select Category</option>
                                @foreach($category as $categories)
                                <option value="{{$categories->id}}">{{$categories->category}}</option>
                                @endforeach

                              </select>
                            <label class="pt-3" for="source">Source<span>*</span></label>
                            <input type="text"  id="source" name="source">

                            <label for="destination">Destination</label>
                            <input type="text"  name="destination">

                            <label class="pt-3 " style="padding-bottom: 3px;" for="Bid End Date">Bid End Date</label>
                            <input type="datetime-local" name="bid_end_date" class="form-control " />

                            <label  class="pt-3 " style="padding-bottom: 3px;" for="Service Start Date">Service Start Date</label>
                            <input type="datetime-local" name="service_start_date" class="form-control "/>

                            <label class="pt-4" for="title">Title</label>
                            <input type="text"  name="title">

                            <label for="description">Description</label>
                            <input type="text" name="description" />

                            <input type="submit"  value="Submit">

                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="contact-box contact-info">
                        <div class="wrap-map">
                           kkk
                        </div>
                        <h2 class="box-title">Contact Detail</h2>
                        <div class="wrap-icon-box">

                            <div class="icon-box-item">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <div class="right-info">
                                    <b>Email</b>
                                    <p>Support1@Mercado.com</p>
                                </div>
                            </div>

                            <div class="icon-box-item">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <div class="right-info">
                                    <b>Phone</b>
                                    <p>0123-465-789-111</p>
                                </div>
                            </div>

                            <div class="icon-box-item">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <div class="right-info">
                                    <b>Mail Office</b>
                                    <p>Sed ut perspiciatis unde omnis<br>Street Name, Los Angeles</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div><!--end main products area-->

    </div>




</div>
@endsection
