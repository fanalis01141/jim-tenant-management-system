

<?php $__env->startSection('title', 'Add New Tenant - '); ?>

<?php $__env->startSection('page-style'); ?>
<!-- Page -->
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/css/pages/page-auth.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">

            <div class="col-md-6">
                <div class="card p-1">
                    <div class="card-header">
                        <h4 class="card-title">Add New User Information</h4>
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
                        <form method="POST" action="<?php echo e(route('user.store')); ?>">
                            <?php echo csrf_field(); ?>
                        
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-start"><?php echo e(__('Name')); ?></label>
                        
                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e(old('name')); ?>" required autocomplete="name" autofocus>
                        
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <div class="col-md-12 text-start">
                                    <label for="email" class="col-form-label"><?php echo e(__('Email Address')); ?></label>
                                    <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email">
                        
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                        
                            </div>
                        
                            <div class="row mb-3">
                                <label for="level" class="col-md-12 col-form-label text-md-start"><?php echo e(__('Level')); ?></label>
                        
                                <div class="col-md-12">
                                    <select name="level" id="level" class="form-control" required>
                                        <option value="" selected disabled>Select a role for user</option>
                                        <option value="admin" class="form-control">Admin</option>
                                        <option value="encoder" class="form-control">Encoder</option>
                                        <option value="viewer" class="form-control">Viewer</option>
                                    </select>
                                
                                    <?php $__errorArgs = ['level'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        
                        
                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-start"><?php echo e(__('Password')); ?></label>
                        
                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="new-password">
                        
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-12 col-form-label text-md-start"><?php echo e(__('Confirm Password')); ?></label>
                        
                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        
                            <div class="row mb-0">
                                <div class="col-md-12 text-center d-grid">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <?php echo e(__('Create Account')); ?>

                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card  p-1">
                    <div class="card-header">
                        <div class="card-title"><h4>List of Users</h4></div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 485px; overflow-y: auto; height: 485px;">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Access Level</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>

                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(ucwords($user->name)); ?>                                        </td>
                                        <td><?php echo e($user->email); ?></td>
                                        <td><?php echo e(ucwords($user->level)); ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="<?php echo e(url('user/' . $user->id . '/edit')); ?>"><i class="bx bx-edit-alt me-2"></i>Edit</a>
                                                    <a class="dropdown-item" onclick="deleteUser(<?php echo e($user->id); ?>)" data-id="<?php echo e($user->id); ?>" href="#"><i class="bx bx-trash me-2"></i>Delete</a>
                                                </div>
                                            </div>
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
function deleteUser(userId) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to restore this user",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
    if (willDelete) {
            fetch('/user/'+userId, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
            },
                }).then(response => {
                    swal({
                    title: "Deleted User",
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
<?php echo $__env->make('layouts/contentNavbarLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\John Ezekiel B. Lim\Desktop\jim-tenant-management-system\resources\views/user/add.blade.php ENDPATH**/ ?>