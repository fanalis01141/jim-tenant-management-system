

<?php $__env->startSection('title', 'Encoder Dashboard'); ?>

<?php $__env->startSection('page-style'); ?>
<!-- Page -->
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/css/pages/page-auth.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row p-5">
        <div class="col-md-12 d-flex justify-content-between">
            <h1>Welcome to Your Dashboard, <span class="text-primary text-bold"><?php echo e(Auth::user()->name); ?></span></h1>
            <?php if(auth()->guard()->check()): ?>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            <?php endif; ?>

        </div>
    </div>

    <div class="row">
    
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger">
                <?php echo e(session('error')); ?>

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

        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h1>Payments</h1>
                    <h2><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newPayment">New Cash Payment</button></h2>
                </div>
                <div class="card-body">
                    <div class="divider divider-primary">
                        <div class="divider-text">Recent Cash-in Payments for Today - <?php echo e(now()->format('F j, Y')); ?>

                        </div>
                    </div>                    
                      
                    <div class="table-responsive" style="max-height: 200px; overflow-y: auto; height: 200px;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tenant</th>
                                    <th>Amount</th>              
                                    <th>Payment Status</th>                                
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $paidToday; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th><?php echo e($paid->tenant_name); ?></th>
                                        <th><?php echo e($paid->option == 'Payment' ? $paid->amount : '---'); ?></th>
                                        <th><?php if($paid->option == 'Payment'): ?>
                                            <span class="badge bg-success">Paid</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Pass</span>
                                        <?php endif; ?></th>
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
                <div class="card-header d-flex justify-content-between">
                    <h1>Expenses</h1>
                    <h2><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#newExpenses">New Expenses</button></h2>
                </div>

                <div class="card-body">
                    <div class="divider divider-danger">
                        <div class="divider-text">Recent Cash-out/Expenses for Today - <?php echo e(now()->format('F j, Y')); ?></div>
                    </div>                    
                      
                    <div class="table-responsive" style="max-height: 200px; overflow-y: auto; height: 200px;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Branch</th>
                                    <th>Type & Option</th>         
                                    <th>Amount</th>                                
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expenses): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th><?php echo e($expenses->branch); ?></th>
                                        <th><?php echo e($expenses->choice_1); ?> - <?php echo e($expenses->choice_2); ?></th>
                                        <th><?php echo e($expenses->amount); ?></th>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 d-flex justify-content-center">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h1>Miscellaneous</h1>
                    <h2><button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#newMisc">New Misc Entry</button></h2>
                </div>
                <div class="card-body">
                    <div class="divider divider-primary">
                        <div class="divider-text">Recent Miscellaneous Expenses for <?php echo e(now()->format('F, Y')); ?>

                        </div>
                    </div>                    
                      
                    <div class="table-responsive" style="max-height: 150px; overflow-y: auto; height: 150px;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Miscellaneous Type</th>
                                    <th>Amount</th>              
                                    <th>Date</th>                                
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $misc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th><?php echo e($m->misc); ?></th>
                                        <th><?php echo e($m->amount); ?></th>
                                        <th><?php echo e(\Carbon\Carbon::parse($m->created_at)->format('F j, Y')); ?>                                        </th>

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

<!-- Modal Payment-->
<div class="modal fade" id="newPayment" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="<?php echo e(route('expenses.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">You Are Adding New Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBackdrop" class="form-label">Name</label>
                        <input type="text" name="request" id="request" value="payment" hidden>
                        
                        <input type="text" list="tenants" name="tenants" class="form-control" required>
                        <datalist id="tenants">
                            <?php $__currentLoopData = $unpaidTenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e(ucwords($tenant->full_name)); ?>" class="dropdown-item"></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </datalist>

                        
                        <br>

                        <span>Is this a Payment or Pass? Please double check your input.</span>
                        <select name="option" id="option" class="form-control" required>
                            <option value="" selected disabled>Select An Option</option>
                            <option value="Payment">Payment</option>
                            <option value="Pass">Pass</option>
                        </select>
                        
                    </div>
                </div>
                <br>
                <span class="text-primary">NOTE:</span> This will record only be for TODAY.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Payment-->
