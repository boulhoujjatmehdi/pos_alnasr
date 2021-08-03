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
                        <h4><?php echo e(trans('file.POS Setting')); ?></h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                        <?php echo Form::open(['route' => 'setting.posStore', 'method' => 'post']); ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(trans('file.Default Customer')); ?> *</label>
                                        <?php if($lims_pos_setting_data): ?>
                                        <input type="hidden" name="customer_id_hidden" value="<?php echo e($lims_pos_setting_data->customer_id); ?>">
                                        <?php endif; ?>
                                        <select required name="customer_id" id="customer_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select customer...">
                                            <?php $__currentLoopData = $lims_customer_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->name . ' (' . $customer->phone_number . ')'); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo e(trans('file.Default Biller')); ?> *</label>
                                        <?php if($lims_pos_setting_data): ?>
                                        <input type="hidden" name="biller_id_hidden" value="<?php echo e($lims_pos_setting_data->biller_id); ?>">
                                        <?php endif; ?>
                                        <select required name="biller_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Biller...">
                                            <?php $__currentLoopData = $lims_biller_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $biller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($biller->id); ?>"><?php echo e($biller->name . ' (' . $biller->company_name . ')'); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(trans('file.Default Warehouse')); ?> *</label>
                                        <?php if($lims_pos_setting_data): ?>
                                        <input type="hidden" name="warehouse_id_hidden" value="<?php echo e($lims_pos_setting_data->warehouse_id); ?>">
                                        <?php endif; ?>
                                        <select required name="warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select warehouse...">
                                            <?php $__currentLoopData = $lims_warehouse_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($warehouse->id); ?>"><?php echo e($warehouse->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo e(trans('file.Displayed Number of Product Row')); ?> *</label>
                                        <input type="number" name="product_number" class="form-control" value="<?php if($lims_pos_setting_data): ?><?php echo e($lims_pos_setting_data->product_number); ?><?php endif; ?>" required />
                                    </div>
                                    <div class="form-group">
                                        <?php if($lims_pos_setting_data && $lims_pos_setting_data->keybord_active): ?>
                                        <input class="mt-2" type="checkbox" name="keybord_active" value="1" checked>
                                        <?php else: ?>
                                        <input class="mt-2" type="checkbox" name="keybord_active" value="1">
                                        <?php endif; ?>
                                        <label class="mt-2"><strong><?php echo e(trans('file.Touchscreen keybord')); ?></label>
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

    $("ul#setting").siblings('a').attr('aria-expanded','true');
    $("ul#setting").addClass("show");
    $("ul#setting #pos-setting-menu").addClass("active");

    

    $('select[name="customer_id"]').val($("input[name='customer_id_hidden']").val());
    $('select[name="biller_id"]').val($("input[name='biller_id_hidden']").val());
    $('select[name="warehouse_id"]').val($("input[name='warehouse_id_hidden']").val());
    $('.selectpicker').selectpicker('refresh');

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devup/Desktop/laravel apps/saleproposV2/resources/views/setting/pos_setting.blade.php ENDPATH**/ ?>