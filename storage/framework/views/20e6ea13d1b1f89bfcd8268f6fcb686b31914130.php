
<?php $__env->startSection('content'); ?>
    <div class="container-fluid" id="booking-core-template-detail" v-cloak="">
        <div class="d-flex justify-content-between mb20">
            <div class="">
                <h1 class="title-bar">
                    <?php if(!empty($row->id)): ?>
                        <?php echo e(__("Edit Template:")); ?> {{title}}
                    <?php else: ?>
                        <?php echo e(__('Create new template')); ?>

                    <?php endif; ?>
                </h1>
            </div>
        </div>
        <div class="alert" v-show="message.content" :class="message.type ? 'alert-success' : 'alert-danger'">{{message.content}}</div>
        <input type="text" class="form-control" value="<?php echo e($row->title ?? ''); ?>" v-model="title" placeholder="<?php echo e(__('Template Name')); ?>">
        <br>
        <br>
        <div class="row">
            <div class="col-md-4 col-xl-3 block-types-menu">
                <div class="panel">
                    <div class="panel-title"><?php echo e(__('All Blocks')); ?></div>
                    <div class="panel-body">
                        <div class="block-panel" v-for="block in blocks">
                            <div class="block-title">
                                {{block.name}}
                                <div class="title-right">
                                    <span class="menu-add"><i @click="addBlock(block)" class="icon ion-ios-add-circle-outline"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-xl-9">
                <?php echo $__env->make('Language::admin.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="lang-content-box">
                    <div class="panel">
                        <div class="panel-title"><?php echo e(__('Template Content')); ?></div>
                        <div class="panel-body">
                            <div class="templates-items-zone">
                                <draggable v-model="items">
                                    <component v-on:delete="deleteBlock" :parentindex="<?php echo e(1); ?>" :block="searchBlockById(item.type)" :is="item.component" :item="item" v-for="(item,index) in items" :index=index :key="index"></component>
                                </draggable>
                            </div>
                        </div>
                        <div class="panel-footer text-right">
                            <span class="alert-text" v-show="message.content" :class="message.type ? 'success' : 'danger'">{{message.content}}</span>
                            <span class="btn btn-success" @click="saveTemplate"><?php echo e(__("Save Template")); ?>

                                <i class="fa fa-spin fa-spinner" v-show="onSaving"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade edit-block-item-modal" id="editBlockScreen" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" v-if="block.id" id="editBlockScreenApp">
                <div class="modal-header">
                    <h5 class="modal-title">{{block.name}}</h5>
                    <button type="button" @click="hideModal" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <vue-form-generator :schema="{fields:block.settings}" :model="model" :options="options"></vue-form-generator>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="hideModal" data-dismiss="modal">{{template_i18n.cancel}}</button>
                    <button type="button" class="btn btn-primary" @click="saveModal">{{template_i18n.save_changes}}</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var current_template_items = <?php echo json_encode($translation->content_json); ?>;
        var current_template_title = '<?php echo e($translation->title ?? ''); ?>';
        var template_id = <?php echo e($row->id ?? 0); ?>;
		var current_menu_lang = '<?php echo e(request()->query('lang',app()->getLocale())); ?>';
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script.head'); ?>
    <script>
        var template_i18n = {
            cancel: '<?php echo e(__('Cancel')); ?>',
            save_changes: '<?php echo e(__('Save changes')); ?>',
            delete_confirm: '<?php echo e(__('Are you want to delete?')); ?>',
            add_new: '<?php echo e(__('Add New')); ?>',
            index:<?php echo e($row->id); ?>,
        };
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\jobportal.sql\modules/Template/Views/admin/detail.blade.php ENDPATH**/ ?>