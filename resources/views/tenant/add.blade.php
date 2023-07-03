@extends('layouts/contentNavbarLayout')

@section('title', 'Add New Tenant - ')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
    <div class="row">

            <div class="col-md-8">
                <div class="card p-1">
                    <div class="card-header">
                        <h4 class="card-title">Add New Tenant Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                            </div>
                        </div>
                        <form action="{{route('tenants.store')}}" method="POST">
                            @csrf
    
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="tenant-name" class="">Store Name</label>
                                    <input type="text" name="store_name" id="store-name" class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="tenant-name" class="">Branch</label>
                                    <select name="branch" id="" class="form-select" required>
                                        <option value="" selected disabled>Select Branch</option>
                                        <option value="Jacinto Ignacio Market">Jacinto Ignacio Market</option>
                                        <option value="Jacinto Market">Jacinto Market</option>
                                        <option value="House of Saint">House of Saint</option>
                                        <option value="Other businesses">Other businesses</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="tenant-name" class="">First Name of Tenant</label>
                                    <input type="text" name="first_name" id="last-name" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="tenant-name" class="">Last Name of Tenant</label>
                                    <input type="text" name="last_name" id="last-name" class="form-control" required>
                                </div>
                            </div>


                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="tenant-name" class="">Sex / Gender</label>
                                    <select name="sex" id="" class="form-select" required>
                                        <option value="" selected disabled>Select Sex / Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="tenant-name" class="">Phone number of Tenant</label>
                                    <input type="number" name="phone" id="phone" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="tenant-name" class="">Address</label>
                                    <input type="text" name="address" id="address" class="form-control" required>
                                </div>
                            </div>
                                
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label for="tenant-name" class="">Utilities</label>
                                    <div class="mt-2">
                                        <input class="form-check-input" name="utility[]" type="checkbox" value="Water"/>
                                        <label class="form-check-label">Water</label>
    
                                        <input style="margin-left:15px;" name="utility[]" class="form-check-input mr-2" type="checkbox" value="Electricity"/>
                                        <label class="form-check-label">Electricity</label>
                                    </div>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="tenant-name" class="">Mode of Payment</label>
                                    <select name="mop" id="" class="form-select" required>
                                        <option value="" selected disabled>Select Mode of Payment</option>
                                        <option value="Gcash">Gcash</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Credit Card">Credit Card</option>
                                    </select>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="tenant-name" class="">Amount Paid</label>
                                    <input type="number" name="amount" id="amount" class="form-control" required>
                                </div>
                            </div>
    
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label for="tenant-name" class="">Date</label>
                                    <input class="form-control" type="date" id="html5-date-input"name="date" required/>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="tenant-name" class="">Time</label>
                                    <input class="form-control" type="time" value="12:30:00" id="html5-time-input" name="time" />
                                </div>

                                <div class="col-md-4 d-grid">
                                    <button class="btn btn-primary mt-4" type="submit">Add New Tenant</button>
                                </div>
                            </div>
                            <div class="mt-3 text-end">
                                
                            </div>
    
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card  p-1">
                    <div class="card-header">
                        <div class="card-title"><h4>List of Tenants</h4></div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th>Name</th>
                                  <th>Branch</th>
                                </tr>
                              </thead>
                              <tbody>

                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ ucwords($user->full_name) }}                                        </td>
                                        <td>{{$user->branch}}</td>
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
