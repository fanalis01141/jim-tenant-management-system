

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
  <div class="col-lg-8 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h2 class="card-title text-black">Welcome to your dashboard, <b class="text-primary"><?php echo e(Auth::user()->name); ?></b> 🎉</h2>
          </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-md-4">
            <img src="<?php echo e(asset('assets/img/illustrations/man-with-laptop-light.png')); ?>" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
          </div>
        </div>
      </div>
    </div>
  </div>

  
  <div class="col-lg-4 col-md-4 order-1">
    <div class="row">
      <div class="col-lg-6 col-md-12 col-6 mb-4">
        <div class="card" style="height: 175px;">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <i class='bx bx-store-alt bx-md' style="color:#379bdd"></i>
              </div>
            </div>
            <span class="d-block mb-1">Number of Tenants</span>
            <h3 class="card-title mb-2"><?php echo e($tenants->count()); ?></h3>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-6 mb-4">
        <div class="card" style="height: 175px;">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <i class='bx bx-user-circle bx-md' style="color:#696CFF"></i>              
              </div>
            </div>
            <span>Number of Users</span>
            <h3 class="card-title text-nowrap mb-1"><?php echo e($users); ?></h3>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
      <div class="row row-bordered g-0">
        <div class="col-md-12 d-flex justify-content-between p-1">
          <h5 class="card-header m-0 me-2 pb-3">Tenants Record</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Branch</th>
                  <th>Phone Number</th>
                </tr>
              </thead>
              <tbody>
                    <?php $__currentLoopData = $tenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(ucwords($tenant->full_name)); ?></td>
                        <td><?php echo e($tenant->branch); ?></td>
                        <td><?php echo e($tenant->phone_number); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                               
              </tbody>
            </table>
        </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
    <div class="row">
      <div class="col-6 mb-4">
        <div class="card" style="height: 175px;">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <i class='bx bx-arrow-to-left bx-md' style="color: #37dd61"></i>
              </div>
            </div>
            <span class="d-block mb-1">Today's Cash-in</span>
            <h3 class="card-title text-nowrap mb-2">₱ <?php echo e($sumPayments); ?>.00</h3>
          </div>
        </div>
      </div>
      <div class="col-6 mb-4">
        <div class="card" style="height: 175px;">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <i class='bx bx-archive-out bx-md' style="color:#e93b3b"></i>              
              </div>
            </div>
            <span class="d-block mb-1">This Month's Expenses</span>
            <h3 class="card-title mb-2">₱ <?php echo e($totalExpenses); ?>.00</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/contentNavbarLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\John Ezekiel B. Lim\Desktop\jim-tenant-management-system\resources\views/dashboard.blade.php ENDPATH**/ ?>