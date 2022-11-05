@extends('layouts.master', ['activePage' => 'news', 'titlePage' => "News Fetch"])
@section('content')
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <form method="post" action="{{route('update.cms')}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                @csrf


               <div class="card">
                  <div class="card-header card-header-primary">
                     <h4 class="card-title">Add CMS</h4>
                     <p class="card-category">CMS</p>
                  </div>
                  <div class="card-body ">



                      <div class="row">
                        <label class="col-sm-2 col-form-label">Privacy Policy</label>
                        <div class="col-sm-9">
                           <div class="form-group bmd-form-group is-filled">
                              <textarea  class="form-control" name="privacy_policy" id="privacy_policy" required="true" aria-required="true"  >{!! $cms->privacy_policy !!}</textarea>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <label class="col-sm-2 col-form-label">FAQ</label>
                        <div class="col-sm-9">
                           <div class="form-group bmd-form-group is-filled">
                              <textarea  class="form-control" name="faq" id="faq" required="true" aria-required="true"  >{!! $cms->faq !!}</textarea>
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <label class="col-sm-2 col-form-label">Terms & Condition</label>
                        <div class="col-sm-9">
                           <div class="form-group bmd-form-group is-filled">
                              <textarea  class="form-control" name="terms_and_condition" id="terms_and_condition" required="true" aria-required="true"  >{!! $cms->terms_and_condition !!}</textarea>
                           </div>
                        </div>
                     </div>

                  </div>
                  <div class="card-footer ml-auto mr-auto">
                    <input class="form-control" name="id" value="{{$cms->id}}" type="hidden">
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

        CKEDITOR.replace( 'privacy_policy' );
        CKEDITOR.replace( 'faq' );
        CKEDITOR.replace( 'terms_and_condition' );

 </script>

@endsection
