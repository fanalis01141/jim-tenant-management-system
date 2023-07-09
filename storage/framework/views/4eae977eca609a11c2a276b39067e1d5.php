

<?php $__env->startSection('title', 'Add New Tenant - '); ?>

<?php $__env->startSection('page-style'); ?>
<!-- Page -->
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/css/pages/page-auth.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">

        <div class="card">
            <div class="col-md-8">
                
                <div class="card-header">
                    <form action="<?php echo e(route('tenants.search')); ?>" method="GET">
                        <label for="tenant-name" class="">Search name for tenant</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="query" placeholder="Enter your search query">
                            <button type="submit" class="btn btn-success text-dark">Search</button>
                        </div>

                    </form>
                </div>

                <div class="card-body">

                    <?php if($results->count() > 0): ?>
                        <ul>
                            <div class="table-responsive" style="max-height: 400px; overflow-y: auto; height: 400px;">
                                <table class="table table-hover table-borderless">
                                  <thead>
                                    <tr>
                                      <th>Name</th>
                                      <th>Branch</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                        <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $results): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(ucwords($results->full_name)); ?>                                        </td>
                                            <td><?php echo e($results->branch); ?></td>
                                            <td><a href="#" class="btn btn-primary"><i class="bx bx-edit-alt me-2"></i> Edit Details</a></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                               
                                  </tbody>
                                </table>
                            </div>
                        </ul>
                    <?php else: ?>
                        <ul>
                            <p>Or you can check this below:</p>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($result->full_name); ?></li>
                                
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/contentNavbarLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\John Ezekiel B. Lim\Desktop\jim-tenant-management-system\resources\views/tenant/search.blade.php ENDPATH**/ ?>