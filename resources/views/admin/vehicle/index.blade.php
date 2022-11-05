@extends('layouts.master', ['activePage' => 'users', 'titlePage' => "users"])
@section('title', 'Users')

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Vehicles</h4>
                            <p class="card-category"> Here you can manage vehicle</p>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12" style="display:flex; justify-content:space-between;">
                                    <abbr title="Export Vehicle">
                                        <a href="{{url('vehicleExport')}}"
                                                                    class="btn btn-sm btn-primary">Export</a>

                                    </abbr>
                                    <form action="{{ route('show.vehicles') }}" method="get">
                                        <select name="vehicleFilter" id="" class="form-input">
                                            @foreach($category as $c)
                                                <option value="{{ $c->id }}" {{ request()->vehicleFilter == $c->id ? 'selected':'' }} >{{ $c->category }}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-submit">Filter</button>
                                    </form>
                                    <a href="{{route('create.vehicle')}}" class="btn btn-sm btn-primary">Add Vehicle</a>
                                </div>
                                {{-- <div class="col-12 text-right">
                           <a href="{{route('create.vehicle')}}" class="btn btn-sm btn-primary">Add Vehicle</a>
                        </div> --}}
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <tr>
                                        <th>Sno.</th>
                                        <th>Name</th>

                                        <th>Vehicle Image</th>
                                        <th>Vehicle Category</th>

                                        <th class="text-right">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($vehicle as $vehicles)
                                        <tr>
                                            <td>
                                                {{$loop->iteration}}
                                            </td>
                                            <td>
                                                {{$vehicles->name}}
                                            </td>
                                            <td>
                                                <img style="width:120px; height:120px; object-fit:contain;"
                                                     src={{$vehicles->vehicle_icon}} alt="Image"/>
                                            </td>
                                            <td>
                                                {{ $vehicles->category }}
                                            </td>
                                            <td class="td-actions text-right">
                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                   href="{{url('editvehicle')}}/{{$vehicles->id}}"
                                                   data-original-title="" title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                   href="{{url('deletevehicle')}}/{{$vehicles->id}}"
                                                   data-original-title="" title="">
                                                    <i class="material-icons">delete</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                            </td>

                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                <span style="font-size:18px;">
                                <b> </b>No Users Found!</span>
                                        </div>
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

