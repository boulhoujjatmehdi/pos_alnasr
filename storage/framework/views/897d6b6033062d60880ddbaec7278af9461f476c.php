 <?php $__env->startSection('content'); ?>
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4><?php echo e(trans('file.Update Biller')); ?></h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                        <?php echo Form::open(['route' => ['biller.update', $lims_biller_data->id], 'method' => 'put', 'files' => true]); ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('file.name')); ?> *</strong> </label>
                                    <input type="text" name="name" value="<?php echo e($lims_biller_data->name); ?>" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('file.Image')); ?></label>
                                    <input type="file" name="image" class="form-control">
                                    <?php if($errors->has('image')): ?>
                                   <span>
                                       <strong><?php echo e($errors->first('image')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">   
                                <div class="form-group">
                                    <label><?php echo e(trans('file.Company Name')); ?> *</label>
                                    <input type="text" name="company_name" value="<?php echo e($lims_biller_data->company_name); ?>" required class="form-control">
                                    <?php if($errors->has('company_name')): ?>
                                   <span>
                                       <strong><?php echo e($errors->first('company_name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('file.VAT Number')); ?></label>
                                    <input type="text" name="vat_number" value="<?php echo e($lims_biller_data->vat_number); ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('file.Email')); ?> *</label>
                                    <input type="email" name="email" value="<?php echo e($lims_biller_data->email); ?>" required class="form-control">
                                    <?php if($errors->has('email')): ?>
                                   <span>
                                       <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('file.Phone Number')); ?> *</label>
                                    <input type="text" name="phone_number" value="<?php echo e($lims_biller_data->phone_number); ?>" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('file.Address')); ?> *</label>
                                    <input type="text" name="address" value="<?php echo e($lims_biller_data->address); ?>" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('file.City')); ?> *</label>
                                    <input type="text" name="city"  value="<?php echo e($lims_biller_data->city); ?>" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('file.State')); ?></label>
                                    <input type="text" name="state" value="<?php echo e($lims_biller_data->state); ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('file.Postal Code')); ?></label>
                                    <input type="text" name="postal_code" value="<?php echo e($lims_biller_data->postal_code); ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('file.Country')); ?></label>
                                    <input type="text" name="country" value="<?php echo e($lims_biller_data->country); ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mt-3">
                                    <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
                                </div>
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
    $("ul#people").siblings('a').attr('aria-expanded','true');
    $("ul#people").addClass("show");
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devup/Desktop/laravel apps/saleproposV2/resources/views/biller/edit.blade.php ENDPATH**/ ?>