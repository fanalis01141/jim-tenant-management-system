<?php $__env->startSection('title', 'Register Basic - Pages'); ?>

<?php $__env->startSection('page-style'); ?>
<!-- Page -->
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/css/pages/page-auth.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="container-xxxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">

        <!-- Register Card -->
        <div class="card">
            <div class="card-body">
            <div class="text-center">          
                <h4 class="mb-2">Jacinto Ignacio Market 🚀</h4>
                <p class="mb-4">Tenant Management System </p>
                <form method="POST" action="<?php echo e(route('register')); ?>">
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
        </div>
        <!-- Register Card -->
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/blankLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\John Ezekiel B. Lim\Desktop\jim-tenant-management-system\resources\views/auth/register.blade.php ENDPATH**/ ?>