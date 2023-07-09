

<?php $__env->startSection('title', 'Add New Tenant - '); ?>

<?php $__env->startSection('page-style'); ?>
<!-- Page -->
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/css/pages/page-auth.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">     
            <div class="col-md-12">
                <div class="card  p-1">
                    <div class="card-header">
                        <div class="card-title"><h4>List of All Tenants</h4></div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 550px; overflow-y: auto; height: 550px;">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th>Name</th>
                                  <th>Branch</th>
                                  <th>Phone Number</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>

                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(ucwords($user->full_name)); ?>                                        </td>
                                        <td><?php echo e($user->branch); ?></td>
                                        <td><?php echo e($user->phone_number); ?></td>
                                        <td class="align-items-start">
                                            <a class="btn btn-primary" href="<?php echo e(url('user/' . $user->id . '/edit')); ?>"><i class="bx bx-edit-alt me-2"></i>Edit</a>
                                            <a class="btn btn-danger" onclick="deleteTenant(<?php echo e($user->id); ?>)" data-id="<?php echo e($user->id); ?>" href="#"><i class="bx bx-trash me-2"></i>Delete</a>

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
<?php $__env->stopSection(); ?>

<script>

    function deleteTenant(userId) {
        swal({
            title: "Delete Tenant?",
            text: "Once deleted, you will not be able to restore this tenant",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
        if (willDelete) {
                fetch('/tenants/'+userId, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                },
                    }).then(response => {
                        console.log(response);
                        swal({
                        title: "Deleted Tenant",
                        text: "You will be redirected to your dashboard.",
                        icon: "success",
                        button: "OK",
                    }).then(() => {
                        window.location.href = "/";
                    });
                });
            }
        });
    }
    
    
    </script>
<?php echo $__env->make('layouts/contentNavbarLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\John Ezekiel B. Lim\Desktop\jim-tenant-management-system\resources\views/tenant/all.blade.php ENDPATH**/ ?>