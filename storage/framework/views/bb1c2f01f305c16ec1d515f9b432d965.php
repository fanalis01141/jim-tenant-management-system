

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

<div class="row mt-5">
    <div class="col-lg-12 text-center">
        <h2 class="card-title text-black">Select an Option to View </h2>
        <div class="row mt-3 d-flex justify-content-center">
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
                        <button class="btn btn-warning btn-lg" data-bs-toggle="modal" data-bs-target="#byDate">Select Month</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal By Date Report -->
<div class="modal fade" id="byDate" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">

        <form class="modal-content" action="<?php echo e(route('admin.paymentsByDate')); ?>" method="post">

            <?php echo csrf_field(); ?>
            <?php echo method_field('POST'); ?>
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

<!-- Modal By Month Report -->
<div class="modal fade" id="byMonth" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="<?php echo e(route('reports.monthly')); ?>" method="POST">
            <?php echo csrf_field(); ?>

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



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/contentNavbarLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\John Ezekiel B. Lim\Desktop\jim-tenant-management-system\resources\views/admin/landing.blade.php ENDPATH**/ ?>