<div class="item-list" style="border: 1px solid lightgrey;">
    <?php if($row->discount_percent): ?>
        <div class="sale_info"><?php echo e($row->discount_percent); ?></div>
    <?php endif; ?>
        <div class="col-md-2 p-0 float-left" style="max-width: 112px;">
            <div class="thumb-image">
                <a href="<?php echo e($row->getDetailUrl()); ?>" target="_blank">
                    <?php if($row->image_url): ?>
                        <img src="<?php echo e($row->image_url); ?>" class="img-responsive" alt="">
                    <?php endif; ?>
                </a>
            </div>
        </div>
        <div class="col-md-10 float-right">
            <div class="float-left">
                <div class="item-title">
                    <a href="<?php echo e($row->getDetailUrl()); ?>" target="_blank">
                        <?php echo e($row->title); ?>

                    </a>
                </div>
                <div class="location">
                    <?php echo e(__("Location")); ?>:
                    <?php if(!empty($row->location->name)): ?>
                         <span><?php echo e($row->location->name ?? ''); ?></span>
                    <?php else: ?>
                        <span>---</span>
                    <?php endif; ?>
                </div>
                <div class="location mt-2">
                    <?php echo e(__("Posted")); ?>: <span><?php echo e(display_date($row->start_at)); ?></span>
                </div>
                <div class="location mt-2">
                    <?php echo e(__("Status")); ?>: <span class="job-status"><?php echo e(__($row->status)); ?></span>
                </div>
            </div>
            <div class="control-action float-right">
                
                
                <?php if(Auth::user()->hasPermissionTo('job_delete')): ?>
                    <a href="<?php echo e(route("job.vendor.delete",[$row->id])); ?>" class="btn btn-danger" data-confirm="<?php echo e(__('"Do you want to delete?"')); ?>>"><?php echo e(__("Delete")); ?></a>
                <?php endif; ?>
                <?php if($row->status == 'publish'): ?>
                    <a href="<?php echo e(route("job.vendor.bulk_edit",[$row->id,'action' => "make-hide"])); ?>" class="btn btn-light"><?php echo e(__("PAUSE")); ?></a>
                <?php endif; ?>
                <?php if(Auth::user()->hasPermissionTo('job_update')): ?>
                    <a href="<?php echo e(route("job.vendor.edit",[$row->id])); ?>" class="btn btn-light"><?php echo e(__("EDIT")); ?></a>
                <?php endif; ?>
                <?php if($row->status == 'draft'): ?>
                    <a href="<?php echo e(route("job.vendor.bulk_edit",[$row->id,'action' => "make-publish"])); ?>" class="btn btn-success"><?php echo e(__("RECOVERY")); ?></a>
                <?php endif; ?>
            </div>
        </div>

</div>
<?php /**PATH D:\Task\job\modules/Job/Views/frontend/vendorJob/loop-list.blade.php ENDPATH**/ ?>