
<?php $__env->startSection('head'); ?>
    <link href="<?php echo e(asset('dist/frontend/module/job/css/job.css?_ver='.config('app.version'))); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("libs/ion_rangeslider/css/ion.rangeSlider.min.css")); ?>"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="bravo_search_job">
        <div class="bravo_banner" <?php if($bg = setting_item("job_page_search_banner")): ?> style="background-image: url(<?php echo e(get_file_url($bg,'full')); ?>)" <?php endif; ?> >
            <div class="container job_search_form">
                <h1>
                    <?php echo e(''); ?>

                </h1>
                <div class="bravo_form_search">
                    <?php echo $__env->make('Job::frontend.layouts.search.form-search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <span class="sub-title">Found  <?php echo e(count($rows)); ?> “Restaurant” Practice, Internship and Summer Jobs</span>
            </div>
        </div>
        <div class="container">
            <?php echo $__env->make('Job::frontend.layouts.search.list-item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    <?php echo $__env->make('Layout::parts.subscribe', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script type="text/javascript" src="<?php echo e(asset("libs/ion_rangeslider/js/ion.rangeSlider.min.js")); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('module/job/js/job.js?_ver='.config('app.version'))); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Cloud\tyokokeilu.fi\modules/Job/Views/frontend/search.blade.php ENDPATH**/ ?>