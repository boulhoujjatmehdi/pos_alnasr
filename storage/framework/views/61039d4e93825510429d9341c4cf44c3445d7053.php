 <?php $__env->startSection('content'); ?>
<?php if(session()->has('message')): ?>
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('message')); ?></div> 
<?php endif; ?>
<?php if(session()->has('not_permitted')): ?>
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div> 
<?php endif; ?>

<section>
    <div class="container-fluid">
      <?php if(in_array("expenses-add", $all_permission)): ?>
        <button class="btn btn-info" data-toggle="modal" data-target="#expense-modal"><i class="dripicons-plus"></i> <?php echo e(trans('file.Add Expense')); ?></button>
      <?php endif; ?>
    </div>
    <div class="table-responsive">
        <table id="expense-table" class="table">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th><?php echo e(trans('file.Date')); ?></th>
                    <th><?php echo e(trans('file.reference')); ?> No</th>
                    <th><?php echo e(trans('file.Warehouse')); ?></th>
                    <th><?php echo e(trans('file.category')); ?></th>
                    <th><?php echo e(trans('file.Amount')); ?></th>
                    <th><?php echo e(trans('file.Note')); ?></th>
                    <th class="not-exported"><?php echo e(trans('file.action')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $lims_expense_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $warehouse = DB::table('warehouses')->find($expense->warehouse_id);
                    $expense_category = DB::table('expense_categories')->find($expense->expense_category_id);
                ?>
                <tr data-id="<?php echo e($expense->id); ?>">
                    <td><?php echo e($key); ?></td>
                    <td><?php echo e(date($general_setting->date_format, strtotime($expense->created_at->toDateString())) . ' '. $expense->created_at->toTimeString('minute')); ?></td>
                    <td><?php echo e($expense->reference_no); ?></td>
                    <td><?php echo e($warehouse->name); ?></td>
                    <td><?php echo e($expense_category->name); ?></td>
                    <td><?php echo e(number_format((float)$expense->amount, 2, '.', '')); ?></td>
                    <td><?php echo e($expense->note); ?></td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(trans('file.action')); ?>

                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <?php if(in_array("expenses-edit", $all_permission)): ?>
                                <li><button type="button" data-id="<?php echo e($expense->id); ?>" class="open-Editexpense_categoryDialog btn btn-link" data-toggle="modal" data-target="#editModal"><i class="dripicons-document-edit"></i> <?php echo e(trans('file.edit')); ?></button></li>
                                <?php endif; ?>
                                <?php if(in_array("expenses-delete", $all_permission)): ?>
                                <li class="divider"></li>
                                <?php echo e(Form::open(['route' => ['expenses.destroy', $expense->id], 'method' => 'DELETE'] )); ?>

                                <li>
                                    <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="dripicons-trash"></i> <?php echo e(trans('file.delete')); ?></button>
                                </li>
                                <?php echo e(Form::close()); ?>

                                <?php endif; ?>
                            </ul>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot class="tfoot active">
                <th></th>
                <th><?php echo e(trans('file.Total')); ?></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tfoot>
        </table>
    </div>
</section>

<div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Update Expense')); ?></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
              <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                <?php echo Form::open(['route' => ['expenses.update', 1], 'method' => 'put']); ?>

                <?php 
                    $lims_expense_category_list = DB::table('expense_categories')->where('is_active', true)->get();
                    if(Auth::user()->role_id > 2)
                        $lims_warehouse_list = DB::table('warehouses')->where([
                            ['is_active', true],
                            ['id', Auth::user()->warehouse_id]
                        ])->get();
                    else
                        $lims_warehouse_list = DB::table('warehouses')->where('is_active', true)->get();
                ?>
                  <div class="form-group">
                      <input type="hidden" name="expense_id">
                      <label><?php echo e(trans('file.reference')); ?></label>
                      <p id="reference"><?php echo e('er-' . date("Ymd") . '-'. date("his")); ?></p>
                  </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label><?php echo e(trans('file.Expense Category')); ?> *</label>
                            <select name="expense_category_id" class="selectpicker form-control" required data-live-search="true" data-live-search-style="begins" title="Select Expense Category...">
                                <?php $__currentLoopData = $lims_expense_category_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($expense_category->id); ?>"><?php echo e($expense_category->name . ' (' . $expense_category->code. ')'); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label><?php echo e(trans('file.Warehouse')); ?> *</label>
                            <select name="warehouse_id" class="selectpicker form-control" required data-live-search="true" data-live-search-style="begins" title="Select Warehouse...">
                                <?php $__currentLoopData = $lims_warehouse_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($warehouse->id); ?>"><?php echo e($warehouse->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label><?php echo e(trans('file.Amount')); ?> *</label>
                            <input type="number" name="amount" step="any" required class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label> <?php echo e(trans('file.Account')); ?></label>
                            <select class="form-control selectpicker" name="account_id">
                            <?php $__currentLoopData = $lims_account_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($account->is_default): ?>
                                <option selected value="<?php echo e($account->id); ?>"><?php echo e($account->name); ?> [<?php echo e($account->account_no); ?>]</option>
                                <?php else: ?>
                                <option value="<?php echo e($account->id); ?>"><?php echo e($account->name); ?> [<?php echo e($account->account_no); ?>]</option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                  <div class="form-group">
                      <label><?php echo e(trans('file.Note')); ?></label>
                      <textarea name="note" rows="3" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                      <button type="submit" class="btn btn-primary"><?php echo e(trans('file.submit')); ?></button>
                  </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $("ul#expense").siblings('a').attr('aria-expanded','true');
    $("ul#expense").addClass("show");
    $("ul#expense #exp-list-menu").addClass("active");

    var expense_id = [];
    var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;
    var all_permission = <?php echo json_encode($all_permission) ?>;
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $('.open-Editexpense_categoryDialog').on('click', function() {
            var url = "expenses/"
            var id = $(this).data('id').toString();
            url = url.concat(id).concat("/edit");
            $.get(url, function(data) {
                $('#editModal #reference').text(data['reference_no']);
                $("#editModal select[name='warehouse_id']").val(data['warehouse_id']);
                $("#editModal select[name='expense_category_id']").val(data['expense_category_id']);
                $("#editModal select[name='account_id']").val(data['account_id']);
                $("#editModal input[name='amount']").val(data['amount']);
                $("#editModal input[name='expense_id']").val(data['id']);
                $("#editModal textarea[name='note']").val(data['note']);
                $('.selectpicker').selectpicker('refresh');
            });
        });
    })

