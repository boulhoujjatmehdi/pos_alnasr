<h1>Payment Details</h1>
<p><strong>Sale Reference: </strong><?php echo e($sale_reference); ?></p>
<p><strong>Payment Reference: </strong><?php echo e($payment_reference); ?></p>
<p><strong>Payment Method: </strong><?php echo e($payment_method); ?></p>
<p><strong>Grand Total: </strong><?php echo e($grand_total); ?> <?php echo e($general_setting->currency); ?></p>
<p><strong>Paid Amount: </strong><?php echo e($paid_amount); ?> <?php echo e($general_setting->currency); ?></p>
<p><strong>Due: </strong><?php echo e(number_format((float)($grand_total - $paid_amount), 2, '.', '')); ?> <?php echo e($general_setting->currency); ?></p>
<p>Thank You</p>
<?php /**PATH /home/devup/Desktop/laravel apps/saleproposV2/resources/views/mail/payment_details.blade.php ENDPATH**/ ?>