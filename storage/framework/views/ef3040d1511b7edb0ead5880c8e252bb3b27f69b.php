<div class="item">
    <?php
        $param = request()->input();
        $orderby =  request()->input("orderby");
    ?>
    <span class="item-title mr-1">
        <?php echo e(__("Sort by : ")); ?>

    </span>
    <div class="dropdown">
        <span class=" dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <a href="">
                <?php switch($orderby):
                    case ("price_low_high"): ?>
                    <?php echo e(__("Price (Low to high)")); ?>

                    <?php break; ?>
                    <?php case ("price_high_low"): ?>
                    <?php echo e(__("Price (High to low)")); ?>

                    <?php break; ?>
                    <?php case ("rate_high_low"): ?>
                    <?php echo e(__("Rating (High to low)")); ?>

                    <?php break; ?>
                    <?php default: ?>
                    <?php echo e(__("Recommended")); ?>

                <?php endswitch; ?>
            </a>
        </span>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            <?php $param['orderby'] = "" ?>
            <a class="dropdown-item" href="<?php echo e(route("job.search",$param)); ?>"><?php echo e(__("Recommended")); ?></a>
            <?php $param['orderby'] = "price_low_high" ?>
            <a class="dropdown-item" href="<?php echo e(route("job.search",$param)); ?>"><?php echo e(__("Price (Low to high)")); ?></a>
            <?php $param['orderby'] = "price_high_low" ?>
            <a class="dropdown-item" href="<?php echo e(route("job.search",$param)); ?>"><?php echo e(__("Price (High to low)")); ?></a>
            <?php $param['orderby'] = "rate_high_low" ?>
            <a class="dropdown-item" href="<?php echo e(route("job.search",$param)); ?>"><?php echo e(__("Rating (High to low)")); ?></a>
        </div>
    </div>
</div><?php /**PATH D:\Task\2021-05-08(Vargar)\modules/Job/Views/frontend/layouts/search/orderby.blade.php ENDPATH**/ ?>