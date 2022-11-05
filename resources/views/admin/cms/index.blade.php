@extends('layouts.master', ['activePage' => 'news', 'titlePage' => "News Fetch"])
@section('content')
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header card-header-primary">
                  <h4 class="card-title ">Content Management System</h4>
                  <p class="card-category"> Here you can manage CMS</p>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-12 text-right">
                        <a href="{{route('create.cms')}}" class="btn btn-sm btn-primary">Add CMS</a>
                     </div>
                  </div>
                  <div class="table-responsive">
                     <table class="table">
                        <thead class=" text-primary">
                           <tr>
                              <th>
                                 Sno.
                              </th>
                              <th>
                                 Privacy Policy
                              </th>
                              <th>
                                FAQ
                             </th>
                              <th>
                                Terms & Condition
                             </th>
                              <th class="text-right">
                                 Action
                              </th>
                           </tr>
                        </thead>
                        <tbody>
                           @forelse($data as $crm)
                           <tr>
                              <td>
                                 {{$loop->iteration}}
                              </td>
                              <td>
                                 {!! Str::limit($crm->terms_and_condition,200,'...') !!}

                              </td>
			      <td>
                                 {!! Str::limit($crm->faq,200,'...') !!}

                              </td>

                              <td>
                                {!! Str::limit($crm->privacy_policy,200, '...')!!}
                             </td>

                              <td class="td-actions text-right">
                                <a rel="tooltip" class="btn btn-success btn-link" href="{{url('editcms')}}/{{$crm->id}}" data-original-title="" title="">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                 </a>
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
