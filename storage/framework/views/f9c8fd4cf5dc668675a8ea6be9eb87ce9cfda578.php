 <?php $__env->startSection('content'); ?>
<?php if(session()->has('message')): ?>
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('message')); ?></div> 
<?php endif; ?>
<?php if(session()->has('not_permitted')): ?>
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo session()->get('not_permitted'); ?></div> 
<?php endif; ?>
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4><?php echo e(trans('file.Create SMS')); ?></h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.<strong><?php echo e(trans('file.Add mobile numbers by selecting the customers')); ?></strong></small></p>
                        <?php echo Form::open(['route' => 'setting.sendSms', 'method' => 'post']); ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="lims_customerSearch" id="lims_customerSearch" placeholder="Please type customer name or mobile no and select..." />
                                    </div>
                                    <div class="form-group twilio">
                                        <label><?php echo e(trans('file.Mobile')); ?> *</label>
                                        <input type="text" name="mobile" id="mobile" class="form-control" placeholder="example : +8801*********,+8801*********" required />
                                    </div>
                                    <div class="form-group twilio">
                                        <label><?php echo e(trans('file.Message')); ?> *</label>
                                        <textarea name="message" class="form-control" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> <?php echo e(trans('file.Send SMS')); ?></button> 
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
    $("ul#setting #create-sms-menu").addClass("active");

    <?php $customerArray = []; ?>
    var customer = [ <?php $__currentLoopData = $lims_customer_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $customerArray[] = $customer->name . ' [' . $customer->phone_number . ']';
        ?>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php
            echo  '"'.implode('","', $customerArray).'"';
            ?> ];

    var lims_customerSearch = $('#lims_customerSearch');

    lims_customerSearch.autocomplete({
        source: function(request, response) {
            var matcher = new RegExp(".?" + $.ui.autocomplete.escapeRegex(request.term), "i");
            response($.grep(customer, function(item) {
                return matcher.test(item);
            }));
        },
        response: function(event, ui) {
            if (ui.content.length == 1) {
                var data = ui.content[0].value;
                $(this).autocomplete( "close" );
                getNumber(data);
            };
        },
        select: function(event, ui) {
            var data = ui.item.value;
            event.preventDefault();
            getNumber(data);
        }
    });

    function getNumber(data) { 
        mobile_no = data.substring(data.indexOf("[")+1, data.indexOf("]") );
        if( !$('#mobile').val().includes(mobile_no) ){
            if($('#mobile').val() == '')
                $('#mobile').val(mobile_no);
            else
                $('#mobile').val( $('#mobile').val()+','+mobile_no );
        }
        $('#lims_customerSearch').val('');
    }

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devup/Desktop/laravel apps/saleproposV2/resources/views/setting/create_sms.blade.php ENDPATH**/ ?>