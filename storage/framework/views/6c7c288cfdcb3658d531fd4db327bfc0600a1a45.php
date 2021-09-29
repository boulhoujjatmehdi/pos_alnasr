 <?php $__env->startSection('content'); ?>

<?php if(session()->has('message')): ?>
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('message')); ?></div> 
<?php endif; ?>
<?php if(session()->has('not_permitted')): ?>
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div> 
<?php endif; ?>
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4><?php echo e(trans('file.HRM Setting')); ?></h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                        <?php echo Form::open(['route' => 'setting.hrmStore', 'files' => true, 'method' => 'post']); ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(trans('file.Default CheckIn')); ?> *</label>
                                        <input type="text" name="checkin" id="checkin" class="form-control" value="<?php if($lims_hrm_setting_data): ?><?php echo e($lims_hrm_setting_data->checkin); ?><?php endif; ?>" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(trans('file.Default CheckOut')); ?></label>
                                        <input type="text" name="checkout" id="checkout" class="form-control" value="<?php if($lims_hrm_setting_data): ?><?php echo e($lims_hrm_setting_data->checkout); ?><?php endif; ?>" required />
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <button type="submit" class="btn btn-primary"><?php echo e(trans('file.submit')); ?></button>
                                </div>             
                            </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $("ul#setting").siblings('a').attr('aria-expanded','true');
    $("ul#setting").addClass("show");
    $("ul#setting #hrm-setting-menu").addClass("active");

    $('#checkin, #checkout').timepicker({
        'step': 15,
        
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devup/Desktop/laravel apps/saleproposV2/resources/views/setting/hrm_setting.blade.php ENDPATH**/ ?>