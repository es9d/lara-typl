
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex mb20">
            <h1 class="title-bar"><?php echo e(!empty($recovery) ? __('Recovery') : __("All Jobs")); ?></h1>
            <div class="title-actions ml-2">
                <?php if(empty($recovery)): ?>
                <a href="<?php echo e(route('job.admin.create')); ?>" class="btn btn-sm"><?php echo e(__("+ Add new Job")); ?></a>
                <?php endif; ?>
            </div>
        </div>
        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="filter-div d-flex justify-content-between ">
            <div class="col-left">
                <?php if(!empty($rows)): ?>
                    <form method="post" action="<?php echo e(route('job.admin.bulkEdit')); ?>" class="filter-form filter-form-left d-flex justify-content-start">
                        <?php echo e(csrf_field()); ?>

                        <select name="action" class="form-control">
                            <option value=""><?php echo e(__(" Bulk Actions ")); ?></option>
                            <option value="publish"><?php echo e(__(" Publish ")); ?></option>
                            <option value="draft"><?php echo e(__(" Move to Draft ")); ?></option>
                            <option value="pending"><?php echo e(__("Move to Pending")); ?></option>
                            
                            <?php if(!empty($recovery)): ?>
                                <option value="recovery"><?php echo e(__(" Recovery ")); ?></option>
                            <?php else: ?>
                                <option value="delete"><?php echo e(__(" Delete ")); ?></option>
                            <?php endif; ?>
                        </select>
                        <button data-confirm="<?php echo e(__("Do you want to delete?")); ?>" class="btn-danger btn btn-icon dungdt-apply-form-btn" type="button"><?php echo e(__('Apply')); ?></button>
                    </form>
                <?php endif; ?>
            </div>
            <div class="col-left">
                <form method="get" action="<?php echo e(!empty($recovery) ? route('job.admin.recovery') : route('job.admin.index')); ?> " class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row" role="search">
                    <?php if(!empty($rows) and $job_manage_others): ?>
                        <?php
                        $user = !empty(Request()->vendor_id) ? App\User::find(Request()->vendor_id) : false;
                        \App\Helpers\AdminForm::select2('vendor_id', [
                            'configs' => [
                                'ajax'        => [
                                    'url'      => url('/admin/module/user/getForSelect2'),
                                    'dataType' => 'json',
                                    'data' => array("user_type"=>"vendor")
                                ],
                                'allowClear'  => true,
                                'placeholder' => __('-- Vendor --')
                            ]
                        ], !empty($user->id) ? [
                            $user->id,
                            $user->name_or_email . ' (#' . $user->id . ')'
                        ] : false)
                        ?>
                    <?php endif; ?>
                    <input type="text" name="s" value="<?php echo e(Request()->s); ?>" placeholder="<?php echo e(__('Search by name')); ?>" class="form-control">
                    <button class="btn-danger btn btn-icon btn_search" type="submit"><?php echo e(__('Search')); ?></button>
                </form>
            </div>
        </div>
        <div class="text-right">
            <p><i><?php echo e(__('Found :total items',['total'=>$rows->total()])); ?></i></p>
        </div>
        <div class="panel border shadow">
            <div class="panel-body">
                <form action="" class="bravo-form-item">
                    <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th width="60px"><input type="checkbox" class="check-all"></th>
                            <th> <?php echo e(__('Name')); ?></th>
                            <th width="200px"> <?php echo e(__('Location')); ?></th>
                            <th width="130px"> <?php echo e(__('Author')); ?></th>
                            <th width="100px"> <?php echo e(__('Status')); ?></th>
                            <th width="100px"> <?php echo e(__('Date')); ?></th>
                            <th width="100px"> <?php echo e(__('Edit')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($rows->total() > 0): ?>
                            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="<?php echo e($row->status); ?>">
                                    <td><input type="checkbox" name="ids[]" class="check-item" value="<?php echo e($row->id); ?>">
                                    </td>
                                    <td class="title">
                                        <a href="<?php echo e(route('job.admin.edit',['id'=>$row->id])); ?>"><?php echo e($row->title); ?></a>
                                    </td>
                                    <td><?php echo e($row->location->name ?? ''); ?></td>
                                    <td class="text-nowrap">
                                        <?php if(!empty($row->author)): ?>
                                        <span class="user-avatar-table flex-shrink-0">
                                            <?php if($row->author->getAvatarUrl()): ?>
                                                <img class="image-responsive image-avatar" src="<?php echo e($row->author->getAvatarUrl()); ?>" alt="<?php echo e($row->author->getDisplayName()); ?>">
                                            <?php else: ?>
                                                <span class="avatar-text"><?php echo e(ucfirst($row->author->getDisplayName()[0])); ?></span>
                                            <?php endif; ?>         
                                            <?php echo e($row->author->getDisplayName()); ?>

                                        </span>                                   
                                        <?php else: ?>
                                            <?php echo e(__("[Author Deleted]")); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($row->status); ?></td>
                                    <td  class="text-nowrap"><?php echo e(display_job_start_date($row->created_at)); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                ...
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="<?php echo e(route('job.admin.edit',['id'=>$row->id])); ?>"><?php echo e(__("Edit Job")); ?></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7"><?php echo e(__("No Job found")); ?></td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                    </div>
                </form>
                <?php echo e($rows->appends(request()->query())->links()); ?>

            </div>
        </div>
    </div>
<style>
.user-avatar-table>.avatar-text{
    width: 30px;
    border-radius: 50%;
    text-align: center;
    background: #e67e22;
    color: #fff;
    font-size: 17px;
    display: inline-block;
    height: 32px;
    line-height: 32px;
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Task\2021-05-08(Vargar)\modules/Job/mobile/admin/index.blade.php ENDPATH**/ ?>