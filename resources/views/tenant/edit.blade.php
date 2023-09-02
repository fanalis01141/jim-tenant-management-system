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
                        <form action="{{route('tenants.update', $tenant->id)}}" method="POST">
                            @method('PUT')
                            @csrf
    
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="tenant-name" class="">Store Name</label>
                                    <input type="text" name="store_name" id="store-name" class="form-control" required value="{{$tenant->store_name}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="tenant-name" class="">Branch</label>
                                    <select name="branch" id="" class="form-select" required>
                                        <option value="" selected disabled>Select Branch</option>
                                        <option value="Jacinto Ignacio Market" {{ $tenant->branch === 'Jacinto Ignacio Market' ? 'selected' : '' }}>Jacinto Ignacio Market</option>
                                        <option value="Jacinto Market" {{ $tenant->branch === 'Jacinto Market' ? 'selected' : '' }}>Jacinto Market</option>
                                        <option value="House of Saint" {{ $tenant->branch === 'House of Saint' ? 'selected' : '' }}>House of Saint</option>
                                        <option value="Other businesses" {{ $tenant->branch === 'Other businesses' ? 'selected' : '' }}>Other businesses</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="tenant-name" class="">First Name of Tenant</label>
                                    <input type="text" name="first_name" id="last-name" class="form-control" required value="{{$tenantData->get('firstName')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="tenant-name" class="">Last Name of Tenant</label>
                                    <input type="text" name="last_name" id="last-name" class="form-control" required value="{{$tenantData->get('lastName')}}">
                                </div>
                            </div>


                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="tenant-name" class="">Sex / Gender</label>
                                    <select name="sex" id="" class="form-select" required>
                                        <option value="" selected disabled>Select Sex / Gender</option>
                                        <option value="Male" {{ $tenant->sex === 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ $tenant->sex === 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ $tenant->sex === 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="tenant-name" class="">Phone number of Tenant</label>
                                    <input type="number" name="phone" id="phone" class="form-control" required value="{{$tenant->phone_number}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="tenant-name" class="">Address</label>
                                    <input type="text" name="address" id="address" class="form-control" required value="{{$tenant->complete_address}}">
                                </div>
                            </div>
                                
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label for="tenant-name" class="">Utilities</label>
                                    <div class="mt-2">
                                        <input class="form-check-input" name="utility[]" type="checkbox" value="Water" value="Water" {{ is_array($decodedUtility) && in_array('Water', $decodedUtility) ? 'checked' : '' }}/>
                                        <label class="form-check-label">Water</label>
    
                                        <input style="margin-left:15px;" name="utility[]" class="form-check-input mr-2" type="checkbox" value="Electricity" value="Water" {{ is_array($decodedUtility) && in_array('Electricity', $decodedUtility) ? 'checked' : '' }}/>
                                        <label class="form-check-label">Electricity</label>
                                    </div>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="tenant-name" class="">Mode of Payment</label>
                                    <select name="mop" id="" class="form-select" required>
                                        <option value="" selected disabled>Select Mode of Payment</option>
                                        <option value="Gcash" {{ $tenant->mode_of_payment === 'Gcash' ? 'selected' : '' }}>Gcash</option>
                                        <option value="Cash" {{ $tenant->mode_of_payment === 'Cash' ? 'selected' : '' }}>Cash</option>
                                        <option value="Credit Card" {{ $tenant->mode_of_payment === 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                                    </select>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="tenant-name" class="">Amount Paid</label>
                                    <input type="number" name="amount" id="amount" class="form-control" required value="{{ $tenant->amount_of_payment}}">
                                </div>
                            </div>
    
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    {{-- <label for="tenant-name" class="">Date</label>
                                    <input class="form-control" type="date" id="html5-date-input" name="date" required value="{{ $tenant->start_date }}"/> --}}
                                </div>
    
                                <div class="col-md-4">
                                    {{-- <label for="tenant-name" class="">Time</label>
                                    <input class="form-control" type="time" value="12:30:00" id="html5-time-input" name="time" value="{{ $tenant->start_time }}" required/> --}}
                                </div>

                                <div class="col-md-4 d-grid">
                                    <button class="btn btn-primary mt-4" type="submit">Update Tenant Details</button>
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
                        <div class="card-title"><h4>Quick View of Tenants</h4></div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto; height: 400px;">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th>Name</th>
                                  <th>Branch</th>
                                </tr>
                              </thead>
                              <tbody>

                                    @foreach ($tenants as $tenant)
                                    <tr>
                                        <td>{{ ucwords($tenant->full_name) }}                                        </td>
                                        <td>{{$tenant->branch}}</td>
                                    </tr>
                                    @endforeach                               
                              </tbody>
                            </table>
                        </div>
                        <a href="/tenants" class="btn btn-primary mb-4">View All Tenants</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
