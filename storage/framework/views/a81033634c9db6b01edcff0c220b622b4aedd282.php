<?php $__env->startSection('head'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-template-content">
    <div class="container">
        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <div class="col-md-3 parent-card">
                <?php echo $__env->make('Job::frontend.layouts.user.profile-card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="col-md-9">
                <div class="user-profile-content">
                    <form action="<?php echo e(route('user.profile.update')); ?>" method="post" class="input-has-icon">
                        <div class="pl-4 mb-5 pb-5">           
                            <h2 class="title-bar">
                                <?php echo e(__("Profile")); ?>

                            </h2>
                            <?php echo csrf_field(); ?>
                            <input value="<?php echo e(old('business_name',$dataUser->business_name)); ?>" name="business_name" style="display:none">
                            <input name="email" value="<?php echo e(old('email',$dataUser->email)); ?>" style="display:none" >
                            <?php if($is_vendor_access): ?>
                            <div class="i-s-title pt-4">
                                <h6 class="panel-body-title w-100">Generals
                                    <button class="btn btn-action btn-danger" type="submit" style="float: right"><?php echo e(__('Save Changes')); ?></button>
                                    <a class="btn btn-action btn-default mr-2" style="float: right" href="<?php echo e(route('job.vendor.index')); ?>" ><?php echo e(__('Cancel')); ?></a>
                                </h6>
                            </div>              
                            <div class="form-row company">                
                                <div class="form-group col-md-6 ">
                                    <label class="required"><?php echo e(__("Company name")); ?></label>
                                    <input type="text" value="<?php echo e(old('business_name',$dataUser->business_name)); ?>" name="business_name" placeholder="<?php echo e(__("Business name")); ?>" class="form-control required" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="required"><?php echo e(__("Company ID")); ?></label>
                                    <input type="text" value="<?php echo e(old('business_id',$dataUser->business_id)); ?>" placeholder="<?php echo e(__("Business ID")); ?>" class="form-control required" disabled>
                                    
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="required"><?php echo e(__("Username")); ?></label>
                                    <input type="text" value="<?php echo e(old('email',$dataUser->email)); ?>" placeholder="<?php echo e(__("")); ?>" class="form-control required" disabled>
                                    
                                </div>
                                <div class="form-group col-md-6">
                                    <label><?php echo e(__("Category")); ?></label>
                                    <select name="" id="" class="form-control">
                                        <option value="">All</option>
                                    </select>
                                    
                                </div>
                                <div class="form-group col-md-6">
                                    <label><?php echo e(__("Name")); ?></label>
                                    <input type="text" value="<?php echo e(old('first_name',$dataUser->first_name)); ?>" name="first_name" placeholder="<?php echo e(__("First name")); ?>" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label><?php echo e(__("Last name")); ?></label>
                                    <input type="text" value="<?php echo e(old('last_name',$dataUser->last_name)); ?>" name="last_name" placeholder="<?php echo e(__("Last name")); ?>" class="form-control">
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="i-s-title pt-4">
                                <h6 class="panel-body-title">CONTACT</h6>
                            </div> 
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label><?php echo e(__("Phone")); ?></label>
                                    <input type="text" value="<?php echo e(old('phone',$dataUser->phone)); ?>" name="phone" placeholder="<?php echo e(__("Phone Number")); ?>" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label><?php echo e(__("Mobile")); ?></label>
                                    <input type="text" name="mobile" value="<?php echo e(old('mobile',$dataUser->mobile)); ?>" placeholder="<?php echo e(__("Mobile")); ?>" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="contact_email" class="required"><?php echo e(__("E-mail")); ?></label>
                                    <input type="text" name="contact_email" value="<?php echo e(old('contact_email',$dataUser->contact_email)); ?>" placeholder="<?php echo e(__("E-mail")); ?>" class="form-control required" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><?php echo e(__("Website")); ?></label>
                                    <input type="text" value="<?php echo e(old('Website',$dataUser->Website)); ?>" name="Website" placeholder="<?php echo e(__("Website")); ?>" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><?php echo e(__("Address")); ?></label>
                                    <input type="text" value="<?php echo e(old('address',$dataUser->address)); ?>" name="address" placeholder="<?php echo e(__("Address")); ?>" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="required"><?php echo e(__("City")); ?></label>
                                    <select name="city" class="form-control required" required>
                                        <option value=""><?php echo e(__("Select City")); ?></option>
                                        <?php
                                        $selected_city = $dataUser->city;
                                        $traverse = function ($locations , $prefix = '') use (&$traverse,$selected_city) {
                                            foreach ($locations as $location) {
                                                $selected = '';
                                                if ($selected_city == $location->id)
                                                    $selected = 'selected';
                                                printf("<option value='%s' %s style='color: black'>%s</option>", $location->id, $selected, $prefix . ' ' . $location->name);
                                            }
                                        };
                                        $traverse($locations);
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="i-s-title pt-4">
                                <h6 class="panel-body-title">ABOUT&nbspCOMPANY</h6>
                            </div> 
                            <div class="form-row">
                                <label><?php echo e(__("Tell About Your Company")); ?></label>
                                <textarea name="bio" rows="5" class="col-sm-12 p-3 tell_company"><?php echo e(old('bio',$dataUser->bio)); ?></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>
<style>
.tox.tox-tinymce{
    border-radius: 10px;
}    
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script type="text/javascript" src="<?php echo e(asset('libs/tinymce/js/tinymce/tinymce.min.js')); ?>" ></script>
    <script type="text/javascript" src="<?php echo e(asset('js/condition.js?_ver='.config('app.version'))); ?>"></script>
    <script>
        $('.img-company-logo')
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/znwaqgrx/public_html/modules/User/Views/frontend/profile.blade.php ENDPATH**/ ?>