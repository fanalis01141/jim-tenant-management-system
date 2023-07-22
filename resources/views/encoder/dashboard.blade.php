@extends('layouts/blankLayout')

@section('title', 'Encoder Dashboard')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')

<div class="container">
    <div class="row p-5">
        <div class="col-md-12 d-flex justify-content-between">
            <h1>Welcome to Your Dashboard, <span class="text-primary text-bold">{{Auth::user()->name}}</span></h1>
            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            @endauth

        </div>
    </div>

    <div class="row">
    
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
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

        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h1>Payments</h1>
                    <h2><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newPayment">New Cash Payment</button></h2>
                </div>
                <div class="card-body">
                    <div class="divider divider-primary">
                        <div class="divider-text">Recent Cash-in Payments for Today - {{ now()->format('F j, Y') }}
                        </div>
                    </div>                    
                      
                    <div class="table-responsive" style="max-height: 200px; overflow-y: auto; height: 200px;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tenant</th>
                                    <th>Amount</th>              
                                    <th>Payment Status</th>                                
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paidToday as $paid)
                                    <tr>
                                        <th>{{$paid->tenant_name}}</th>
                                        <th>{{$paid->option == 'Payment' ? $paid->amount : '---'}}</th>
                                        <th>@if ($paid->option == 'Payment')
                                            <span class="badge bg-success">Paid</span>
                                        @else
                                            <span class="badge bg-danger">Pass</span>
                                        @endif</th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h1>Expenses</h1>
                    <h2><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#newExpenses">New Expenses</button></h2>
                </div>

                <div class="card-body">
                    <div class="divider divider-danger">
                        <div class="divider-text">Recent Cash-out/Expenses for Today - {{ now()->format('F j, Y') }}</div>
                    </div>                    
                      
                    <div class="table-responsive" style="max-height: 200px; overflow-y: auto; height: 200px;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Branch</th>
                                    <th>Type & Option</th>         
                                    <th>Amount</th>                                
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expenses as $expenses)
                                    <tr>
                                        <th>{{$expenses->branch}}</th>
                                        <th>{{$expenses->choice_1}} - {{$expenses->choice_2}}</th>
                                        <th>{{$expenses->amount}}</th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 d-flex justify-content-center">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h1>Miscellaneous</h1>
                    <h2><button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#newMisc">New Misc Entry</button></h2>
                </div>
                <div class="card-body">
                    <div class="divider divider-primary">
                        <div class="divider-text">Recent Miscellaneous Expenses for {{ now()->format('F, Y') }}
                        </div>
                    </div>                    
                      
                    <div class="table-responsive" style="max-height: 150px; overflow-y: auto; height: 150px;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Miscellaneous Type</th>
                                    <th>Amount</th>              
                                    <th>Date</th>                                
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($misc as $m)
                                    <tr>
                                        <th>{{$m->misc}}</th>
                                        <th>{{$m->amount}}</th>
                                        <th>{{ \Carbon\Carbon::parse($m->created_at)->format('F j, Y') }}                                        </th>

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

<!-- Modal Payment-->
<div class="modal fade" id="newPayment" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="{{route('expenses.store')}}" method="POST">
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
                            @foreach($unpaidTenants as $tenant)
                                <option value="{{ ucwords($tenant->full_name) }}" class="dropdown-item"></option>
                            @endforeach
                        </datalist>

                        {{-- <label for="tenant-name" class="form-label mt-2">Date of Payment</label>
                        <input class="form-control" type="date" id="html5-date-input" name="date_paid" value="{{ now()->format('Y-m-d') }}" required/>
                         --}}
                        <br>

                        <span>Is this a Payment or Pass? Please double check your input.</span>
                        <select name="option" id="option" class="form-control" required>
                            <option value="" selected disabled>Select An Option</option>
                            <option value="Payment">Payment</option>
                            <option value="Pass">Pass</option>
                        </select>
                        {{-- <input type="text" id="nameBackdrop" class="form-control"> --}}
                    </div>
                </div>
                <br>
                <span class="text-primary">NOTE:</span> This will record only be for TODAY.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Payment-->
<div class="modal fade" id="newExpenses" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="{{route('expenses.store')}}" method="POST">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">You Are Adding New Expenses Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">

                        <label for="branch" class="form-label mt-3">Select Branch</label>
                        <select name="branch" class="form-select" required>
                            <option value="" selected disabled>Select an option</option>
                            <option value="Jacinto Ignacio Market">Jacinto Ignacio Market</option>
                            <option value="Jacinto Market">Jacinto Market</option>
                            <option value="House of Saint">House of Saint</option>
                            <option value="Other businesses">Other businesses</option>
                        </select>

                        <label for="branch" class="form-label mt-3">Select Type of Expense</label>
                        <select name="choice_1" onchange="showDropdown(this.value)" class="form-select mb-3" required>
                            <option value="" selected disabled>Select an option</option>
                            <option value="Operating Expense">Operating Expense</option>
                            <option value="Personal Expense">Personal Expense</option>
                            <option value="Cash Deposit">Cash Deposit</option>
                        </select>
                        
                        <div id="dropdown-container"></div>
    
                        <label for="amount" class="form-label mt-3">Enter Amount of Expense Record</label>
                        <input class="form-control" type="number" name="amount" value="" required/>

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

<!-- Modal Miscellaneous-->
<div class="modal fade" id="newMisc" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="{{route('misc.store')}}" method="POST">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">You Are Adding New Miscellaneous Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">

                        <label for="branch" class="form-label mt-3">Select Type of Miscellaneous</label>
                        <select name="misc" class="form-select" required>
                            <option value="" selected disabled>Select an option</option>
                            <option value="Power">Power</option>
                            <option value="Water">Water</option>
                        </select>
    
                        <label for="amount" class="form-label mt-3">Enter Amount</label>
                        <input class="form-control" type="number" name="amount" value="" required/>

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
                <label for="tenant-name" class="form-label">Select Options for Operating Expense</label>
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
                <label for="tenant-name" class="form-label">Select Options for Personal Expense</label>
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
                <label for="tenant-name" class="form-label">Select Options for Cash Deposit</label>
                <select name="choice_2" class="form-select" required>
                    <option value="" selected disabled>Select an Option</option>
                    <option value="Banks">Banks</option>
                    <option value="SVCC">SVCC</option>
                </select>
            `;
        }
    }
</script>