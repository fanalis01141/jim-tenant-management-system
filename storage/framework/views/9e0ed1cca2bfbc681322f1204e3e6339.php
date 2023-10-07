

<?php $__env->startSection('title', 'Dashboard - '); ?>

<?php $__env->startSection('vendor-style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/apex-charts/apex-charts.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('vendor-script'); ?>
<script src="<?php echo e(asset('assets/vendor/libs/apex-charts/apexcharts.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-script'); ?>
<script src="<?php echo e(asset('assets/js/dashboards-analytics.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-12">
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

    </div>
</div>

<div class="row">
    <div class="col-lg-12 text-center">
        <div class="row mt-3 d-flex justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <h3 class="card-header">You Are Viewing Electricity Misc For the Month Of <span class="text-primary"><?php echo e($readableDate); ?></span> </h3>

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
                                    <?php $__currentLoopData = $tenantsElec; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($t->store_name); ?> - <?php echo e($t->branch); ?></td>
                                            <td><?php echo e(number_format($t->amount, 0, '.', ',')); ?> </td>
                                            <td><?php echo e(\Carbon\Carbon::parse($t->date_paid)->format('M j, Y')); ?> </td>
                                            <td class="align-items-start">
                                                <a class="btn btn-primary" id="editButton" href="#" 
                                                    onclick="editMisc( <?php echo e($t->id); ?>, <?php echo e($t->amount); ?>, '<?php echo e($t->date_paid); ?>', '<?php echo e($t->store_name); ?>' );">
                                                    <i class="bx bx-edit-alt me-2"></i>Edit</a>
                                                <a class="btn btn-danger" onclick="deleteMisc(<?php echo e($t->id); ?>)" href="#"><i class="bx bx-trash me-2"></i>Delete</a>                                            
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                               
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

        <form class="modal-content" action="<?php echo e(route('misc.update','editMisc')); ?>" method="POST">
            
            <?php echo method_field('PUT'); ?>
            <?php echo csrf_field(); ?>

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


<?php $__env->stopSection(); ?>

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
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
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

<?php echo $__env->make('layouts/contentNavbarLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\John Ezekiel B. Lim\Desktop\jim-tenant-management-system\resources\views/admin/misc/elecByMonth.blade.php ENDPATH**/ ?>