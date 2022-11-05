@extends('layouts.master', ['activePage' => 'news', 'titlePage' => "News Fetch"])

@section('content')

<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">Categories</h4>
                <p class="card-category"> Here you can manage categories</p>
              </div>
              <div class="card-body">
                                <div class="row">
                  {{-- <div class="col-12 text-right">
                    <a href="{{route('add.categories')}}" class="btn btn-sm btn-primary">Add category</a>

                  </div> --}}
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr><th>
                          Sno.
                      </th>
                      <th>
                        Category Name
                      </th>
                      <th>
                        Icon
                      </th>
                      <th class="text-right">
                        Action
                      </th>

                    </tr></thead>
                    <tbody>
                        @forelse($categories as $category)
                    <tr>
                          <td>
                            {{$loop->iteration}}
                          </td>
                          <td>
                            {{$category->category}}
                          </td>

                          <td>
                            <img style="width:120px; height:120px; object-fit:contain;" src={{$category->icon}} alt="Image"/>
                          </td>
                          <td class="td-actions text-right">
                             <a rel="tooltip" class="btn btn-success btn-link" href="{{url('editcategories')}}/{{$category->id}}" data-original-title="" title="">
                                <i class="material-icons">edit</i>
                                <div class="ripple-container"></div>
                              </a>
                            </td>

                            <td>

                                @if($category->status==1)
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input  checked id="{{$category->id}}no"  value="{{$category->id}}" class="form-check-input {{$category->id}}"  onclick='statusChange(this.id)' type="checkbox" value="">

                                        <span class="form-check-sign">
                                            <span class="check" style="top:6px;"></span>
                                        </span>
                                    </label>
                                </div>
                                @else
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" value="{{$category->id}}"  id="{{$category->id}}yes" class="form-check-input {{$category->id}}" onclick='statusChange(this.id)'>

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
          var o =document.getElementById(id).value;
alert(o);
        var base_url = window.location.origin;

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
    var categor_id= document.getElementById(id).className;  //user id
    var category_id=categor_id.replace('form-check-input','');

    $.ajax({
         type:'GET',
         dataType:'JSON',

        url:'{{URL::to('categoryStatus')}}'+'/'+o+'/'+value,
         success:function(data){
             console.log(data);
         }
    });

    }
</script>
