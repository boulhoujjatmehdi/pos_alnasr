 <?php $__env->startSection('content'); ?>
<?php if(session()->has('message')): ?>
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('message')); ?></div> 
<?php endif; ?>
<?php if(session()->has('not_permitted')): ?>
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div> 
<?php endif; ?>

<section>
    <div class="container-fluid">
        <button class="btn btn-info" data-toggle="modal" data-target="#create-money-transfer-modal"><i class="dripicons-plus"></i> <?php echo e(trans('file.Add Money Transfer')); ?></button>
    </div>
    <div class="table-responsive">
        <table id="money-transfer-table" class="table">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th><?php echo e(trans('file.Date')); ?></th>
                    <th><?php echo e(trans('file.Reference No')); ?></th>
                    <th><?php echo e(trans('file.From Account')); ?></th>
                    <th><?php echo e(trans('file.To Account')); ?></th>
                    <th><?php echo e(trans('file.Amount')); ?></th>
                    <th class="not-exported"><?php echo e(trans('file.action')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $lims_money_transfer_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$money_transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr data-id="<?php echo e($money_transfer->id); ?>">
                    <td><?php echo e($key); ?></td>
                    <td><?php echo e(date($general_setting->date_format, strtotime($money_transfer->created_at->toDateString())) . ' '. $money_transfer->created_at->toTimeString()); ?></td>
                    <td><?php echo e($money_transfer->reference_no); ?></td>
                    <td><?php echo e($money_transfer->fromAccount->name); ?></td>
                    <td><?php echo e($money_transfer->toAccount->name); ?></td>
                    <td><?php echo e(number_format((float)$money_transfer->amount, 2, '.', '')); ?></td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(trans('file.action')); ?>

                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li><button type="button" id="edit-btn" data-id="<?php echo e($money_transfer->id); ?>" data-from_id="<?php echo e($money_transfer->from_account_id); ?>" data-to_id="<?php echo e($money_transfer->to_account_id); ?>" data-amount="<?php echo e($money_transfer->amount); ?>"  class=" btn btn-link" data-toggle="modal" data-target="#edit-money-transfer-modal"><i class="dripicons-document-edit"></i> <?php echo e(trans('file.edit')); ?></button></li>
                                <li class="divider"></li>
                                <?php echo e(Form::open(['route' => ['money-transfers.destroy', $money_transfer->id], 'method' => 'DELETE'] )); ?>

                                <li>
                                    <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="dripicons-trash"></i> <?php echo e(trans('file.delete')); ?></button>
                                </li>
                                <?php echo e(Form::close()); ?>

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
            </tfoot>
        </table>
    </div>
</section>

<!-- Create Money Transfer modal -->
<div id="create-money-transfer-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Add Money Transfer')); ?></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
              <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                <?php echo Form::open(['route' => 'money-transfers.store', 'method' => 'post']); ?>

                  <div class="row">
                      <div class="col-md-6 form-group">
                          <label> <?php echo e(trans('file.From Account')); ?> *</label>
                          <select class="form-control selectpicker" name="from_account_id" data-live-search="true" data-live-search-style="begins" title="Select from account..." required>
                          <?php $__currentLoopData = $lims_account_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($account->id); ?>"><?php echo e($account->name); ?> [<?php echo e($account->account_no); ?>]</option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                      </div>
                      <div class="col-md-6 form-group">
                          <label> <?php echo e(trans('file.To Account')); ?> *</label>
                          <select class="form-control selectpicker" name="to_account_id" data-live-search="true" data-live-search-style="begins" title="Select to account..." required>
                          <?php $__currentLoopData = $lims_account_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($account->id); ?>"><?php echo e($account->name); ?> [<?php echo e($account->account_no); ?>]</option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                      </div>
                      
                      <div class="col-md-6 form-group">
                          <label><?php echo e(trans('file.Amount')); ?> *</label>
                          <input type="number" name="amount" class="form-control" step="any" required>
                      </div>
                  </div>
                  <div class="form-group">
                      <button type="submit" class="btn btn-primary"><?php echo e(trans('file.submit')); ?></button>
                  </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
</div>

<!-- Edit Money Transfer modal -->
<div id="edit-money-transfer-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Update Money Transfer')); ?></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                <?php echo Form::open(['route' => ['money-transfers.update', 1], 'method' => 'put']); ?>

                  <div class="row">
                        <input type="hidden" name="id">
                      <div class="col-md-6 form-group">
                          <label> <?php echo e(trans('file.From Account')); ?> *</label>
                          <select class="form-control selectpicker" name="from_account_id" data-live-search="true" data-live-search-style="begins" title="Select from account..." required>
                          <?php $__currentLoopData = $lims_account_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($account->id); ?>"><?php echo e($account->name); ?> [<?php echo e($account->account_no); ?>]</option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                      </div>
                      <div class="col-md-6 form-group">
                          <label> <?php echo e(trans('file.To Account')); ?> *</label>
                          <select class="form-control selectpicker" name="to_account_id" data-live-search="true" data-live-search-style="begins" title="Select to account..." required>
                          <?php $__currentLoopData = $lims_account_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($account->id); ?>"><?php echo e($account->name); ?> [<?php echo e($account->account_no); ?>]</option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                      </div>
                      
                      <div class="col-md-6 form-group">
                          <label><?php echo e(trans('file.Amount')); ?> *</label>
                          <input type="number" name="amount" class="form-control" step="any" required>
                      </div>
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

    $("ul#account").siblings('a').attr('aria-expanded','true');
    $("ul#account").addClass("show");
    $("ul#account #money-transfer-menu").addClass("active");

    var money_transfer_id = [];
    var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;
    
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $('#edit-btn').on('click', function() {
            $("#edit-money-transfer-modal select[name='from_account_id']").val($(this).data('from_id'));
            $("#edit-money-transfer-modal select[name='to_account_id']").val($(this).data('to_id'));
            $("#edit-money-transfer-modal input[name='id']").val($(this).data('id'));
            $("#edit-money-transfer-modal input[name='amount']").val($(this).data('amount'));
            $('.selectpicker').selectpicker('refresh');
        });
    })

function confirmDelete() {
    if (confirm("Are you sure want to delete?")) {
        return true;
    }
    return false;
}

    $('#money-transfer-table').DataTable( {
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
                'targets': [0, 6]
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
                        money_transfer_id.length = 0;
                        $(':checkbox:checked').each(function(i){
                            if(i){
                                money_transfer_id[i-1] = $(this).closest('tr').data('id');
                            }
                        });
                        if(money_transfer_id.length && confirm("Are you sure want to delete?")) {
                            $.ajax({
                                type:'POST',
                                url:'money_transfers/deletebyselection',
                                data:{
                                    money_transferIdArray: money_transfer_id
                                },
                                success:function(data){
                                    alert(data);
                                }
                            });
                            dt.rows({ page: 'current', selected: true }).remove().draw(false);
                        }
                        else if(!money_transfer_id.length)
                            alert('No money_transfer is selected!');
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

    /*if(all_permission.indexOf("money_transfers-delete") == -1)
        $('.buttons-delete').addClass('d-none');*/

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devup/Desktop/laravel apps/saleproposV2/resources/views/money_transfer/index.blade.php ENDPATH**/ ?>