 <?php $__env->startSection('content'); ?>

<section class="forms">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header mt-2">
                <h3 class="text-center"><?php echo e(trans('file.Payment Report')); ?></h3>
            </div>
            <?php echo Form::open(['route' => 'report.paymentByDate', 'method' => 'post']); ?>

            <div class="col-md-6 offset-md-3 mt-3 mb-3">
                <div class="form-group row">
                    <label class="d-tc mt-2"><strong><?php echo e(trans('file.Choose Your Date')); ?></strong> &nbsp;</label>
                    <div class="d-tc">
                        <div class="input-group">
                            <input type="text" class="daterangepicker-field form-control" style="width:240px;" value="<?php echo e($start_date); ?> To <?php echo e($end_date); ?>" required />
                            <input type="hidden" name="start_date" />
                            <input type="hidden" name="end_date" />
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit"><?php echo e(trans('file.submit')); ?></button>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
    <div class="table-responsive mb-4">
        <table id="report-table" class="table table-hover">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th><?php echo e(trans('file.Date')); ?></th>
                    <th><?php echo e(trans('file.Payment Reference')); ?> </th>
                    <th><?php echo e(trans('file.Sale Reference')); ?></th>
                    <th><?php echo e(trans('file.Purchase Reference')); ?></th>
                    <th><?php echo e(trans('file.Paid By')); ?></th>
                    <th><?php echo e(trans('file.Amount')); ?></th>
                    <th><?php echo e(trans('file.Created By')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $lims_payment_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php 
                    $sale = DB::table('sales')->find($payment->sale_id);
                    $purchase = DB::table('purchases')->find($payment->purchase_id);
                    $user = DB::table('users')->find($payment->user_id);
                ?>
                <tr>
                    <td></td>
                    <td><?php echo e(date($general_setting->date_format, strtotime($payment->created_at->toDateString())) . ' '. $payment->created_at->toTimeString('minute')); ?></td>
                    <td><?php echo e($payment->payment_reference); ?></td>
                    <td><?php if($sale): ?><?php echo e($sale->reference_no); ?><?php endif; ?></td>
                    <td><?php if($purchase): ?><?php echo e($purchase->reference_no); ?><?php endif; ?></td>
                    <td><?php echo e($payment->paying_method); ?></td>
                    <td><?php echo e($payment->amount); ?></td>
                    <td><?php echo e($user->name); ?><br><?php echo e($user->email); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</section>

<script type="text/javascript">
    $("ul#report").siblings('a').attr('aria-expanded','true');
    $("ul#report").addClass("show");
    $("ul#report li#payment-report-menu").addClass("active");

    $('#report-table').DataTable( {
        "order": [],
        'language': {
            'lengthMenu': '_MENU_ <?php echo e(trans("file.records per page")); ?>',
             "info":      '<small><?php echo e(trans("file.Showing")); ?> _START_ - _END_ (_TOTAL_)</small>',
            "search":  '<?php echo e(trans("file.Search")); ?>',
            'paginate': {
                    'previous': '<i class="dripicons-chevron-left"></i>',
                    'next': '<i class="dripicons-chevron-right"></i>'
            }
        },
        'columnDefs': [
            {
                "orderable": false,
                'targets': 0
            },
            {
                'render': function(data, type, row, meta){
                    if(type === 'display'){
                        data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                    }

                   return data;
                },
                'checkboxes': {
                   'selectRow': true,
                   'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                },
                'targets': [0]
            }
        ],
        'select': { style: 'multi',  selector: 'td:first-child'},
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: '<"row"lfB>rtip',
        buttons: [
            {
                extend: 'pdf',
                text: '<?php echo e(trans("file.PDF")); ?>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
            },
            {
                extend: 'csv',
                text: '<?php echo e(trans("file.CSV")); ?>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
            },
            {
                extend: 'print',
                text: '<?php echo e(trans("file.Print")); ?>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
            },
            {
                extend: 'colvis',
                text: '<?php echo e(trans("file.Column visibility")); ?>',
                columns: ':gt(0)'
            }
        ],
    } );

$(".daterangepicker-field").daterangepicker({
  callback: function(startDate, endDate, period){
    var start_date = startDate.format('YYYY-MM-DD');
    var end_date = endDate.format('YYYY-MM-DD');
    var title = start_date + ' to ' + end_date;
    $(this).val(title);
    $('input[name="start_date"]').val(start_date);
    $('input[name="end_date"]').val(end_date);
  }
});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devup/Desktop/laravel apps/saleproposV2/resources/views/report/payment_report.blade.php ENDPATH**/ ?>