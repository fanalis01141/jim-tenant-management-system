

<?php $__env->startSection('title', 'Encoder Dashboard'); ?>

<?php $__env->startSection('page-style'); ?>
<!-- Page -->
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/css/pages/page-auth.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-between">
            <h1>Welcome to Your Dashboard, <span class="text-primary text-bold"><?php echo e(Auth::user()->name); ?></span></h1>
            <?php if(auth()->guard()->check()): ?>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            <?php endif; ?>
        </div>

        <div class="row mt-4 mb-4 text-start">
            <h3>View Report</h3>
            <div class="col-md-12">
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#byDate">View by Date</button>
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#byMonth">View by Month</button>
            </div>

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
                    <h3>Payments</h3>
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
                                        <th><?php echo e($paid->store_name); ?></th>
                                        <th><?php echo e($paid->option == 'Payment' ? number_format($paid->amount, 0, ',', ',') : 'N/A'); ?></th>
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
                <h3>Expenses</h3>
                    <h2><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#newExpenses">New Expenses</button></h2>
                </div>

                <div class="card-body">
                    <div class="divider divider-danger">
                        <div class="divider-text">Recent Cash-out/Expenses</div>
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
                                        <th><?php echo e(number_format($expenses->amount, 0, ',', ',')); ?></th>
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
                    <h3>Water</h3>
                    <h2><button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#newWater">New Water Misc Entry</button></h2>
                </div>
                <div class="card-body">
                    <div class="divider divider-primary">
                        <div class="divider-text">Recent Water Payments
                        </div>
                    </div>                    
                      
                    <div class="table-responsive" style="max-height: 150px; overflow-y: auto; height: 150px;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Store Name</th>
                                    <th>Amount</th>              
                                    <th>Date Paid</th>                                
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $miscWater; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th><?php echo e($m->store_name); ?></th>
                                        <th><?php echo e(number_format($m->amount, 0, ',', ',')); ?></th>
                                        <th><?php echo e(\Carbon\Carbon::parse($m->created_at)->format('F j, Y')); ?>                                        </th>
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
                    <h3>Electricity</h3>
                    <h2><button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#newElec">New Misc Entry</button></h2>
                </div>
                <div class="card-body">
                    <div class="divider divider-primary">
                        <div class="divider-text">Recent Electricity Payments
                        </div>
                    </div>                    
                      
                    <div class="table-responsive" style="max-height: 150px; overflow-y: auto; height: 150px;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Store Name</th>
                                    <th>Amount</th>              
                                    <th>Date</th>                                
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $miscElec; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th><?php echo e($m->store_name); ?></th>
                                        <th><?php echo e(number_format($m->amount, 0, ',', ',')); ?></th>
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
        <form class="modal-content" action="<?php echo e(route('payments.store')); ?>" method="POST">
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
                                <option value="<?php echo e(ucwords($tenant->store_name)); ?> - <?php echo e(ucwords($tenant->branch)); ?>" class="dropdown-item"></option>
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

<!-- Modal Expenses-->
<div class="modal fade" id="newExpenses" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="<?php echo e(route('expenses.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="modal-header">
            <h5 class="modal-title" id="backDropModalTitle">You Are Adding New Expenses</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <label for="nameBackdrop" class="form-label">Select Branch</label>
                    <select name="branch" class="form-select">
                        <option value="#" selected disabled>Select an option</option>
                        <option value="Jacinto Ignacio Market">Jacinto Ignacio Market</option>
                        <option value="Jacinto Market">Jacinto Market</option>
                        <option value="House of Saint">House of Saint</option>
                        <option value="Other Business">Other Business</option>
                    </select>
                    
                    <label for="nameBackdrop" class="form-label mt-3">Select Expenses</label>
                    <select id="dropdown" name="choice_1" class="form-select" onchange="showDropdown(this.value)">
                        <option value="#" selected disabled>Select an option</option>
                        <option value="Operating Expense">Operating Expense</option>
                        <option value="Personal Expense">Personal Expense</option>
                        <option value="Cash Deposit">Cash Deposit</option>
                    </select>
                
                    <div id="dropdown-container">
                        <!-- Dropdown content will be displayed here -->
                    </div>

                    <label for="nameBackdrop" class="form-label mt-3">Amount</label>
                    <input type="number" name="amount" class="form-control" required>

                    <label for="date" class="form-label mt-3">Select Date of Transaction</label>
                    <input class="form-control" type="date" name="date" value="<?php echo e(date ('Y-m-d')); ?>" required/>

                </div>
                <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Electricity-->
<div class="modal fade" id="newElec" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="<?php echo e(route('misc.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">You Are Adding New Electricity Expenses Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">

                        <label for="nameBackdrop" class="form-label">Store Name</label>
                        <input type="text" name="misc_type" value="electricity" hidden>
                        
                        <input type="text" list="tenantsWithElecUtility" name="store_name" class="form-control" required>
                        <datalist id="tenantsWithElecUtility">
                            <?php $__currentLoopData = $tenantsWithElecUtility; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e(ucwords($tenant->store_name)); ?> - <?php echo e(ucwords($tenant->branch)); ?>" class="dropdown-item"></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </datalist>
    
                        <label for="amount" class="form-label mt-3">Enter Amount</label>
                        <input class="form-control" type="number" name="amount" value="" required/>

                        <label for="date_paid" class="form-label mt-3">Select Date of Transaction</label>
                        <input class="form-control" type="date" name="date_paid" value="<?php echo e(date ('Y-m-d')); ?>" required/>

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

<!-- Modal Water-->
<div class="modal fade" id="newWater" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="<?php echo e(route('misc.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">You Are Adding New Water Expenses Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">

                        <label for="nameBackdrop" class="form-label">Store Name</label>
                        <input type="text" name="misc_type" value="water" hidden>
                        
                        <input type="text" list="tenantsWithWaterUtility" name="store_name" class="form-control" required>
                        <datalist id="tenantsWithWaterUtility">
                            <?php $__currentLoopData = $tenantsWithWaterUtility; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e(ucwords($tenant->store_name)); ?> - <?php echo e(ucwords($tenant->branch)); ?>" class="dropdown-item"></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </datalist>
    
                        <label for="amount" class="form-label mt-3">Enter Amount</label>
                        <input class="form-control" type="number" name="amount" value="" required/>

                        <label for="date_paid" class="form-label mt-3">Select Date of Transaction</label>
                        <input class="form-control" type="date" name="date_paid" value="<?php echo e(date ('Y-m-d')); ?>" required/>

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
        <form class="modal-content" action="<?php echo e(route('reports.monthly')); ?>" method="GET">
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

<!-- Modal By Date Report -->
<div class="modal fade" id="byDate" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="<?php echo e(route('reports.date')); ?>" method="GET">
            <?php echo csrf_field(); ?>

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


<?php $__env->stopSection(); ?>

<script>
    function showDropdown(selectedOption) {
        const container = document.getElementById('dropdown-container');
        container.innerHTML = ''; // Clear previous dropdown content

        if (selectedOption === 'Operating Expense') {
            container.innerHTML = `
                <label for="tenant-name" class="form-label mt-3">Select Options for Operating Expense</label>
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
                <label for="tenant-name" class="form-label mt-3">Select Options for Personal Expense</label>
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
                <label for="tenant-name" class="form-label mt-3">Select Options for Cash Deposit</label>
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