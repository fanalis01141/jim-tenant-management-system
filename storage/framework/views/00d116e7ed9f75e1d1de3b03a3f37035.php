

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
                    <h3 class="card-header">You Are Viewing Payments For <span class="text-primary"><?php echo e($readableDate); ?></span> </h3>

                    <div class="row">
                        <div class="col-md-4">
                            <span class="d-block mb-1">Total Payments</span>
                            <h3 class="card-title mb-2"><?php echo e(number_format($totalPayments, 0, '.', ',')); ?></h3>
                        </div>

                        <div class="col-md-4">
                            <span class="d-block mb-1">Paid Tenants</span>
                            <h3 class="card-title mb-2"><?php echo e($totalPaid); ?></h3>
                        </div>

                        <div class="col-md-4">
                            <span class="d-block mb-1">Payments Passed</span>
                            <h3 class="card-title mb-2"><?php echo e($totalPass); ?></h3>
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
                                    <?php $__currentLoopData = $tenantsPayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($t->store_name); ?></td>
                                            <td><?php echo e($t->branch); ?></td>
                                            <td><?php echo e(number_format($t->amount, 0, '.', ',')); ?></td>
                                            <th>
                                                <?php if($t->option == 'Payment'): ?>
                                                    <span class="badge bg-success">Paid</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger">Pass</span>
                                                <?php endif; ?>
                                            </th>
                                            <td class="align-items-start">
                                                <a class="btn btn-primary" id="editButton" data-paymentId="<?php echo e($t->id); ?>" data-amount="<?php echo e($t->amount); ?>"
                                                    href="#" onclick="editPayment( <?php echo e($t->id); ?>, <?php echo e($t->amount); ?>, '<?php echo e($t->store_name); ?>', '<?php echo e($t->branch); ?>' ) ;">
                                                    <i class="bx bx-edit-alt me-2"></i>Edit</a>
                                                <a class="btn btn-danger" onclick="#" href="#"><i class="bx bx-trash me-2"></i>Delete</a>
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
        <form class="modal-content" action="<?php echo e(route('payments.update','editPayment')); ?>" method="POST">
            
            <?php echo method_field('PUT'); ?>
            <?php echo csrf_field(); ?>

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


</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/contentNavbarLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\John Ezekiel B. Lim\Desktop\jim-tenant-management-system\resources\views/admin/payments/index.blade.php ENDPATH**/ ?>