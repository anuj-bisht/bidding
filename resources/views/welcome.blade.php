
@extends('layout.index')
@section('content')
<div>
    <main id="main">
        <nav class="navbar navbar-light bg-primary">
            <div class="container-fluid">
              <form class="d-flex" style="width:800px;">
                <input class="form-control me-2" type="search" placeholder="Search Service for e.g Transport, Photographer" aria-label="Search">
                <button class="btn btn-outline-success text-white" type="submit">Search</button>
              </form>
            </div>
          </nav>


<div class="container">
    <h1 style="color:#22A7F0">Create A Bid for your Service</h1>

          <div class="row row-cols-1 row-cols-md-3 g-4 pt-5" >
            <div class="col">
              <div class="card h-100" style="box-shadow:2px 3px 3px grey; border-radius:20px;">
                <img src="{{asset('assets/images/home-1-banner-1.jpg')}}" class="card-img-top" alt="..." style="border-radius:10px;">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100">
                <img src="{{asset('assets/images/home-1-banner-1.jpg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">This is a short card.</p>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100">
                <img src="{{asset('assets/images/home-1-banner-1.jpg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100">
                <img src="{{asset('assets/images/home-1-banner-1.jpg')}}"class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
              </div>
            </div>
          </div>
        </div>












		<div class="container">

			<!--MAIN SLIDE-->
			
	</main>

</div>
@endsection
