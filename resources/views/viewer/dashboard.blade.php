@extends('layouts/blankLayout')

@section('title', 'Encoder Dashboard')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')



<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-end">
            
            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            @endauth
        </div>

        <div class="row mt-4 mb-4 text-center">
            <h1>Welcome to Your Dashboard, <span class="text-primary text-bold">{{Auth::user()->name}}</span></h1>

            <h3>View Report</h3>
            
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#byDate">View by Date</button>
                <button class="btn btn-warning mt-3" data-bs-toggle="modal" data-bs-target="#byMonth">View by Month</button>
        </div>
    </div>

<!-- Modal By Month Report -->
<div class="modal fade" id="byMonth" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="{{route('reports.monthly')}}" method="GET">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">Select Month of Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <div class="row">
                            <label for="nameBackdrop" class="form-label">Select Month</label>
                            <input type="month" name="month" class="form-control">
    
                            <label for="nameBackdrop" class="form-label mt-3">Select Branch</label>
                            <select name="branch" id="branch" class="form-control" required>
                                <option value="" selected disabled>Select An Option</option>
                                <option value="Jacinto Ignacio Market">Jacinto Ignacio Market</option>
                                <option value="Jacinto Market">Jacinto Market</option>
                                <option value="House of Saint">House of Saint</option>
                            </select>
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

<!-- Modal By Date Report -->
<div class="modal fade" id="byDate" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="{{route('reports.date')}}" method="GET">
            @csrf

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