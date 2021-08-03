 <?php $__env->startSection('content'); ?>
<?php if(session()->has('message')): ?>
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo session()->get('message'); ?></div> 
<?php endif; ?>
<section class="forms">
    <div class="container-fluid">
        <h3><?php echo e(trans('file.Account Statement')); ?></h3>
        <strong><?php echo e(trans('file.Account')); ?>:</strong> <?php echo e($lims_account_data->name); ?> [<?php echo e($lims_account_data->account_no); ?>]
    </div>
    <div class="table-responsive mb-4">
        <table id="account-table" class="table table-hover">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th><?php echo e(trans('file.date')); ?></th>
                    <th><?php echo e(trans('file.reference')); ?></th>
                    <th><?php echo e(trans('file.Credit')); ?></th>
                    <th><?php echo e(trans('file.Debit')); ?></th>
                    <th><?php echo e(trans('file.Balance')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $credit_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$credit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $balance = $balance + $credit->amount; ?>
                <tr>
                    <td><?php echo e($key); ?></td>
                    <td><?php echo e(date($general_setting->date_format, strtotime($credit->created_at->toDateString()))); ?></td>
                    <td><?php echo e($credit->payment_reference); ?></td>
                    <td><?php echo e(number_format((float)$credit->amount, 2, '.', '')); ?></td>
                    <td>0.00</td>
                    <td><?php echo e(number_format((float)$balance, 2, '.', '')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php $__currentLoopData = $recieved_money_transfer_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$recieved_money): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $balance = $balance + $recieved_money->amount; ?>
                <tr>
                    <td><?php echo e($key); ?></td>
                    <td><?php echo e(date($general_setting->date_format, strtotime($recieved_money->created_at->toDateString()))); ?></td>
                    <td><?php echo e($recieved_money->reference_no); ?></td>
                    <td><?php echo e(number_format((float)$recieved_money->amount, 2, '.', '')); ?></td>
                    <td>0.00</td>
                    <td><?php echo e(number_format((float)$balance, 2, '.', '')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php $__currentLoopData = $debit_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$debit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $balance = $balance - $debit->amount; ?>
                <tr>
                    <td><?php echo e($key); ?></td>
                    <td><?php echo e(date($general_setting->date_format, strtotime($debit->created_at->toDateString()))); ?></td>
                    <td><?php echo e($debit->payment_reference); ?></td>
                    <td>0.00</td>
                    <td><?php echo e(number_format((float)$debit->amount, 2, '.', '')); ?></td>
                    <td><?php echo e(number_format((float)$balance, 2, '.', '')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php $__currentLoopData = $return_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$return): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $balance = $balance - $return->grand_total; ?>
                <tr>
                    <td><?php echo e($key); ?></td>
                    <td><?php echo e(date($general_setting->date_format, strtotime($return->created_at->toDateString()))); ?></td>
                    <td><?php echo e($return->reference_no); ?></td>
                    <td>0.00</td>
                    <td><?php echo e(number_format((float)$return->grand_total, 2, '.', '')); ?></td>
                    <td><?php echo e(number_format((float)$balance, 2, '.', '')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php $__currentLoopData = $purchase_return_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$return): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $balance = $balance + $return->grand_total; ?>
                <tr>
                    <td><?php echo e($key); ?></td>
                    <td><?php echo e(date($general_setting->date_format, strtotime($return->created_at->toDateString()))); ?></td>
                    <td><?php echo e($return->reference_no); ?></td>
                    <td><?php echo e(number_format((float)$return->grand_total, 2, '.', '')); ?></td>
                    <td>0.00</td>
                    <td><?php echo e(number_format((float)$balance, 2, '.', '')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php $__currentLoopData = $expense_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $balance = $balance - $expense->amount; ?>
                <tr>
                    <td><?php echo e($key); ?></td>
                    <td><?php echo e(date($general_setting->date_format, strtotime($expense->created_at->toDateString()))); ?></td>
                    <td><?php echo e($expense->reference_no); ?></td>
                    <td>0.00</td>
                    <td><?php echo e(number_format((float)$expense->amount, 2, '.', '')); ?></td>
                    <td><?php echo e(number_format((float)$balance, 2, '.', '')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php $__currentLoopData = $payroll_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$payroll): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $balance = $balance - $payroll->amount; ?>
                <tr>
                    <td><?php echo e($key); ?></td>
                    <td><?php echo e(date($general_setting->date_format, strtotime($payroll->created_at->toDateString()))); ?></td>
                    <td><?php echo e($payroll->reference_no); ?></td>
                    <td>0.00</td>
                    <td><?php echo e(number_format((float)$payroll->amount, 2, '.', '')); ?></td>
                    <td><?php echo e(number_format((float)$balance, 2, '.', '')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php $__currentLoopData = $sent_money_transfer_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$sent_money): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $balance = $balance - $sent_money->amount; ?>
                <tr>
                    <td><?php echo e($key); ?></td>
                    <td><?php echo e(date($general_setting->date_format, strtotime($sent_money->created_at->toDateString()))); ?></td>
                    <td><?php echo e($sent_money->reference_no); ?></td>
                    <td>0.00</td>
                    <td><?php echo e(number_format((float)$sent_money->amount, 2, '.', '')); ?></td>
                    <td><?php echo e(number_format((float)$balance, 2, '.', '')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</section>

<script type="text/javascript">
    $("ul#account").siblings('a').attr('aria-expanded','true');
    $("ul#account").addClass("show");
    $("ul#account #account-statement-menu").addClass("active");

    var table = $('#account-table').DataTable( {
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
                }
            },
            {
                extend: 'csv',
                text: '<?php echo e(trans("file.CSV")); ?>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                }
            },
            {
                extend: 'print',
                text: '<?php echo e(trans("file.Print")); ?>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                }
            },
            {
                extend: 'colvis',
                text: '<?php echo e(trans("file.Column visibility")); ?>',
                columns: ':gt(0)'
            },
        ],
    } );

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devup/Desktop/laravel apps/saleproposV2/resources/views/account/account_statement.blade.php ENDPATH**/ ?>