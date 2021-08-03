 <?php $__env->startSection('content'); ?>
<?php if($errors->has('coupon_no')): ?>
<div class="alert alert-danger alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e($errors->first('coupon_no')); ?></div>
<?php endif; ?>
<?php if(session()->has('message')): ?>
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo session()->get('message'); ?></div> 
<?php endif; ?>
<?php if(session()->has('not_permitted')): ?>
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div> 
<?php endif; ?>

<section>
    <div class="container-fluid">
        <button class="btn btn-info" data-toggle="modal" data-target="#create-modal"><i class="dripicons-plus"></i> <?php echo e(trans('file.Add Coupon')); ?></button>
    </div>
    <div class="table-responsive">
        <table id="coupon-table" class="table">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th><?php echo e(trans('file.Coupon Code')); ?></th>
                    <th><?php echo e(trans('file.Type')); ?></th>
                    <th><?php echo e(trans('file.Amount')); ?></th>
                    <th><?php echo e(trans('file.Minimum Amount')); ?></th>
                    <th>Qty</th>
                    <th><?php echo e(trans('file.Available')); ?></th>
                    <th><?php echo e(trans('file.Expired Date')); ?></th>
                    <th><?php echo e(trans('file.Created By')); ?></th>
                    <th class="not-exported"><?php echo e(trans('file.action')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $lims_coupon_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php 
                    $created_by = DB::table('users')->find($coupon->user_id);
                ?>
                <tr data-id="<?php echo e($coupon->id); ?>">
                    <td><?php echo e($key); ?></td>
                    <td><?php echo e($coupon->code); ?></td>
                    <?php if($coupon->type == 'percentage'): ?>
                    <td><div class="badge badge-primary"><?php echo e($coupon->type); ?></div></td>
                    <?php else: ?>
                    <td><div class="badge badge-info"><?php echo e($coupon->type); ?></div></td>
                    <?php endif; ?>
                    <td><?php echo e($coupon->amount); ?></td>
                    <?php if($coupon->minimum_amount): ?>
                    <td><?php echo e($coupon->minimum_amount); ?></td>
                    <?php else: ?>
                    <td>N/A</td>
                    <?php endif; ?>
                    <td><?php echo e($coupon->quantity); ?></td>
                    <?php if($coupon->quantity - $coupon->used): ?>
                    <td class="text-center"><div class="badge badge-success"><?php echo e($coupon->quantity - $coupon->used); ?></div></td>
                    <?php else: ?>
                    <td class="text-center"><div class="badge badge-danger"><?php echo e($coupon->quantity - $coupon->used); ?></div></td>
                    <?php endif; ?>
                    <?php if($coupon->expired_date >= date("Y-m-d")): ?>
                      <td><div class="badge badge-success"><?php echo e(date('d-m-Y', strtotime($coupon->expired_date))); ?></div></td>
                    <?php else: ?>
                      <td><div class="badge badge-danger"><?php echo e(date('d-m-Y', strtotime($coupon->expired_date))); ?></div></td>
                    <?php endif; ?>
                    <td><?php echo e($created_by->name); ?></td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(trans('file.action')); ?>

                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li><button type="button" data-id="<?php echo e($coupon->id); ?>" data-code="<?php echo e($coupon->code); ?>" data-type="<?php echo e($coupon->type); ?>" data-amount="<?php echo e($coupon->amount); ?>" data-minimum_amount="<?php echo e($coupon->minimum_amount); ?>" data-quantity="<?php echo e($coupon->quantity); ?>" data-expired_date="<?php echo e($coupon->expired_date); ?>" class="edit-btn btn btn-link" data-toggle="modal" data-target="#editModal"><i class="dripicons-document-edit"></i> <?php echo e(trans('file.edit')); ?></button></li>
                                <?php echo e(Form::open(['route' => ['coupons.destroy', $coupon->id], 'method' => 'DELETE'] )); ?>

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
                <th></th>
                <th></th>
                <th></th>
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

<div id="create-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Add Coupon')); ?></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
              <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                <?php echo Form::open(['route' => 'coupons.store', 'method' => 'post']); ?>

                  <div class="row">
                      <div class="col-md-6 form-group">
                          <label><?php echo e(trans('file.Coupon Code')); ?> *</label>
                          <div class="input-group">
                              <?php echo e(Form::text('code',null,array('required' => 'required', 'class' => 'form-control'))); ?>

                              <div class="input-group-append">
                                  <button type="button" class="btn btn-default btn-sm genbutton"><?php echo e(trans('file.Generate')); ?></button>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6 form-group">
                          <label><?php echo e(trans('file.Type')); ?> *</label>
                          <select class="form-control" name="type">
                            <option value="percentage">Percentage</option>
                            <option value="fixed">Fixed Amount</option>
                          </select>
                      </div>
                      <div class="col-md-6 form-group minimum-amount">
                          <label><?php echo e(trans('file.Minimum Amount')); ?> *</label>
                          <input type="number" name="minimum_amount" step="any" class="form-control">
                      </div>
                      <div class="col-md-6 form-group">
                          <label><?php echo e(trans('file.Amount')); ?> *</label>
                          <div class="input-group">
                              <input type="number" name="amount" step="any" required class="form-control">&nbsp;&nbsp;
                              <div class="input-group-append mt-1">
                                  <span class="icon-text" style="font-size: 22px;"><strong>%</strong></span>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6 form-group">
                          <label>Qty *</label>
                          <input type="number" name="quantity" step="any" required class="form-control">
                      </div>
                      <div class="col-md-6 form-group">
                          <label><?php echo e(trans('file.Expired Date')); ?></label>
                          <input type="text" name="expired_date" class="expired_date form-control">
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

<div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Update Coupon')); ?></h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
          </div>
          <div class="modal-body">
            <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
              <?php echo Form::open(['route' => ['coupons.update', 1], 'method' => 'put']); ?>

              <div class="row">
                <div class="col-md-6 form-group">
                    <label><?php echo e(trans('file.Coupon')); ?> <?php echo e(trans('file.Code')); ?> *</label>
                    <div class="input-group">
                        <input type="hidden" name="coupon_id">
                        <?php echo e(Form::text('code',null,array('required' => 'required', 'class' => 'form-control'))); ?>

                        <div class="input-group-append">
                            <button type="button" class="btn btn-default btn-sm genbutton"><?php echo e(trans('file.Generate')); ?></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <label><?php echo e(trans('file.Type')); ?> *</label>
                    <select class="form-control" name="type">
                      <option value="percentage">Percentage</option>
                      <option value="fixed">Fixed Amount</option>
                    </select>
                </div>
                <div class="col-md-6 form-group minimum-amount">
                    <label><?php echo e(trans('file.Minimum Amount')); ?> *</label>
                    <input type="number" name="minimum_amount" step="any" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label><?php echo e(trans('file.Amount')); ?> *</label>
                    <div class="input-group">
                        <input type="number" name="amount" step="any" required class="form-control">&nbsp;&nbsp;
                        <div class="input-group-append mt-1">
                            <span class="icon-text" style="font-size: 22px;"><strong>%</strong></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <label>Qty *</label>
                    <input type="number" name="quantity" step="any" required class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label><?php echo e(trans('file.Expired Date')); ?></label>
                    <input type="text" name="expired_date" class="expired_date form-control">
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

    $("ul#sale").siblings('a').attr('aria-expanded','true');
    $("ul#sale").addClass("show");
    $("ul#sale #coupon-menu").addClass("active");

    var coupon_id = [];
    var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#create-modal .expired_date").val($.datepicker.formatDate('yy-mm-dd', new Date()));
    $(".minimum-amount").hide();

    $("#create-modal select[name='type']").on("change", function() {
      if ($(this).val() == 'fixed') {
          $("#create-modal .minimum-amount").show();
          $("#create-modal .minimum-amount").prop('required',true);
          $("#create-modal .icon-text").text('$');
      } 
      else {
          $("#create-modal .minimum-amount").hide();
          $("#create-modal .minimum-amount").prop('required',false);
          $("#create-modal .icon-text").text('%');
      }
    });

    $("#editModal select[name='type']").on("change", function() {
      if ($(this).val() == 'fixed') {
          $("#editModal .minimum-amount").show();
          $("#editModal .minimum-amount").prop('required',true);
          $("#editModal .icon-text").text('$');
      } 
      else {
          $("#editModal .minimum-amount").hide();
          $("#editModal .minimum-amount").prop('required',false);
          $("#editModal .icon-text").text('%');
      }
    });

    $('#create-modal .genbutton').on("click", function(){
      $.get('coupons/gencode', function(data){
        $("input[name='code']").val(data);      
      });
    });

    $('#editModal .genbutton').on("click", function(){
      $.get('coupons/gencode', function(data){
        $("#editModal input[name='code']").val(data);
      });
    });

    $(document).ready(function() {
        $('.edit-btn').on('click', function() {
            $("#editModal input[name='code']").val($(this).data('code'));
            $("#editModal select[name='type']").val($(this).data('type'));
            $("#editModal input[name='amount']").val($(this).data('amount'));
            $("#editModal input[name='minimum_amount']").val($(this).data('minimum_amount'));
            $("#editModal input[name='quantity']").val($(this).data('quantity'));
            $("#editModal input[name='expired_date']").val($(this).data('expired_date'));
            $("#editModal input[name='coupon_id']").val($(this).data('id'));
            if($(this).data('type') == 'fixed'){
                $("#editModal .minimum-amount").show();
                $("#editModal .minimum-amount").prop('required',true);
                $("#editModal .icon-text").text('$');
            }
        });
    });

    var expired_date = $('.expired_date');
    expired_date.datepicker({
     format: "yyyy-mm-dd",
     startDate: "<?php echo date('Y-m-d'); ?>",
     autoclose: true,
     todayHighlight: true
     });

function confirmDelete() {
    if (confirm("Are you sure want to delete?")) {
        return true;
    }
    return false;
}

    var table = $('#coupon-table').DataTable( {
        responsive: true,
        fixedHeader: {
            header: true,
            footer: true
        },
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
                'targets': [0, 9]
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
                text: '<?php echo e(trans("file.delete")); ?>',
                className: 'buttons-delete',
                action: function ( e, dt, node, config ) {
                    if(user_verified == '1') {
                        coupon_id.length = 0;
                        $(':checkbox:checked').each(function(i){
                            if(i){
                                coupon_id[i-1] = $(this).closest('tr').data('id');
                            }
                        });
                        if(coupon_id.length && confirm("Are you sure want to delete?")) {
                            $.ajax({
                                type:'POST',
                                url:'coupons/deletebyselection',
                                data:{
                                    couponIdArray: coupon_id
                                },
                                success:function(data){
                                    alert(data);
                                }
                            });
                            dt.rows({ page: 'current', selected: true }).remove().draw(false);
                        }
                        else if(!coupon_id.length)
                            alert('No coupon is selected!');
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
        ]
    } );

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devup/Desktop/laravel apps/saleproposV2/resources/views/coupon/index.blade.php ENDPATH**/ ?>