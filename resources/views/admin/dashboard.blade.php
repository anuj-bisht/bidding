@extends('layouts.master', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="fa-solid fa-users"></i>
              </div>
              <p class="card-category">Consumer</p>
              <h3 class="card-title "><span class="counter">{{ConsumerCount()}}</span>

              </h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                  <i class="material-icons"></i> Total Consumers
                </div>
              </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="fa-solid fa-user"></i>
              </div>
              <p class="card-category">Provider</p>
              <h3 class="card-title"><span class="counter">{{ProviderCount()}}</span></h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons"></i> Total Providers

              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="fa-solid fa-car"></i>
              </div>
              <p class="card-category">Vehicle</p>
              <h3 class="card-title"><span class="counter">{{VehicleCount()}}</span></h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons"></i> Total Vehicles
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-header card-header-danger card-header-icon">
                <div class="card-icon">
                    <i class="fa-solid fa-coins"></i>
                </div>
                <p class="card-category">Consumer Sale</p>
                <h3 class="card-title"><span class="counter">{{ ConsumerTotalPayment()}}</span></h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="material-icons"></i> Consumer Total Sale
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-header card-header-danger card-header-icon">
                <div class="card-icon">
                    <i class="fa-solid fa-coins"></i>
                </div>
                <p class="card-category">Provider Sale</p>
                <h3 class="card-title"><span class="counter">{{ ProviderTotalPayment()}}</span></h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="material-icons"></i> Provider Total Sale
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-header card-header-danger card-header-icon">
                <div class="card-icon">
                    <i class="fa-solid fa-grid-horizontal"></i>
                </div>
                <p class="card-category">Consignments</p>
                <h3 class="card-title"><span class="counter">{{ TotalConsignment()}}</span></h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="material-icons"></i> Total Consignments
                </div>
              </div>
            </div>
          </div>
           <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-header card-header-danger card-header-icon">
                <div class="card-icon">
                    <i class="fa-solid fa-grid-horizontal"></i>
                </div>
                <p class="card-category">Total Bids</p>
                <h3 class="card-title"><span class="counter">{{ Totalbids()}}</span></h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="material-icons"></i> Total Bids
                </div>
              </div>
            </div>
          </div>
           <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-header card-header-danger card-header-icon">
                <div class="card-icon">
                  <i class="material-icons"></i>
                </div>
                <p class="card-category">Pend Cons.</p>
                <h3 class="card-title"><span class="counter">{{pendingConsignment()}}</span></h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="material-icons"></i> Pending Consignment
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-header card-header-danger card-header-icon">
                <div class="card-icon">
                  <i class="material-icons"></i>
                </div>
                <p class="card-category">Ingoing Cons.</p>
                <h3 class="card-title"><span class="counter">{{InprogressConsignment()}}</span></h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="material-icons"></i> Ingoing Consignment
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="row">
        <div class="col-md-8">
          <div class="card card-chart">

                <div id="piechart_3d" style=" height: 250px;"></div>


            <div class="card-body">
              <h4 class="card-title">Users Analytics</h4>
              <p class="card-category">
                <span class="text-success"><i class="fa fa-long-arrow-up"></i></span>Based On Roles</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> Update Daily
              </div>
            </div>
          </div>
        </div>
        {{-- <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-danger">
              <div class="ct-chart" id="completedTasksChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Completed Tasks</h4>
              <p class="card-category">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div>
            </div>
          </div>
        </div> --}}
      </div>
    </div>
  </div>


@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/counterup2/2.0.2/index.js"></script>

<script>
  	jQuery(function ($) {
		'use strict';
		var counterUp = window.counterUp['default']; // import counterUp from "counterup2"
		var $counters = $('.counter');
		/* Start counting, do this on DOM ready or with Waypoints. */
		$counters.each(function (ignore, counter) {
			var waypoint = new Waypoint({
				element: $(this),
				handler: function () {
					counterUp(counter, {
                        delay: 10,
    time: 1000
					});


					this.destroy();
				},
				offset: 'bottom-in-view',
			});
		});
	});

</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['User', 'Count'],
            ['Admin', 1],
            ['Consumer', {{ConsumerCount()}}],
            ['Provider', {{ProviderCount()}}],
          ]);

          var options = {
            title: 'Total Users Based On Roles',
            pieSliceText: 'value',
            is3D: true,
            tooltip:{
              text: 'value'
            }
          };

          var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
          chart.draw(data, options);
        }
      </script>
{{-- @push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
    $('.counter').counterUp();
  </script>
@endpush --}}





