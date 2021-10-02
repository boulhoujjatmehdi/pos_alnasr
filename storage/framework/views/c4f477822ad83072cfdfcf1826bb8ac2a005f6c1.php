 <?php $__env->startSection('content'); ?>

<section class="forms">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header mt-2">
                <h4 class="text-center"><?php echo e(trans('file.Due Report')); ?></h4>
            </div>
            <?php echo Form::open(['route' => 'report.dueByDate', 'method' => 'post']); ?>

            <div class="col-md-6 offset-md-3 mt-4 mb-3">
                <div class="form-group row">
                    <label class="d-tc mt-2"><strong><?php echo e(trans('file.Choose Your Date')); ?></strong> &nbsp;</label>
                    <div class="d-tc">
                        <div class="input-group">
                            <input type="text" class="daterangepicker-field form-control" style="width:240px;" style="width:250px;" value="<?php echo e($start_date); ?> To <?php echo e($end_date); ?>" required />
                            <input type="hidden" name="start_date" value="<?php echo e($start_date); ?>" />
                            <input type="hidden" name="end_date" value="<?php echo e($end_date); ?>" />
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
                    <th><?php echo e(trans('file.reference')); ?></th>
                    <th><?php echo e(trans('file.Customer Details')); ?></th>
                    <th><?php echo e(trans('file.Paid')); ?></th>
                    <th><?php echo e(trans('file.Due')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $lims_sale_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$sale_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($key); ?></td>
                    <td><?php echo e(date($general_setting->date_format, strtotime($sale_data->created_at->toDateString())) . ' '. $sale_data->created_at->toTimeString('minute')); ?></td>
                    <td><?php echo e($sale_data->reference_no); ?></td>
                    <?php
                        $customer = DB::table('customers')->find($sale_data->customer_id);
                    ?>
                    <td><?php echo e($customer->name .' (' .$customer->phone_number . ')'); ?></td>
                    <?php if($sale_data->paid_amount): ?>
                    <td><?php echo e(number_format((float)$sale_data->paid_amount, 2, '.', '')); ?></td>
                    <?php else: ?>
                    <td>0.00</td>
                    <?php endif; ?>
                    <td><?php echo e(number_format((float)($sale_data->grand_total - $sale_data->paid_amount), 2, '.', '')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot class="tfoot active">
                <th></th>
                <th><?php echo e(trans('file.Total')); ?>:</th>
                <th></th>
                <th></th>
                <th>0.00</th>
                <th>0.00</th>
            </tfoot>
        </table>
    </div>
</section>


<script type="text/javascript">

    $("ul#report").siblings('a').attr('aria-expanded','true');
    $("ul#report").addClass("show");
    $("ul#report #due-report-menu").addClass("active");

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
                action: function(e, dt, button, config) {
                    datatable_sum(dt, true);
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, config);
                    datatable_sum(dt, false);
                },
                footer:true
            },
            {
                extend: 'csv',
                text: '<?php echo e(trans("file.CSV")); ?>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum(dt, true);
                    $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, button, config);
                    datatable_sum(dt, false);
                },
                footer:true
            },
            {
                extend: 'print',
                text: '<?php echo e(trans("file.Print")); ?>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum(dt, true);
                    $.fn.dataTable.ext.buttons.print.action.call(this, e, dt, button, config);
                    datatable_sum(dt, false);
                },
                footer:true
            },
            {
                extend: 'colvis',
                text: '<?php echo e(trans("file.Column visibility")); ?>',
                columns: ':gt(0)'
            }
        ],
        drawCallback: function () {
            var api = this.api();
            datatable_sum(api, false);
        }
    } );

    function datatable_sum(dt_selector, is_calling_first) {
        if (dt_selector.rows( '.selected' ).any() && is_calling_first) {
            var rows = dt_selector.rows( '.selected' ).indexes();

            $( dt_selector.column( 4 ).footer() ).html(dt_selector.cells( rows, 4, { page: 'current' } ).data().sum().toFixed(2));
            $( dt_selector.column( 5 ).footer() ).html(dt_selector.cells( rows, 5, { page: 'current' } ).data().sum().toFixed(2));
        }
        else {
            $( dt_selector.column( 4 ).footer() ).html(dt_selector.column( 4, {page:'current'} ).data().sum().toFixed(2));
            $( dt_selector.column( 5 ).footer() ).html(dt_selector.column( 5, {page:'current'} ).data().sum().toFixed(2));
        }
    }

$(".daterangepicker-field").daterangepicker({
  callback: function(startDate, endDate, period){
    var start_date = startDate.format('YYYY-MM-DD');
    var end_date = endDate.format('YYYY-MM-DD');
    var title = start_date + ' To ' + end_date;
    $(this).val(title);
    $('input[name="start_date"]').val(start_date);
    $('input[name="end_date"]').val(end_date);
  }
});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devup/Desktop/laravel apps/saleproposV2/resources/views/report/due_report.blade.php ENDPATH**/ ?>