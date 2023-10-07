@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - ')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')

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

<div class="row mt-5">
    <div class="col-lg-12 text-center">
        <h1><span class="text-primary">Payments</span> Records</h1>
        <h2><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newPayment">New Cash Payment</button></h2>

        <div class="row" style="margin-top:100px;">
            <h3>Select an Option to View Records</h3> 
        </div>
        <div class="row d-flex justify-content-center">
            
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header">View By Date</h3>
                    <div class="card-body">
                        <button class="btn btn-warning btn-lg" data-bs-toggle="modal" data-bs-target="#byDate">Select Date</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header">View By Month</h3>
                    <div class="card-body">
                        <button class="btn btn-warning btn-lg" data-bs-toggle="modal" data-bs-target="#byMonth">Select Month</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal By Date Report -->
<div class="modal fade" id="byDate" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">

        <form class="modal-content" action="{{route('admin.paymentsResult')}}" method="get">

            @csrf
            @method('GET')
            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">Select Date of Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <div class="row">

                            <label for="nameBackdrop" class="form-label">Select Date</label>
                            <input type="date" name="date" class="form-control">
    
                            <label for="nameBackdrop" class="form-label mt-3">Select Branch</label>
                            <select name="branch" id="branch" class="form-control" required>
                                <option value="" selected disabled>Select An Option</option>
                                <option value="Jacinto Ignacio Market">Jacinto Ignacio Market</option>
                                <option value="Jacinto Market">Jacinto Market</option>
                                <option value="House of Saint">House of Saint</option>
                            </select>

                            <input type="text" hidden name="type" value="byDate">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal By Month Report -->
<div class="modal fade" id="byMonth" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="{{route('admin.paymentsResult')}}" method="get">

            @csrf
            @method('GET')
            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">Select Date of Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <div class="row">

                            <label for="nameBackdrop" class="form-label">Select Month</label>
                            <input type="month" name="date" class="form-control">
    
                            <label for="nameBackdrop" class="form-label mt-3">Select Branch</label>
                            <select name="branch" id="branch" class="form-control" required>
                                <option value="" selected disabled>Select An Option</option>
                                <option value="Jacinto Ignacio Market">Jacinto Ignacio Market</option>
                                <option value="Jacinto Market">Jacinto Market</option>
                                <option value="House of Saint">House of Saint</option>
                            </select>

                            <input type="text" hidden name="type" value="byMonth">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Payment-->
<div class="modal fade" id="newPayment" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="{{route('payments.store')}}" method="POST">
            @csrf

            <div class="modal-header">
            <h5 class="modal-title" id="backDropModalTitle">You Are Adding New Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">Name</label>
                        <input type="text" name="request" id="request" value="payment" hidden>
                        
                        <input type="text" list="tenants" name="tenants" class="form-control" required>
                        <datalist id="tenants">
                            @foreach($tenants as $tenant)
                                <option value="{{ ucwords($tenant->store_name) }} - {{ ucwords($tenant->branch) }}" class="dropdown-item"></option>
                            @endforeach
                        </datalist>

                        <br>

                        <span>Is this a Payment or Pass? Please double check your input.</span>
                        <select name="option" id="option" class="form-control" required>
                            <option value="" selected disabled>Select An Option</option>
                            <option value="Payment">Payment</option>
                            <option value="Pass">Pass</option>
                        </select>
                        
                        <br>
                        <label for="nameBackdrop" class="form-label">Date of Transaction</label>
                        <input type="date" name="date" id="date" class="form-control">
                        {{-- <input type="text" id="nameBackdrop" class="form-control"> --}}
                    </div>
                </div>
                <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>



@endsection
