

<?php $__env->startSection('title', 'Add New Tenant - '); ?>

<?php $__env->startSection('page-style'); ?>
<!-- Page -->
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/css/pages/page-auth.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
            <div class="col-md-8">
                <div class="card p-1">
                    <div class="card-header">
                        <h4 class="card-title">Add New Tenant Information</h4>
                    </div>
                    <div class="card-body">
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
                        <form action="<?php echo e(route('tenants.update', $tenant->id)); ?>" method="POST">
                            <?php echo method_field('PUT'); ?>
                            <?php echo csrf_field(); ?>
    
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="tenant-name" class="">Store Name</label>
                                    <input type="text" name="store_name" id="store-name" class="form-control" required value="<?php echo e($tenant->store_name); ?>">
                                </div>

                                <div class="col-md-6">
                                    <label for="tenant-name" class="">Branch</label>
                                    <select name="branch" id="" class="form-select" required>
                                        <option value="" selected disabled>Select Branch</option>
                                        <option value="Jacinto Ignacio Market" <?php echo e($tenant->branch === 'Jacinto Ignacio Market' ? 'selected' : ''); ?>>Jacinto Ignacio Market</option>
                                        <option value="Jacinto Market" <?php echo e($tenant->branch === 'Jacinto Market' ? 'selected' : ''); ?>>Jacinto Market</option>
                                        <option value="House of Saint" <?php echo e($tenant->branch === 'House of Saint' ? 'selected' : ''); ?>>House of Saint</option>
                                        <option value="Other businesses" <?php echo e($tenant->branch === 'Other businesses' ? 'selected' : ''); ?>>Other businesses</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="tenant-name" class="">First Name of Tenant</label>
                                    <input type="text" name="first_name" id="last-name" class="form-control" required value="<?php echo e($tenantData->get('firstName')); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="tenant-name" class="">Last Name of Tenant</label>
                                    <input type="text" name="last_name" id="last-name" class="form-control" required value="<?php echo e($tenantData->get('lastName')); ?>">
                                </div>
                            </div>


                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="tenant-name" class="">Sex / Gender</label>
                                    <select name="sex" id="" class="form-select" required>
                                        <option value="" selected disabled>Select Sex / Gender</option>
                                        <option value="Male" <?php echo e($tenant->sex === 'Male' ? 'selected' : ''); ?>>Male</option>
                                        <option value="Female" <?php echo e($tenant->sex === 'Female' ? 'selected' : ''); ?>>Female</option>
                                        <option value="Other" <?php echo e($tenant->sex === 'Other' ? 'selected' : ''); ?>>Other</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="tenant-name" class="">Phone number of Tenant</label>
                                    <input type="number" name="phone" id="phone" class="form-control" required value="<?php echo e($tenant->phone_number); ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="tenant-name" class="">Address</label>
                                    <input type="text" name="address" id="address" class="form-control" required value="<?php echo e($tenant->complete_address); ?>">
                                </div>
                            </div>
                                
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label for="tenant-name" class="">Utilities</label>
                                    <div class="mt-2">
                                        <input class="form-check-input" name="utility[]" type="checkbox" value="Water" value="Water" <?php echo e(is_array($decodedUtility) && in_array('Water', $decodedUtility) ? 'checked' : ''); ?>/>
                                        <label class="form-check-label">Water</label>
    
                                        <input style="margin-left:15px;" name="utility[]" class="form-check-input mr-2" type="checkbox" value="Electricity" value="Water" <?php echo e(is_array($decodedUtility) && in_array('Electricity', $decodedUtility) ? 'checked' : ''); ?>/>
                                        <label class="form-check-label">Electricity</label>
                                    </div>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="tenant-name" class="">Mode of Payment</label>
                                    <select name="mop" id="" class="form-select" required>
                                        <option value="" selected disabled>Select Mode of Payment</option>
                                        <option value="Gcash" <?php echo e($tenant->mode_of_payment === 'Gcash' ? 'selected' : ''); ?>>Gcash</option>
                                        <option value="Cash" <?php echo e($tenant->mode_of_payment === 'Cash' ? 'selected' : ''); ?>>Cash</option>
                                        <option value="Credit Card" <?php echo e($tenant->mode_of_payment === 'Credit Card' ? 'selected' : ''); ?>>Credit Card</option>
                                    </select>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="tenant-name" class="">Amount Paid</label>
                                    <input type="number" name="amount" id="amount" class="form-control" required value="<?php echo e($tenant->amount_of_payment); ?>">
                                </div>
                            </div>
    
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label for="tenant-name" class="">Date</label>
                                    <input class="form-control" type="date" id="html5-date-input" name="date" required value="<?php echo e($tenant->start_date); ?>"/>
                                </div>
    
                                <div class="col-md-4">
                                    <label for="tenant-name" class="">Time</label>
                                    <input class="form-control" type="time" value="12:30:00" id="html5-time-input" name="time" value="<?php echo e($tenant->start_time); ?>" required/>
                                </div>

                                <div class="col-md-4 d-grid">
                                    <button class="btn btn-primary mt-4" type="submit">Update Tenant Details</button>
                                </div>
                            </div>
                            <div class="mt-3 text-end">
                                
                            </div>
    
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card  p-1">
                    <div class="card-header">
                        <div class="card-title"><h4>Quick View of Tenants</h4></div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto; height: 400px;">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th>Name</th>
                                  <th>Branch</th>
                                </tr>
                              </thead>
                              <tbody>

                                    <?php $__currentLoopData = $tenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(ucwords($tenant->full_name)); ?>                                        </td>
                                        <td><?php echo e($tenant->branch); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                               
                              </tbody>
                            </table>
                        </div>
                        <a href="/tenants" class="btn btn-primary mb-4">View All Tenants</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/contentNavbarLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\John Ezekiel B. Lim\Desktop\jim-tenant-management-system\resources\views/tenant/edit.blade.php ENDPATH**/ ?>