<?php $general_setting = DB::table('general_settings')->find(1); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo e($general_setting->site_title); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <link rel="icon" type="image/png" href="<?php echo e(url('/logo', $general_setting->site_logo)); ?>" />
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo asset('/vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('/vendor/bootstrap/css/bootstrap-datepicker.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('/vendor/bootstrap/css/bootstrap-select.min.css') ?>" type="text/css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?php echo asset('/vendor/font-awesome/css/font-awesome.min.css') ?>" type="text/css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="<?php echo asset('/css/grasp_mobile_progress_circle-1.0.0.min.css') ?>" type="text/css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="<?php echo asset('/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') ?>" type="text/css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo asset('/css/style.default.css') ?>" id="theme-stylesheet" type="text/css">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php echo asset('/css/custom-'.$general_setting->theme) ?>" type="text/css">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

    <script type="text/javascript" src="<?php echo asset('/vendor/jquery/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo asset('/vendor/jquery/jquery-ui.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo asset('/vendor/popper.js/umd/popper.min.js') ?>">
</script>
<script type="text/javascript" src="<?php echo asset('/vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo asset('/vendor/bootstrap/js/bootstrap-select.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo asset('/js/grasp_mobile_progress_circle-1.0.0.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo asset('/vendor/jquery.cookie/jquery.cookie.js') ?>">
</script>
<script type="text/javascript" src="<?php echo asset('/vendor/jquery-validation/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo asset('/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')?>"></script>
<script type="text/javascript" src="<?php echo asset('/js/front.js') ?>"></script>
  </head>
  <body>
    <div class="page login-page">
      <div class="container">
        <div class="form-outer text-center d-flex align-items-center">
          <div class="form-inner">
            <div class="logo"><span><?php echo e($general_setting->site_title); ?></span></div>
            <form method="POST" action="<?php echo e(route('register')); ?>">
                <?php echo csrf_field(); ?>
              <div class="form-group-material">
                <input id="register-username" type="text" name="name" required class="input-material">
                <label for="register-username" class="label-material"><?php echo e(trans('file.UserName')); ?> *</label>
                <?php if($errors->has('name')): ?>
                    <p>
                        <strong><?php echo e($errors->first('name')); ?></strong>
                    </p>
                <?php endif; ?>
              </div>
              <div class="form-group-material">
                <input id="register-email" type="email" name="email" required class="input-material">
                <label for="register-email" class="label-material"><?php echo e(trans('file.Email')); ?> *</label>
                <?php if($errors->has('email')): ?>
                    <p>
                        <strong><?php echo e($errors->first('email')); ?></strong>
                    </p>
                <?php endif; ?>
              </div>
              <div class="form-group-material">
                <input id="register-phone" type="text" name="phone_number" required class="input-material">
                <label for="register-phone" class="label-material"><?php echo e(trans('file.Phone Number')); ?> *</label>
              </div>
              <div class="form-group-material">
                <input id="register-company" type="text" name="company_name" class="input-material">
                <label for="register-company" class="label-material"><?php echo e(trans('file.Company Name')); ?></label>
              </div>
              <div class="form-group-material">
                <select name="role_id" id="role-id" required class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Role...">
                  <?php $__currentLoopData = $lims_role_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
              <div id="customer-section">
                  <div class="form-group-material">
                    <input id="customer-name" type="text" name="customer_name" class="input-material customer-field">
                    <label for="customer-name" class="label-material"><?php echo e(trans('file.name')); ?> *</label>
                  </div>
                  <div class="form-group-material">
                    <select name="customer_group_id" required class="selectpicker form-control customer-field" data-live-search="true" data-live-search-style="begins" title="Select customer group...">
                      <?php $__currentLoopData = $lims_customer_group_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($customer_group->id); ?>"><?php echo e($customer_group->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                  <div class="form-group-material">
                    <input id="customer-tax-number" type="text" name="tax_no" class="input-material">
                    <label for="customer-tax-number" class="label-material"><?php echo e(trans('file.Tax Number')); ?></label>
                  </div>
                  <div class="form-group-material">
                    <input id="customer-address" type="text" name="address" class="input-material customer-field">
                    <label for="customer-address" class="label-material"><?php echo e(trans('file.Address')); ?> *</label>
                  </div>
                  <div class="form-group-material">
                    <input id="customer-city" type="text" name="city" class="input-material customer-field">
                    <label for="customer-city" class="label-material"><?php echo e(trans('file.City')); ?> *</label>
                  </div>
                  <div class="form-group-material">
                    <input id="customer-state" type="text" name="state" class="input-material">
                    <label for="customer-state" class="label-material"><?php echo e(trans('file.State')); ?></label>
                  </div>
                  <div class="form-group-material">
                    <input id="customer-postal" type="text" name="postal_code" class="input-material">
                    <label for="customer-postal" class="label-material"><?php echo e(trans('file.Postal Code')); ?></label>
                  </div>
                  <div class="form-group-material">
                    <input id="customer-country" type="text" name="country" class="input-material">
                    <label for="customer-country" class="label-material"><?php echo e(trans('file.Country')); ?></label>
                  </div>
              </div>
              <div class="form-group-material" id="biller-id">
                <select name="biller_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Biller*...">
                  <?php $__currentLoopData = $lims_biller_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $biller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($biller->id); ?>"><?php echo e($biller->name); ?> (<?php echo e($biller->phone_number); ?>)</option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
              <div class="form-group-material" id="warehouse-id">
                <select name="warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Warehouse*...">
                  <?php $__currentLoopData = $lims_warehouse_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($warehouse->id); ?>"><?php echo e($warehouse->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
              <div class="form-group-material">
                <input id="password" type="password" class="input-material" name="password" required>
                <label for="passowrd" class="label-material"><?php echo e(trans('file.Password')); ?> *</label>
                <?php if($errors->has('password')): ?>
                    <p>
                        <strong><?php echo e($errors->first('password')); ?></strong>
                    </p>
                <?php endif; ?>
              </div>
              <div class="form-group-material">
                <input id="password-confirm" type="password" name="password_confirmation" required class="input-material">
                <label for="password-confirm" class="label-material"><?php echo e(trans('file.Confirm Password')); ?> *</label>
              </div>
              <input id="register" type="submit" value="Register" class="btn btn-primary">
            </form><p><?php echo e(trans('file.Already have an account')); ?>? </p><a href="<?php echo e(url('login')); ?>" class="signup"><?php echo e(trans('file.LogIn')); ?></a>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      // ------------------------------------------------------- //
    // Material Inputs
    // ------------------------------------------------------ //

        var materialInputs = $('input.input-material');

        // activate labels for prefilled values
        materialInputs.filter(function() { return $(this).val() !== ""; }).siblings('.label-material').addClass('active');

        // move label on focus
        materialInputs.on('focus', function () {
            $(this).siblings('.label-material').addClass('active');
        });

        // remove/keep label on blur
        materialInputs.on('blur', function () {
            $(this).siblings('.label-material').removeClass('active');

            if ($(this).val() !== '') {
                $(this).siblings('.label-material').addClass('active');
            } else {
                $(this).siblings('.label-material').removeClass('active');
            }
        });
        $("#biller-id").hide();
        $("#warehouse-id").hide();
        $("#customer-section").hide();

        $("#role-id").on("change", function () {
            if($(this).val() == '5') {
              $("#customer-section").show(300);
              $(".customer-field").prop('required', true);
              $("#biller-id").hide(300);
              $("#warehouse-id").hide(300);
              $("select[name='biller_id']").prop('required', false);
              $("select[name='warehouse_id']").prop('required', false);
            }
            else if($(this).val() > 2) {
              $("#customer-section").hide(300);
              $("#biller-id").show(300);
              $("#warehouse-id").show(300);
              $("select[name='biller_id']").prop('required', true);
              $("select[name='warehouse_id']").prop('required', true);
              $(".customer-field").prop('required', false);
            }
            else {
              $("#biller-id").hide(300);
              $("#warehouse-id").hide(300);
              $("#customer-section").hide(300);
              $("select[name='biller_id']").prop('required', false);
              $("select[name='warehouse_id']").prop('required', false);
              $(".customer-field").prop('required', false);
            }
        });
    </script>
  </body>
</html><?php /**PATH /home/devup/Desktop/laravel apps/saleproposV2/resources/views/auth/register.blade.php ENDPATH**/ ?>