<div class="modal fade" id="newExpenses" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="<?php echo e(route('expenses.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">You Are Adding New Expenses Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">

                        <label for="branch" class="form-label mt-3">Select Branch</label>
                        <select name="branch" class="form-select" required>
                            <option value="" selected disabled>Select an option</option>
                            <option value="Jacinto Ignacio Market">Jacinto Ignacio Market</option>
                            <option value="Jacinto Market">Jacinto Market</option>
                            <option value="House of Saint">House of Saint</option>
                            <option value="Other businesses">Other businesses</option>
                        </select>

                        <label for="branch" class="form-label mt-3">Select Type of Expense</label>
                        <select name="choice_1" onchange="showDropdown(this.value)" class="form-select mb-3" required>
                            <option value="" selected disabled>Select an option</option>
                            <option value="Operating Expense">Operating Expense</option>
                            <option value="Personal Expense">Personal Expense</option>
                            <option value="Cash Deposit">Cash Deposit</option>
                        </select>
                        
                        <div id="dropdown-container"></div>
    
                        <label for="amount" class="form-label mt-3">Enter Amount of Expense Record</label>
                        <input class="form-control" type="number" name="amount" value="" required/>

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

<!-- Modal Miscellaneous-->
<div class="modal fade" id="newMisc" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="<?php echo e(route('misc.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">You Are Adding New Miscellaneous Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">

                        <label for="branch" class="form-label mt-3">Select Type of Miscellaneous</label>
                        <select name="misc" class="form-select" required>
                            <option value="" selected disabled>Select an option</option>
                            <option value="Power">Power</option>
                            <option value="Water">Water</option>
                        </select>
    
                        <label for="amount" class="form-label mt-3">Enter Amount</label>
                        <input class="form-control" type="number" name="amount" value="" required/>

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

<script>
    function showDropdown(selectedOption) {
        const container = document.getElementById('dropdown-container');
        container.innerHTML = ''; // Clear previous dropdown content

        if (selectedOption === 'Operating Expense') {
            container.innerHTML = `
                <label for="tenant-name" class="form-label">Select Options for Operating Expense</label>
                <select name="choice_2" class="form-select mt-2" required>
                    <option value="" selected disabled>Select an Option</option>
                    <option value="Wages">Wages</option>
                    <option value="Power">Power</option>
                    <option value="Water">Water</option>
                    <option value="Internet">Internet</option>
                    <option value="Repair & Maintenance">Repair & Maintenance</option>
                    <option value="Travel & Transportation">Travel & Transportation</option>
                    <option value="Taxes & Licenses">Taxes & Licenses</option>
                </select>
            `;
        } else if (selectedOption === 'Personal Expense') {
            container.innerHTML = `
                <label for="tenant-name" class="form-label">Select Options for Personal Expense</label>
                <select name="choice_2" class="form-select" required>
                    <option value="" selected disabled>Select an Option</option>
                    <option value="Credit Card Payment">Credit Card Payment</option>
                    <option value="Medicine">Medicine</option>
                    <option value="Food & Beverages">Food & Beverages</option>
                    <option value="Monetary Assistance">Monetary Assistance</option>
                </select>
            `;
        }else{
            container.innerHTML = `
                <label for="tenant-name" class="form-label">Select Options for Cash Deposit</label>
                <select name="choice_2" class="form-select" required>
                    <option value="" selected disabled>Select an Option</option>
                    <option value="Banks">Banks</option>
                    <option value="SVCC">SVCC</option>
                </select>
            `;
        }
    }
</script>
<?php echo $__env->make('layouts/blankLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\John Ezekiel B. Lim\Desktop\jim-tenant-management-system\resources\views/encoder/dashboard.blade.php ENDPATH**/ ?>