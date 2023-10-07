

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
                        <div class="col-md-6">
                            <span class="d-block mb-1">Total Expenses</span>
                            <h3 class="card-title mb-2"><?php echo e(number_format($totalExpenses, 0, '.', ',')); ?></h3>
                        </div>

                        <div class="col-md-6">
                            <span class="d-block mb-1">Number of Expenses</span>
                            <h3 class="card-title mb-2"><?php echo e($expensesCount); ?></h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Branch</th>
                                        <th>Expense Type</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                              <tbody>
                                    <?php $__currentLoopData = $expensesList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($e->branch); ?></td>
                                            <td><?php echo e($e->choice_1); ?> - <?php echo e($e->choice_2); ?></td>
                                            <td><?php echo e(number_format($e->amount, 0, '.', ',')); ?></td>
                                            <td class="align-items-start">
                                                <a class="btn btn-primary" id="editButton" href="#" 
                                                    onclick="editExpenses( <?php echo e($e->id); ?>, <?php echo e($e->amount); ?>, '<?php echo e($e->choice_1); ?>', '<?php echo e($e->choice_2); ?>', '<?php echo e($e->branch); ?>', '<?php echo e($e->date); ?>' ) ;">
                                                    <i class="bx bx-edit-alt me-2"></i>Edit</a>
                                                <a class="btn btn-danger" onclick="deleteExpenses(<?php echo e($e->id); ?>)" href="#"><i class="bx bx-trash me-2"></i>Delete</a>                                            
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
        <form class="modal-content" action="<?php echo e(route('expenses.update','editPayment')); ?>" method="POST">
            
            <?php echo method_field('PUT'); ?>
            <?php echo csrf_field(); ?>

            <div class="modal-header">
                <h5 class="modal-title" id="editModalTitle">Enter Updated Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col mb-3">
                    <input type="text" id="idInput" name="idInput" class="form-control" placeholder="Enter Name" hidden>
                </div>
            </div>



            <label for="nameBackdrop" class="form-label mt-3">Select Branch</label>
            <select name="branch" id="branch" class="form-control" required >
                <option value="" selected disabled>Select An Option</option>
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

            <label for="emailBackdrop" class="form-label mt-3">Amount</label>
            <input type="text" id="amountInput" name="amountInput" class="form-control">

            <label for="emailBackdrop" class="form-label mt-3">Date of Transaction</label>
            <input type="date" id="dateInput" name="dateInput" class="form-control" >

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>    

<script>

    function editExpenses(id, amount, choice_1, choice_2, branch, date){

        var editModal = document.getElementById('editModal');
        var idInput = document.getElementById('idInput');
        var amountInput = document.getElementById('amountInput');
        var dateInput = document.getElementById('dateInput');

        var editModalTitle = document.getElementById('editModalTitle');

        // Select option inside the branch
        var selectBranch = document.getElementById('branch');
        var selectChoice = document.getElementById('dropdown');
        var selectChoice2 = document.getElementById('dropdown-container');



        // Loop through the options and set the selected attribute on the matching option -- Branch
        for (var i = 0; i < selectBranch.options.length; i++) {
            if (selectBranch.options[i].value === branch) {
                selectBranch.options[i].selected = true;
                break; // Exit the loop once the correct option is found
            }
        }

        // Loop through the options and set the selected attribute on the matching option -- Choice1
        for (var i = 0; i < selectChoice.options.length; i++) {
            if (selectChoice.options[i].value === choice_1) {
                selectChoice.options[i].selected = true;
                break; // Exit the loop once the correct option is found
            }
        }

        showDropdown(choice_1, choice_2);

        //         // Loop through the options and set the selected attribute on the matching option -- Choice2
        // for (var i = 0; i < selectChoice2.options.length; i++) {
        //     if (selectChoice2.options[i].value === choice_2) {
        //         selectChoice2.options[i].selected = true;
        //         break; // Exit the loop once the correct option is found
        //     }
        // }


        idInput.value = id;
        amountInput.value = amount;
        dateInput.value = date;
        editModalTitle.innerHTML = "Editing information for " + "<span class='text-primary'>" + branch + "</span>";
        $(editModal).modal('show');
    }

    function showDropdown(selectedOption, selected) {
        const container = document.getElementById('dropdown-container');
        container.innerHTML = ''; // Clear previous dropdown content

        if (selectedOption === 'Operating Expense') {
            container.innerHTML = `
            <label for="tenant-name" class="form-label mt-3">Select Options for Operating Expense</label>
            <select name="choice_2" class="form-select mt-2" required>
                <option value="" selected disabled>Select an Option</option>
                <option value="Wages" ${selected === 'Wages' ? 'selected' : ''}>Wages</option>
                <option value="Power" ${selected === 'Power' ? 'selected' : ''}>Power</option>
                <option value="Water" ${selected === 'Water' ? 'selected' : ''}>Water</option>
                <option value="Internet" ${selected === 'Internet' ? 'selected' : ''}>Internet</option>
                <option value="Repair & Maintenance" ${selected === 'Repair & Maintenance' ? 'selected' : ''}>Repair & Maintenance</option>
                <option value="Travel & Transportation" ${selected === 'Travel & Transportation' ? 'selected' : ''}>Travel & Transportation</option>
                <option value="Taxes & Licenses" ${selected === 'Taxes & Licenses' ? 'selected' : ''}>Taxes & Licenses</option>
            </select>
            `;
        } else if (selectedOption === 'Personal Expense') {
            container.innerHTML = `
                <label for="tenant-name" class="form-label mt-3">Select Options for Personal Expense</label>
                <select name="choice_2" class="form-select" required>
                    <option value="" selected disabled>Select an Option</option>
                    <option value="Credit Card Payment" ${selected === 'Credit Card Payment' ? 'selected' : ''}>Credit Card Payment</option>
                    <option value="Medicine" ${selected === 'Medicine' ? 'selected' : ''}>Medicine</option>
                    <option value="Food & Beverages" ${selected === 'Food & Beverages' ? 'selected' : ''}>Food & Beverages</option>
                    <option value="Monetary Assistance" ${selected === 'Monetary Assistance' ? 'selected' : ''}>Monetary Assistance</option>
                </select>
            `;
        }else{
            container.innerHTML = `
            <label for="tenant-name" class="form-label mt-3">Select Options for Cash Deposit</label>
            <select name="choice_2" class="form-select" required>
                <option value="" selected disabled>Select an Option</option>
                <option value="Banks" ${selected === 'Banks' ? 'selected' : ''}>Banks</option>
                <option value="SVCC" ${selected === 'SVCC' ? 'selected' : ''}>SVCC</option>
            </select>
            `;
        }
    }

    function deleteExpenses(id) {
    swal({
        title: "Delete Expenses Record?",
        text: "Once deleted, you will not be able to restore this record",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            fetch('/expenses/'+id, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
            },
                }).then(response => {
            swal({
                title: "Expenses Deleted",
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


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/contentNavbarLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\John Ezekiel B. Lim\Desktop\jim-tenant-management-system\resources\views/admin/expenses/date.blade.php ENDPATH**/ ?>