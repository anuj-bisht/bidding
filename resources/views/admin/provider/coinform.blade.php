@extends('layouts.master', ['activePage' => 'news', 'titlePage' => "News Fetch"])
@section('content')
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <form method="post" action="{{url('submitcoin')}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                @csrf

               <div class="card">
                  <div class="card-header card-header-primary">
                     <h4 class="card-title">Add Coin</h4>
                     <p class="card-category">Coin</p>
                  </div>
                  <div class="card-body ">

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Wallet Coins</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <input class="form-control" value="{{$coins}}" readonly>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <label class="col-sm-2 col-form-label">Add coin</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <input class="form-control" name="coin"  type="text" placeholder="coins"  required="">
                           </div>
                        </div>
                     </div>


                     <input type="hidden" name="id" value="{{$id}}"/>
                  </div>
                  <div class="card-footer ml-auto mr-auto">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>


@endsection
