

<?php $__env->startSection('title', 'Encoder Dashboard'); ?>

<?php $__env->startSection('page-style'); ?>
<!-- Page -->
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/css/pages/page-auth.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



<div class="container mt-5 mb-5">
    <div class="row ">
        <div class="col-md-12 d-flex justify-content-between">
            <h3>Report for Branch <span class="text-primary"><?php echo e($branch); ?>  - <?php echo e($monthName); ?>, <?php echo e($year); ?></h3></span>
            <?php if(auth()->guard()->check()): ?>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="row card-body d-flex justify-content-between">

                    <div class="col-md-2">
                        <i class='bx bx-wallet-alt bx-md' style="color:#37dd61"></i>              
                        <span class="fw-bold d-block mb-1"><strong>Income</strong></span>
                        <h3 class="card-title mb-2">₱ <?php echo e(number_format($income, 0, ',', ',')); ?></h3>
                    </div>

                    <div class="col-md-2">
                        <i class='bx bx-dollar bx-md' style="color:#403dff"></i>              
    
                        <span class="fw-semibold d-block mb-1">Total Payments</span>
                        <h3 class="card-title mb-2">₱ <?php echo e(number_format($totalPayments, 0, ',', ',')); ?></h3>
                    </div>
                    
                    <div class="col-md-2">
                        <i class='bx bx-archive-out bx-md' style="color:#ff0000"></i>  
                        <span class="fw-semibold d-block mb-1">Total Expenses</span>
                        <h3 class="card-title mb-2">₱ <?php echo e(number_format($totalExpenses, 0, ',', ',')); ?></h3>
                    </div>

                    <div class="col-md-2">
                        <i class='bx bx-droplet bx-md' style="color:#00c3ff"></i>              
                        <span class="fw-semibold d-block mb-1">Total Water Payments</span>
                        <h3 class="card-title mb-2">₱ <?php echo e(number_format($totalWater, 0, ',', ',')); ?></h3>
                    </div>

                    <div class="col-md-2">
                        <i class='bx bx-bulb bx-md' style="color:#ff9900"></i>              
                        <span class="fw-semibold d-block mb-1">Total Electricity Payments</span>
                        <h3 class="card-title mb-2">₱ <?php echo e(number_format($totalElec, 0, ',', ',')); ?></h3>
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
                                <?php $__currentLoopData = $tenantsPayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th><?php echo e($t->store_name); ?> - <?php echo e($t->branch); ?> </th>  
                                        <th><?php echo e(number_format($t->amount, 0, ',', ',')); ?></th>
                                        <th><?php echo e($t->created_at->format('M j, Y')); ?></th>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                <?php $__currentLoopData = $tenantsExpenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th> <?php echo e($t->branch); ?> </th>  
                                        <th> <?php echo e($t->choice_1); ?> - <?php echo e($t->choice_2); ?></th>  
                                        <th> <?php echo e(number_format($t->amount, 0, ',', ',')); ?> </th>
                                        <th><?php echo e($t->created_at->format('M j, Y')); ?></th>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                <?php $__currentLoopData = $tenantsWater; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th><?php echo e($t->store_name); ?></th>  
                                        <th><?php echo e(number_format($t->amount, 0, ',', ',')); ?></th>
                                        <th><?php echo e(\Carbon\Carbon::parse($t->date_paid)->format('M j, Y')); ?></th>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                <?php $__currentLoopData = $tenantsElec; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th><?php echo e($t->store_name); ?></th>  
                                        <th><?php echo e(number_format($t->amount, 0, ',', ',')); ?></th>
                                        <th><?php echo e(\Carbon\Carbon::parse($t->date_paid)->format('M j, Y')); ?></th>
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
 


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts/blankLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\John Ezekiel B. Lim\Desktop\jim-tenant-management-system\resources\views/reports/monthly.blade.php ENDPATH**/ ?>