function confirmDelete() {
    if (confirm("Are you sure want to delete?")) {
        return true;
    }
    return false;
}

    $('#expense-table').DataTable( {
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
                'targets': [0, 7]
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
                text: '<?php echo e(trans("file.delete")); ?>',
                className: 'buttons-delete',
                action: function ( e, dt, node, config ) {
                    if(user_verified == '1') {
                        expense_id.length = 0;
                        $(':checkbox:checked').each(function(i){
                            if(i){
                                expense_id[i-1] = $(this).closest('tr').data('id');
                            }
                        });
                        if(expense_id.length && confirm("Are you sure want to delete?")) {
                            $.ajax({
                                type:'POST',
                                url:'expenses/deletebyselection',
                                data:{
                                    expenseIdArray: expense_id
                                },
                                success:function(data){
                                    alert(data);
                                }
                            });
                            dt.rows({ page: 'current', selected: true }).remove().draw(false);
                        }
                        else if(!expense_id.length)
                            alert('No expense is selected!');
                    }
                    else
                        alert('This feature is disable for demo!');
                }
            },
            {
                extend: 'colvis',
                text: '<?php echo e(trans("file.Column visibility")); ?>',
                columns: ':gt(0)'
            },
        ],
        drawCallback: function () {
            var api = this.api();
            datatable_sum(api, false);
        }
    } );

    function datatable_sum(dt_selector, is_calling_first) {
        if (dt_selector.rows( '.selected' ).any() && is_calling_first) {
            var rows = dt_selector.rows( '.selected' ).indexes();
            $( dt_selector.column( 5 ).footer() ).html(dt_selector.cells( rows, 5, { page: 'current' } ).data().sum().toFixed(2));
        }
        else {
            $( dt_selector.column( 5 ).footer() ).html(dt_selector.cells( rows, 5, { page: 'current' } ).data().sum().toFixed(2));
        }
    }

    if(all_permission.indexOf("expenses-delete") == -1)
        $('.buttons-delete').addClass('d-none');

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devup/Desktop/laravel apps/saleproposV2/resources/views/expense/index.blade.php ENDPATH**/ ?>