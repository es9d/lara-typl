
<div class="container">
    <div class="path">
        <div class="mr-4">All jobs</div>
        <i class="far fa-chevron-double-right"></i>
        <div class="mr-4">Traning</div>
        <i class="far fa-chevron-double-right"></i>
        <div>Restaurant</div>
    </div>
    <div class="row">
        <div class="col-md-12 job-banner-image" style="background-image:url('<?php echo e($row->image_url); ?>') !important;"></div>
        <div class="col-md-8 job-detail">
            <?php if($translation->content): ?>
            <div class="heading">
                <div class="row m-0 p-0 col-md-12">
                    <div class="user_img col-sm-1" style="background-image:url('<?php echo e($row->image_url); ?>') !important;"></div>
                    <div class="col-md-8 name">Masala Ravintola</div>
                    <div class="col-md-3 text-right">Posted: 3 day ago</div>
                </div>
                <div></div>
            </div>
            <div class="content">
                <h4>Waiter/Waitress at an Indian restaurant in Helsinki centre.</h4>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="txt">Starting</div>
                        <div class="time">02:03:03</div>
                        <i class="fas fa-chart-bar mr-2 col-sm-1 pt-1"></i>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="txt">Location</div>
                        <div class="time">Helsinki</div>
                        <i class="fas fa-map-marker mr-2 col-sm-1 pt-1"></i>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="txt">Job duration</div>
                        <div class="time">3-6 months</div>
                        <i class="fa fa-circle mr-2 col-sm-1 pt-1"></i>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="txt">Job type</div>
                        <div class="time">Training</div>
                        <i class="fa fa-user mr-2 col-sm-1 pt-1"></i>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="txt">Salary</div>
                        <div class="time">-</div>
                        <i class="fa fa-sticky-note mr-2 col-sm-1 pt-1"></i>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="txt">Experience</div>
                        <div class="time">1-3 years</div>
                        <i class="far fa-star mr-2 col-sm-1 pt-1"></i>
                    </div>
                </div>
            </div>
            <div class="g-overview">  
                <div>
                    <h2><?php echo e(__("Description")); ?></h2>
                    <div class="description">
                        <?php echo $translation->content ?>
                    </div>    
                </div>
                <div>
                    <h2><?php echo e(__("How to apply")); ?></h2>  
                    <div class="how">
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequataute irure dolor in reprehenderit in voluptate.    
                    </div>
                    <div class="btn_group">
                        <button class="btn btn-danger float-right ml-5"><i class="fa fa-envelope mr-1"></i>Email</button>
                        <button class="btn btn-default float-right">Apply</button>
                    </div>
                </div> 
            </div>
            <?php endif; ?>
        </div>
        <div class="col-md-4 detail-right">
            <div class="col-sm-12 btn-group" role="group">
                <button class="btn btn-default"><i class="fa fa-share-alt"></i> Share</button>
                <button class="btn btn-primary">Apply job</button>
            </div>
            <div class="col-md-12 mt-5">
                <div class="location">
                    <label>Location</label>
                    <div class="picture"></div>
                </div>
            </div>
            <div class="col-md-12 mt-5">
                <div class="contact">
                    <label>Our contact</label>
                    <div><?php echo e($row->contact_email); ?></div>
                </div>
            </div>
        </div>
        <div class="similar_job col-md-12">
            <h3>Similar jobs</h3>
            <div class="col-xl-4 col-md-4 p-0">
                <?php echo $__env->make('Job::frontend.layouts.search.loop-list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
    
</div><?php /**PATH /home/znwaqgrx/public_html/modules/Job/Views/frontend/layouts/details/job-detail.blade.php ENDPATH**/ ?>