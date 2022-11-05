@extends('layouts.master', ['activePage' => 'news', 'titlePage' => "News Fetch"])
@section('content')
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <form method="post" action="{{route('submit.cms')}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                @csrf

               <div class="card">
                  <div class="card-header card-header-primary">
                     <h4 class="card-title">Add CMS</h4>
                     <p class="card-category">CMS</p>
                  </div>
                  <div class="card-body ">

                     <div class="row">
                        <label class="col-sm-2 col-form-label">Code</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <input class="form-control" name="code"  type="text" placeholder="code" value="" required="">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <input class="form-control" name="name"  type="text" placeholder="name" value="" required="">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <label class="col-sm-2 col-form-label">title</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <input class="form-control" name="title"  type="text" placeholder="title" value="" required="">
                           </div>
                        </div>
                     </div>

                      <div class="row">
                        <label class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <textarea  class="form-control" name="description" id="description" required="true" aria-required="true"></textarea>
                           </div>
                        </div>
                     </div>

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
<script type="text/javascript">

        CKEDITOR.replace( 'description' );
 </script>

@endsection
