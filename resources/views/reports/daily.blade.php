@extends('layouts/blankLayout')

@section('title', 'Encoder Dashboard')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')



<div class="container mt-5 mb-5">
    <div class="row ">
        <div class="col-md-12 d-flex justify-content-between">
            <h3>Report for Branch <span class="text-primary">{{ $branch }}  - {{ $monthName }}, {{ $year }}</h3></span>
            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            @endauth
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="row card-body d-flex justify-content-between">

                    <div class="col-md-2">
                        <i class='bx bx-wallet-alt bx-md' style="color:#37dd61"></i>              
                        <span class="fw-bold d-block mb-1"><strong>Income</strong></span>
                        <h3 class="card-title mb-2">₱ {{ number_format($income, 0, ',', ',') }}</h3>
                    </div>

                    <div class="col-md-2">
                        <i class='bx bx-dollar bx-md' style="color:#403dff"></i>              
    
                        <span class="fw-semibold d-block mb-1">Total Payments</span>
                        <h3 class="card-title mb-2">₱ {{ number_format($totalPayments, 0, ',', ',') }}</h3>
                    </div>
                    
                    <div class="col-md-2">
                        <i class='bx bx-archive-out bx-md' style="color:#ff0000"></i>  
                        <span class="fw-semibold d-block mb-1">Total Expenses</span>
                        <h3 class="card-title mb-2">₱ {{ number_format($totalExpenses, 0, ',', ',') }}</h3>
                    </div>

                    <div class="col-md-2">
                        <i class='bx bx-droplet bx-md' style="color:#00c3ff"></i>              
                        <span class="fw-semibold d-block mb-1">Total Water Payments</span>
                        <h3 class="card-title mb-2">₱ {{ number_format($totalWater, 0, ',', ',') }}</h3>
                    </div>

                    <div class="col-md-2">
                        <i class='bx bx-bulb bx-md' style="color:#ff9900"></i>              
                        <span class="fw-semibold d-block mb-1">Total Electricity Payments</span>
                        <h3 class="card-title mb-2">₱ {{ number_format($totalElec, 0, ',', ',') }}</h3>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between text-center">
                    <h4>List of Payments</h4>
                </div>
                <div class="card-body">                  
                    
                    <div class="table-responsive" style="max-height: 500px; overflow-y: auto; height: 500px;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Store</th>
                                    <th>Amount</th>  
                                    <th>Date</th>                                      
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($tenantsPayments as $t)
                                    <tr>
                                        <th>{{$t->store_name}} - {{$t->branch}} </th>  
                                        <th>{{ number_format($t->amount, 0, ',', ',') }}</th>
                                        <th>{{ $t->created_at->format('M j, Y') }}</th>
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
                <div class="card-header d-flex justify-content-between text-center">
                    <h4>List of Expenses</h4>
                </div>
                <div class="card-body">                  
                    
                    <div class="table-responsive" style="max-height: 500px; overflow-y: auto; height: 500px;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Branch</th>
                                    <th>Type of Expense</th>         
                                    <th>Amount</th>             
                                    <th>Date</th>                           
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($tenantsExpenses as $t)
                                    <tr>
                                        <th> {{$t->branch}} </th>  
                                        <th> {{$t->choice_1}} - {{$t->choice_2}}</th>  
                                        <th> {{ number_format($t->amount, 0, ',', ',') }} </th>
                                        <th>{{ $t->created_at->format('M j, Y') }}</th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    
    </div>

    <div class="row mt-4">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between text-center">
                    <h4>List of Water Misc</h4>
                </div>
                <div class="card-body">                  
                    
                    <div class="table-responsive" style="max-height: 500px; overflow-y: auto; height: 500px;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Store</th>
                                    <th>Amount</th>            
                                    <th>Date</th>                            
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($tenantsWater as $t)
                                    <tr>
                                        <th>{{$t->store_name}}</th>  
                                        <th>{{ number_format($t->amount, 0, ',', ',') }}</th>
                                        <th>{{ \Carbon\Carbon::parse($t->date_paid)->format('M j, Y') }}</th>
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
                <div class="card-header d-flex justify-content-between text-center">
                    <h4>List of Electricity Misc</h4>
                </div>
                <div class="card-body">                  
                    
                    <div class="table-responsive" style="max-height: 500px; overflow-y: auto; height: 500px;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Store</th>
                                    <th>Amount</th>        
                                    <th>Date</th>                                 
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($tenantsElec as $t)
                                    <tr>
                                        <th>{{ $t->store_name }}</th>  
                                        <th>{{ number_format($t->amount, 0, ',', ',') }}</th>
                                        <th>{{ \Carbon\Carbon::parse($t->date_paid)->format('M j, Y') }}</th>
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

