@extends('layouts/contentNavbarLayout')

@section('title', 'Add New Tenant - ')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
    <div class="row">     
            <div class="col-md-12">
                <div class="card  p-1">
                    <div class="card-header">
                        <div class="card-title"><h4>List of All Tenants</h4></div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 550px; overflow-y: auto; height: 550px;">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th>Name</th>
                                  <th>Branch</th>
                                  <th>Phone Number</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>

                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ ucwords($user->full_name) }}                                        </td>
                                        <td>{{$user->branch}}</td>
                                        <td>{{$user->phone_number}}</td>
                                        <td class="align-items-start">
                                            <a class="btn btn-primary" href="{{ url('user/' . $user->id . '/edit') }}"><i class="bx bx-edit-alt me-2"></i>Edit</a>
                                            <a class="btn btn-danger" onclick="deleteTenant({{$user->id}})" data-id="{{$user->id}}" href="#"><i class="bx bx-trash me-2"></i>Delete</a>

                                        </td>
                                    </tr>
                                    @endforeach                               
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>

    function deleteTenant(userId) {
        swal({
            title: "Delete Tenant?",
            text: "Once deleted, you will not be able to restore this tenant",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
        if (willDelete) {
                fetch('/tenants/'+userId, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
                    }).then(response => {
                        console.log(response);
                        swal({
                        title: "Deleted Tenant",
                        text: "You will be redirected to your dashboard.",
                        icon: "success",
                        button: "OK",
                    }).then(() => {
                        window.location.href = "/";
                    });
                });
            }
        });
    }
    
    
    </script>