<div class="sidebar"  data-color="orange" data-background-color="white" data-image="{{ asset('Admin') }}/img/sidebar-1.jpg">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo" style="padding:0px !important;">
      <a href="https://creative-tim.com/" class="simple-text logo-normal">
        <img src="{{asset('images/final.png')}}" style="width:80px; height:80px;" />
      </a>
    </div>
    <div class="sidebar-wrapper" style="overflow: auto;">
      <ul class="nav">
        <li class="nav-item" >
          <a class="nav-link" href="{{ route('home') }}">
            <i class="material-icons">dashboard</i>
              <p>{{ __('Dashboard') }}</p>
          </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link collapsed" data-toggle="collapse" href="#laravelExample" aria-expanded="false">
            <i class="fa-regular fa-folder-open"></i>
            <p>{{ __('User Management') }}
              <b class="caret"></b>
            </p>
          </a>
          <div class="collapse " id="laravelExample">
            <ul class="nav">
              <li class="nav-item">
                <a class="nav-link" href="{{route('Users')}}">
                    <i class="fa-solid fa-users"></i>
                  <span class="sidebar-normal">{{ __('All Consumer') }} </span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('Providers')}}">
                    <i class="fa-solid fa-users"></i>
                  <span class="sidebar-normal">{{ __('All Provider') }} </span>
                </a>
              </li>
              <li class="nav-item"  >
                <a class="nav-link"  href="{{route('Roles')}}">
                    <i class="fa-solid fa-users"></i>
                  <span class="sidebar-normal">{{ __('Roles') }}</span>
                </a>
              </li>
              <li class="nav-item"  >
                <a class="nav-link"  href="{{route('Permission')}}">
                    <i class="fa-solid fa-users"></i>
                  <span class="sidebar-normal">{{ __('Permission') }}</span>
                </a>
              </li>



            </ul>
          </div>
        </li>
        <li class="nav-item ">
            <a class="nav-link collapsed" data-toggle="collapse" href="#laravelE" aria-expanded="false">
                <i class="fa-solid fa-truck-moving"></i>
              <p>{{ __('Consignment Management') }}
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="laravelE">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="{{url('consumerConsignment')}}">
                    <i class="fa-solid fa-truck-moving"></i>
                    <span class="sidebar-normal">{{ __('Consumer Consignment') }} </span>
                  </a>
                </li>
                <li class="nav-item"  >
                  <a class="nav-link" href="{{url('providerConsignment')}}">
                    <i class="fa-solid fa-truck-pickup"></i>
                    <span class="sidebar-normal">{{ __('Provider Consignmrnt') }}</span>
                  </a>
                </li>


              </ul>
            </div>
          </li>
         <li class="nav-item">
          <a class="nav-link" href="{{route('show.cms')}}">
            <i class="fa-solid fa-file"></i>
            <p>{{ __('Content Management') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('show.categories')}}">
            <i class="fa-regular fa-rectangle-list"></i>
              <p>{{ __('Bid Category') }}</p>
          </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{url('allpaper')}}">
              <i class="fa-regular fa-rectangle-list"></i>
                <p>{{ __('Paper') }}</p>
            </a>
          </li> --}}
        <li class="nav-item ">
            <a class="nav-link collapsed" data-toggle="collapse" href="#laravelExampl" aria-expanded="false">
                <i class="fa-solid fa-truck-moving"></i>
              <p>{{ __('Vehicle Management') }}
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="laravelExampl">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('show.vehicles')}}">
                    <i class="fa-solid fa-truck-moving"></i>
                    <span class="sidebar-normal">{{ __('Vehicle List') }} </span>
                  </a>
                </li>
                <li class="nav-item"  >
                  <a class="nav-link" href="{{route('show.size')}}">
                    <i class="fa-solid fa-truck-pickup"></i>
                    <span class="sidebar-normal">{{ __('Size List') }}</span>
                  </a>
                </li>


              </ul>
            </div>
          </li>
         <li class="nav-item">
          <a class="nav-link" href="{{route('show.cms')}}">
            <i class="fa-solid fa-file"></i>
            <p>{{ __('Content Management') }}</p>
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('show.flat')}}">
                <i class="fa-solid fa-house"></i>
              <p>{{ __('Manage Flat') }}</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link collapsed" data-toggle="collapse" href="#laravelExamp" aria-expanded="false">
                <i class="fa-solid fa-truck-moving"></i>
              <p>{{ __('Membership Management') }}
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="laravelExamp">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="{{url('allPlans')}}">
                    <i class="fa-solid fa-truck-moving"></i>
                    <span class="sidebar-normal">{{ __('Plan List') }} </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item ">
            <a class="nav-link collapsed" data-toggle="collapse" href="#larave" aria-expanded="false">
                <i class="fa-solid fa-truck-moving"></i>
              <p>{{ __('Transactions') }}
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="larave">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="{{url('ptransaction')}}">
                    <i class="fa-solid fa-truck-moving"></i>
                    <span class="sidebar-normal">{{ __('Provider') }} </span>
                  </a>
                </li>
                <li class="nav-item"  >
                  <a class="nav-link" href="{{url('ctransaction')}}">
                    <i class="fa-solid fa-truck-pickup"></i>
                    <span class="sidebar-normal">{{ __('Consumer') }}</span>
                  </a>
                </li>


              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('support')}}">
                <i class="fa-solid fa-circle-info"></i>
              <p>{{ __('User Query') }}</p>
            </a>
          </li>


        {{-- <li class="nav-item">
          <a class="nav-link" href="">
            <i class="material-icons">location_ons</i>
              <p>{{ __('Maps') }}</p>
          </a>
        </li> --}}
        {{-- {{ $activePage == 'notifications' ? ' active' : '' }} --}}
        {{-- <li class="nav-item">
          <a class="nav-link" href="">
            <i class="material-icons">notifications</i>
            <p>{{ __('Notifications') }}</p>
          </a>
        </li> --}}
        {{-- <li class="nav-item">
          <a class="nav-link" href="">
            <i class="material-icons">language</i>
            <p>{{ __('RTL Support') }}</p>
          </a>
        </li> --}}

      </ul>
    </div>
  </div>
