<div class="row">                
    <div class="col-md-12">
        <div class="form-group">
            <label for="title" class="required" ><?php echo e(__("Job title")); ?></label>
            <input type="text" value="<?php echo e($translation->title); ?>" placeholder="<?php echo e(__("Job Title")); ?>" name="title" class="form-control required" required>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label required"><?php echo e(__("Job description")); ?></label>
            <div class="" style="border-radius: 10px">
                <textarea name="content" class="d-none has-ckeditor required" cols="30" rows="10"><?php echo e($translation->content); ?></textarea>
            </div>
        </div>
    </div>
</div>
<style>
.tox.tox-tinymce{
    border-radius: 10px;
}  
</style>
<?php /**PATH D:\Cloud\tyokokeilu.fi\modules/Job/Views/frontend/layouts/user/edit/content.blade.php ENDPATH**/ ?>