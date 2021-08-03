<h1>Return Details</h1>
<p><strong>Reference: </strong><?php echo e($reference_no); ?></p>
<h3>Order Table</h3>
<table style="border-collapse: collapse; width: 100%;">
	<thead>
		<th style="border: 1px solid #000; padding: 5px">#</th>
		<th style="border: 1px solid #000; padding: 5px">Product</th>
		<th style="border: 1px solid #000; padding: 5px">Qty</th>
		<th style="border: 1px solid #000; padding: 5px">Unit Price</th>
		<th style="border: 1px solid #000; padding: 5px">SubTotal</th>
	</thead>
	<tbody>
		<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr>
			<td style="border: 1px solid #000; padding: 5px"><?php echo e($key+1); ?></td>
			<td style="border: 1px solid #000; padding: 5px"><?php echo e($product); ?></td>
			<td style="border: 1px solid #000; padding: 5px"><?php echo e($qty[$key].' '.$unit[$key]); ?></td>
			<td style="border: 1px solid #000; padding: 5px"><?php echo e(number_format((float)($total[$key] / $qty[$key]), 2, '.', '')); ?></td>
			<td style="border: 1px solid #000; padding: 5px"><?php echo e($total[$key]); ?></td>
		</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<tr>
			<td colspan="2" style="border: 1px solid #000; padding: 5px"><strong>Total </strong></td>
			<td style="border: 1px solid #000; padding: 5px"><?php echo e($total_qty); ?></td>
			<td style="border: 1px solid #000; padding: 5px"></td>
			<td style="border: 1px solid #000; padding: 5px"><?php echo e($total_price); ?></td>
		</tr>
		<tr>
			<td colspan="4" style="border: 1px solid #000; padding: 5px"><strong>Order Tax </strong> </td>
			<td style="border: 1px solid #000; padding: 5px"><?php echo e($order_tax.'('.$order_tax_rate.'%)'); ?></td>
		</tr>
		<tr>
			<td colspan="4" style="border: 1px solid #000; padding: 5px"><strong>Grand Total</strong></td>
			<td style="border: 1px solid #000; padding: 5px"><?php echo e($grand_total); ?></td>
		</tr>
	</tbody>
</table>

<p>Thank You</p><?php /**PATH /home/devup/Desktop/laravel apps/saleproposV2/resources/views/mail/return_details.blade.php ENDPATH**/ ?>