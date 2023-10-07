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

<div class="row">
    <div class="col-lg-12 text-center">
        <div class="row mt-3 d-flex justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <h3 class="card-header">You Are Viewing Payments For <span class="text-primary">{{ $readableDate }}</span> </h3>

                    <div class="row">
                        <div class="col-md-4">
                            <span class="d-block mb-1">Total Payments</span>
                            <h3 class="card-title mb-2">{{ number_format($totalPayments, 0, '.', ',') }}</h3>
                        </div>

                        <div class="col-md-4">
                            <span class="d-block mb-1">Paid Tenants</span>
                            <h3 class="card-title mb-2">{{$totalPaid}}</h3>
                        </div>

                        <div class="col-md-4">
                            <span class="d-block mb-1">Payments Passed</span>
                            <h3 class="card-title mb-2">{{$totalPass}}</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Branch</th>
                                        <th>Amount</th>
                                        <th>Option</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                              <tbody>
                                    @foreach ($tenantsPayments as $t)
                                        <tr>
                                            <td>{{ $t->store_name }}</td>
                                            <td>{{ $t->branch }}</td>
                                            <td>{{ number_format($t->amount, 0, '.', ',') }}</td>
                                            <th>
                                                @if ($t->option == 'Payment')
                                                    <span class="badge bg-success">Paid</span>
                                                @else
                                                    <span class="badge bg-danger">Pass</span>
                                                @endif
                                            </th>
                                            <td class="align-items-start">
                                                <a class="btn btn-primary" id="editButton" data-paymentId="{{$t->id}}" data-amount="{{$t->amount}}"
                                                    href="#" onclick="editPayment( {{$t->id}}, {{$t->amount}}, '{{$t->store_name}}', '{{$t->branch}}' ) ;">
                                                    <i class="bx bx-edit-alt me-2"></i>Edit</a>
                                                <a class="btn btn-danger" onclick="deletePayment({{$t->id}})" href="#"><i class="bx bx-trash me-2"></i>Delete</a>                                            
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
</div>

<div class="modal fade" id="editModal" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="{{route('payments.update','editPayment')}}" method="POST">
            
            @method('PUT')
            @csrf

            <div class="modal-header">
                <h5 class="modal-title" id="editModalTitle">Enter Updated Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col mb-3">
                    <input type="text" id="paymentIdInput" name="paymentIdInput" class="form-control" placeholder="Enter Name" hidden>
                </div>
            </div>
            <div class="row g-2">
                <div class="col mb-0">
                    <label for="emailBackdrop" class="form-label">Amount</label>
                    <input type="text" id="amountInput" name="amountInput" class="form-control">
                </div>
                <div class="col mb-0">
                    <label for="dobBackdrop" class="form-label">Paid or Pass</label>
                    <select name="option" class="form-select" required>
                        <option value="" selected disabled>Select an Option</option>
                        <option value="Payment">Payment</option>
                        <option value="Pass">Pass</option>
                    </select>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>    

<script>

    function editPayment(paymentId, amount, store, branch){

        var editModal = document.getElementById('editModal');
        var paymentIdInput = document.getElementById('paymentIdInput');
        var amountInput = document.getElementById('amountInput');
        var editModalTitle = document.getElementById('editModalTitle');


        paymentIdInput.value = paymentId;
        amountInput.value = amount;
        editModalTitle.innerHTML = "Editing information for " + "<span class='text-primary'>" + store +", "+ branch + "</span>";
        $(editModal).modal('show');
    }

    function deletePayment(id) {
    swal({
        title: "Delete Payment Record?",
        text: "Once deleted, you will not be able to restore this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            fetch('/payments/'+id, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
                }).then(response => {
            swal({
                title: "Payment Deleted",
                text: "Refreshing your dashboard...",
                icon: "success",
                buttons: false, // Hide the "OK" button
                timer: 1500, // Display the success message for 1.5 seconds
            }).then(() => {
                window.location.reload(); // Reload the current page
            });
        });
        }
    });
}
</script>


@endsection
