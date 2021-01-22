<div class="item-list" style="border: 1px solid lightgrey;border-radius:15px;">
    <?php if($row->discount_percent): ?>
        <div class="sale_info"><?php echo e($row->discount_percent); ?></div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-3">
            <div class="thumb-image">
                <a href="<?php echo e($row->getDetailUrl()); ?>" target="_blank">
                    <?php if($row->image_url): ?>
                        <img src="<?php echo e($row->image_url); ?>" class="img-responsive" alt="">
                    <?php endif; ?>
                </a>
                <div class="service-wishlist <?php echo e($row->isWishList()); ?>" data-id="<?php echo e($row->id); ?>" data-type="<?php echo e($row->type); ?>">
                    <i class="fa fa-heart"></i>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="float-left">
                <div class="item-title">
                    <a href="<?php echo e($row->getDetailUrl()); ?>" target="_blank">
                        <?php echo e($row->title); ?>

                    </a>
                </div>
                <div class="location">
                    <?php if(!empty($row->location->name)): ?>
                        <i class="icofont-paper-plane"></i>
                        <?php echo e(__("Location")); ?>: <span><?php echo e($row->location->name ?? ''); ?></span>
                    <?php endif; ?>
                </div>
                <div class="location">
                    <i class="icofont-money"></i>
                    <?php echo e(__("Price")); ?>: <span class="sale-price"><?php echo e($row->display_sale_price_admin); ?></span> <span class="price"><?php echo e($row->display_price_admin); ?></span>
                </div>
                <div class="location">
                    <i class="icofont-ui-settings"></i>
                    <?php echo e(__("Status")); ?>: <span class="badge badge-<?php echo e($row->status); ?>"><?php echo e($row->status); ?></span>
                </div>
                <div class="location">
                    <i class="icofont-wall-clock"></i>
                    <?php echo e(__("Last Updated")); ?>: <span><?php echo e(display_datetime($row->updated_at ?? $row->created_at)); ?></span>
                </div>
            </div>
            <div class="control-action float-right">
                
                <?php if(!empty($recovery)): ?>
                    <a href="<?php echo e(route("job.vendor.restore",[$row->id])); ?>" class="btn btn-recovery btn-light" data-confirm="<?php echo e(__('"Do you want to recovery?"')); ?>"><?php echo e(__("Recovery")); ?></a>
                <?php endif; ?>
                <?php if(Auth::user()->hasPermissionTo('job_update')): ?>
                    <a href="<?php echo e(route("job.vendor.edit",[$row->id])); ?>" class="btn btn-light"><?php echo e(__("Edit")); ?></a>
                <?php endif; ?>
                <?php if(Auth::user()->hasPermissionTo('job_delete')): ?>
                    <a href="<?php echo e(route("job.vendor.delete",[$row->id])); ?>" class="btn btn-danger" data-confirm="<?php echo e(__('"Do you want to delete?"')); ?>>"><?php echo e(__("Delete")); ?></a>
                <?php endif; ?>
                
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\Web\Laravel\VarghaJob\tyokoleilu\tyokokeilu\modules/Job/Views/frontend/vendorJob/loop-list.blade.php ENDPATH**/ ?>