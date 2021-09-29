 <?php $__env->startSection('content'); ?>
<section>
	<div class="container-fluid">
		<div class="card"> 
			<div class="card-body"> 
				<?php echo e(Form::open(['route' => ['report.monthlyPurchaseByWarehouse', $year], 'method' => 'post', 'id' => 'report-form'])); ?>

				<input type="hidden" name="warehouse_id_hidden" value="<?php echo e($warehouse_id); ?>">
				<h4 class="text-center"><?php echo e(trans('file.Monthly Purchase Report')); ?> &nbsp;&nbsp;
				<select class="selectpicker" id="warehouse_id" name="warehouse_id">
					<option value="0"><?php echo e(trans('file.All Warehouse')); ?></option>
					<?php $__currentLoopData = $lims_warehouse_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($warehouse->id); ?>"><?php echo e($warehouse->name); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
				</h4>
				<div class="table-responsive mt-4">
					<table class="table table-bordered" style="border-top: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6;">
						<thead>
							<tr>
								<th><a href="<?php echo e(url('report/monthly_purchase/'.($year-1))); ?>"><i class="fa fa-arrow-left"></i> <?php echo e(trans('file.Previous')); ?></a></th>
						    	<th colspan="10" class="text-center"><?php echo e($year); ?></th>
						    	<th><a href="<?php echo e(url('report/monthly_purchase/'.($year+1))); ?>"><?php echo e(trans('file.Next')); ?> <i class="fa fa-arrow-right"></i></a></th>
						    </tr>
						</thead>
					    <tbody>
						    <tr>
						      <td><strong>January</strong></td>
						      <td><strong>February</strong></td>
						      <td><strong>March</strong></td>
						      <td><strong>April</strong></td>
						      <td><strong>May</strong></td>
						      <td><strong>June</strong></td>
						      <td><strong>July</strong></td>
						      <td><strong>August</strong></td>
						      <td><strong>September</strong></td>
						      <td><strong>October</strong></td>
						      <td><strong>November</strong></td>
						      <td><strong>December</strong></td>
						    </tr>
						    <tr>
						    	<?php $__currentLoopData = $total_discount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $discount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						        <td>
						        	<?php if($discount > 0): ?>
							      	<strong><?php echo e(trans("file.Product Discount")); ?></strong><br>
							      	<span><?php echo e($discount); ?></span><br><br>
							      	<?php endif; ?>
							      	<?php if($order_discount[$key] > 0): ?>
							      	<strong><?php echo e(trans("file.Order Discount")); ?></strong><br>
							      	<span><?php echo e($order_discount[$key]); ?></span><br><br>
							      	<?php endif; ?>
							      	<?php if($total_tax[$key] > 0): ?>
							      	<strong><?php echo e(trans("file.Product Tax")); ?></strong><br>
							      	<span><?php echo e($total_tax[$key]); ?></span><br><br>
							      	<?php endif; ?>
							      	<?php if($order_tax[$key] > 0): ?>
							      	<strong><?php echo e(trans("file.Order Tax")); ?></strong><br>
							      	<span><?php echo e($order_tax[$key]); ?></span><br><br>
							      	<?php endif; ?>
							      	<?php if($shipping_cost[$key] > 0): ?>
							      	<strong><?php echo e(trans("file.Shipping Cost")); ?></strong><br>
							      	<span><?php echo e($shipping_cost[$key]); ?></span><br><br>
							      	<?php endif; ?>
							      	<?php if($grand_total[$key] > 0): ?>
							      	<strong><?php echo e(trans("file.grand total")); ?></strong><br>
							      	<span><?php echo e($grand_total[$key]); ?></span><br>
							      	<?php endif; ?>
						        </td>
						        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						    </tr>
					    </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>	
</section>

<script type="text/javascript">

	$("ul#report").siblings('a').attr('aria-expanded','true');
    $("ul#report").addClass("show");
    $("ul#report #monthly-purchase-report-menu").addClass("active");

	$('#warehouse_id').val($('input[name="warehouse_id_hidden"]').val());
	$('.selectpicker').selectpicker('refresh');

	$('#warehouse_id').on("change", function(){
		$('#report-form').submit();
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devup/Desktop/laravel apps/saleproposV2/resources/views/report/monthly_purchase.blade.php ENDPATH**/ ?>