@extends('layouts.master', ['activePage' => 'news', 'titlePage' => "News Fetch"])

@section('content')

<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">Plans</h4>
                <p class="card-category"> Here you can manage plans</p>
              </div>
              <div class="card-body">
                                <div class="row">
                  <div class="col-12 text-right">
                    <a href="{{url('createPlan')}}" class="btn btn-sm btn-primary">Add plan</a>

                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr><th>
                          Sno.
                      </th>
                      <th>
                        Name
                      </th>
                      <th>
                        Price
                      </th>
                      {{-- <th>
                        Days
                      </th> --}}
                      {{-- <th>
                        Image
                      </th> --}}
                      <th class="text-right">
                        Action
                      </th>

                    </tr></thead>
                    <tbody>
                        @forelse($plans as $plan)
                    <tr>
                          <td>
                            {{$loop->iteration}}
                          </td>
                          <td>
                            {{$plan->plan_name}}
                          </td>
                          <td>
                            {{$plan->plan_rate}}
                          </td>
                          {{-- <td>
                            {{$plan->days}}
                          </td> --}}

                          {{-- <td>
                            <img style="width:120px; height:120px; object-fit:contain;" src="{{$plan->image}}" alt="Image"/>
                          </td> --}}
                          <td class="td-actions text-right">
                             <a rel="tooltip" class="btn btn-success btn-link" href="{{url('editplan')}}/{{$plan->id}}" data-original-title="" title="">
                                <i class="material-icons">edit</i>
                                <div class="ripple-container"></div>
                              </a>
                              <a rel="tooltip" class="btn btn-success btn-link" href="{{url('deleteplan')}}/{{$plan->id}}" data-original-title="" title="">
                                <i class="material-icons">delete</i>
                                <div class="ripple-container"></div>
                              </a>
                            </td>

                            <td>

                                @if($plan->status==1)
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input  checked id="{{$plan->id}}no"  class="form-check-input {{$plan->id}}"  onclick='statusChange(this.id)' type="checkbox" value="">

                                        <span class="form-check-sign">
                                            <span class="check" style="top:6px;"></span>
                                        </span>
                                    </label>
                                </div>
                                @else
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox"   id="{{$plan->id}}yes" class="form-check-input {{$plan->id}}" onclick='statusChange(this.id)'>

                                        <span class="form-check-sign">
                                            <span class="check"  style="top:6px;"></span>
                                        </span>
                                    </label>
                                </div>
                                @endif
                               </td>
                        </tr>
                        @empty
                        <td>
                          No data
                          </td>
                        @endforelse
                                          </tbody>
                  </table>
                </div>
              </div>
            </div>

        </div>
      </div>
    </div>
  </div>


@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    function statusChange(id){

        // var categor_id= document.getElementById(id).className;

    var checkbox= document.getElementById(id);   //yes or no
    if(checkbox.checked == true)
        {
            value = 'yes';
        }
        else
        {
            value = 'no';

        }
    var pla_id= document.getElementById(id).className;  //user id
    var plan_id=pla_id.replace('form-check-input','');

    $.ajax({
         type:'GET',
         dataType:'JSON',
         url:'{{URL::to("planStatus")}}/'+plan_id+'/'+value,
         success:function(data){
             console.log(data);
         }
    });

    }
</script>
