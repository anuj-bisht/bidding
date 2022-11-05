@extends('layout.index')
@section('content')
<div class="container">
    {{-- <div >
        Create Bid
    </div> --}}
<div class="wrap-iten-in-cart">
    @if ($message = Session::get('bid_create'))
    <div class="alert alert-success alert-block">

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
    <div style="display:flex; justify-content:space-between;" >
    <h3 class="box-title pt-5">{{ __('My Bids')}}</h3>
    <h3 class="box-title pt-5"><a class="btn btn-primary"  href="{{route('create.bid')}}">{{ __('Create Bid')}}</a></h3>
    </div>


        <div class="row equal-container">
            @forelse($bid as $bids)
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="aboutus-box-score equal-elem " style="height: 219px;">
                    <b class="box-score-title">10</b>
                    <span class="sub-title">{{$bids->title}}</span>
                    <p class="desc">{{$bids->description}}</p>
                </div>
            </div>
            @empty
            "no data"
            @endforelse
        </div>


</div>
</div>

@endsection
