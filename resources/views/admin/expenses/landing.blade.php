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
        <h1><span class="text-primary">Expense</span> Records</h1>
        <h2><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newExpenses">New Expenses</button></h2>

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

        <form class="modal-content" action="{{route('admin.expensesResult')}}" method="get">

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
                                <option value="Other Business">Other Business</option>
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
        <form class="modal-content" action="{{route('admin.expensesResult')}}" method="get">

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
                                <option value="Other Business">Other Business</option>
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

<!-- Modal Expenses-->
<div class="modal fade" id="newExpenses" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="{{route('expenses.store')}}" method="POST">
            @csrf

            <div class="modal-header">
            <h5 class="modal-title" id="backDropModalTitle">You Are Adding New Expenses</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <label for="nameBackdrop" class="form-label">Select Branch</label>
                    <select name="branch" class="form-select">
                        <option value="#" selected disabled>Select an option</option>
                        <option value="Jacinto Ignacio Market">Jacinto Ignacio Market</option>
                        <option value="Jacinto Market">Jacinto Market</option>
                        <option value="House of Saint">House of Saint</option>
                        <option value="Other Business">Other Business</option>
                    </select>
                    
                    <label for="nameBackdrop" class="form-label mt-3">Select Expenses</label>
                    <select id="dropdown" name="choice_1" class="form-select" onchange="showDropdown(this.value)">
                        <option value="#" selected disabled>Select an option</option>
                        <option value="Operating Expense">Operating Expense</option>
                        <option value="Personal Expense">Personal Expense</option>
                        <option value="Cash Deposit">Cash Deposit</option>
                    </select>
                
                    <div id="dropdown-container">
                        <!-- Dropdown content will be displayed here -->
                    </div>

                    <label for="nameBackdrop" class="form-label mt-3">Amount</label>
                    <input type="number" name="amount" class="form-control" required>

                    <label for="date" class="form-label mt-3">Select Date of Transaction</label>
                    <input class="form-control" type="date" name="date" value="{{ date ('Y-m-d')}}" required/>

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

<script>
    function showDropdown(selectedOption) {
        const container = document.getElementById('dropdown-container');
        container.innerHTML = ''; // Clear previous dropdown content

        if (selectedOption === 'Operating Expense') {
            container.innerHTML = `
                <label for="tenant-name" class="form-label mt-3">Select Options for Operating Expense</label>
                <select name="choice_2" class="form-select mt-2" required>
                    <option value="" selected disabled>Select an Option</option>
                    <option value="Wages">Wages</option>
                    <option value="Power">Power</option>
                    <option value="Water">Water</option>
                    <option value="Internet">Internet</option>
                    <option value="Repair & Maintenance">Repair & Maintenance</option>
                    <option value="Travel & Transportation">Travel & Transportation</option>
                    <option value="Taxes & Licenses">Taxes & Licenses</option>
                </select>
            `;
        } else if (selectedOption === 'Personal Expense') {
            container.innerHTML = `
                <label for="tenant-name" class="form-label mt-3">Select Options for Personal Expense</label>
                <select name="choice_2" class="form-select" required>
                    <option value="" selected disabled>Select an Option</option>
                    <option value="Credit Card Payment">Credit Card Payment</option>
                    <option value="Medicine">Medicine</option>
                    <option value="Food & Beverages">Food & Beverages</option>
                    <option value="Monetary Assistance">Monetary Assistance</option>
                </select>
            `;
        }else{
            container.innerHTML = `
                <label for="tenant-name" class="form-label mt-3">Select Options for Cash Deposit</label>
                <select name="choice_2" class="form-select" required>
                    <option value="" selected disabled>Select an Option</option>
                    <option value="Banks">Banks</option>
                    <option value="SVCC">SVCC</option>
                </select>
            `;
        }
    }
</script>
