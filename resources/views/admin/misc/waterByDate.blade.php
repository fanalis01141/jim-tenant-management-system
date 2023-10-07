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
                    <h3 class="card-header">You Are Viewing Water Misc For <span class="text-primary">{{ $readableDate }}</span> </h3>

                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Branch</th>
                                        <th>Store Name</th>
                                        <th>Date of Transaction</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                              <tbody>
                                    @foreach ($tenantsWater as $t)
                                        <tr>
                                            <td>{{ $t->store_name }} - {{ $t->branch }}</td>
                                            <td>{{ number_format($t->amount, 0, '.', ',') }} </td>
                                            <td>{{ \Carbon\Carbon::parse($t->date_paid)->format('M j, Y') }} </td>
                                            <td class="align-items-start">
                                                <a class="btn btn-primary" id="editButton" href="#" 
                                                    onclick="editMisc( {{$t->id}}, {{$t->amount}}, '{{$t->date_paid}}', '{{$t->store_name}}' );">
                                                    <i class="bx bx-edit-alt me-2"></i>Edit</a>
                                                <a class="btn btn-danger" onclick="deleteMisc({{$t->id}})" href="#"><i class="bx bx-trash me-2"></i>Delete</a>                                            
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

        <form class="modal-content" action="{{route('misc.update','editMisc')}}" method="POST">
            
            @method('PUT')
            @csrf

            <div class="modal-header">
                <h5 class="modal-title" id="editModalTitle">Enter Updated Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">

                        <label for="nameBackdrop" class="form-label">Store Name</label>
                        <input type="text" name="misc_type" value="water" hidden>
                        <input type="text" name="id" id="paymentIdInput" hidden>
    
                        <label for="amount" class="form-label mt-3">Enter Amount</label>
                        <input class="form-control" type="number" name="amount" id="amountInput" required/>

                        <label for="date_paid" class="form-label mt-3">Select Date of Transaction</label>
                        <input class="form-control" id="datePaidInput" type="date" name="date_paid" required/>

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


@endsection

<script>

    function editMisc(paymentId, amount, date_paid, store){

        var editModal = document.getElementById('editModal');
        var paymentIdInput = document.getElementById('paymentIdInput');
        var amountInput = document.getElementById('amountInput');
        var editModalTitle = document.getElementById('editModalTitle');
        var datePaidInput = document.getElementById('datePaidInput');

        console.log(date_paid);


        paymentIdInput.value = paymentId;
        amountInput.value = amount;
        datePaidInput.value = date_paid;
        editModalTitle.innerHTML = "Editing information for " + "<span class='text-primary'>" + store + "</span>";
        $(editModal).modal('show');
    }

    function deleteMisc(id) {
        console.log(id);
    swal({
        title: "Delete Misc Record?",
        text: "Once deleted, you will not be able to restore this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            fetch('/misc/'+id, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
                }).then(response => {
            swal({
                title: "Misc Record Deleted",
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
