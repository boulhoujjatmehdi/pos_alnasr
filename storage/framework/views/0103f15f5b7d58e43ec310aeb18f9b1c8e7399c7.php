 <?php $__env->startSection('content'); ?>
<?php if($errors->has('card_no')): ?>
<div class="alert alert-danger alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e($errors->first('card_no')); ?></div>
<?php endif; ?>
<?php if(session()->has('message')): ?>
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo session()->get('message'); ?></div> 
<?php endif; ?>
<?php if(session()->has('not_permitted')): ?>
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div> 
<?php endif; ?>

<section>
    <div class="container-fluid">
        <button class="btn btn-info" data-toggle="modal" data-target="#gift_card-modal"><i class="dripicons-plus"></i> <?php echo e(trans('file.Add Gift Card')); ?></button>
    </div>
    <div class="table-responsive">
        <table id="gift_card-table" class="table">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th><?php echo e(trans('file.Card No')); ?></th>
                    <th><?php echo e(trans('file.customer')); ?></th>
                    <th><?php echo e(trans('file.Amount')); ?></th>
                    <th><?php echo e(trans('file.Expense')); ?></th>
                    <th><?php echo e(trans('file.Balance')); ?></th>
                    <th><?php echo e(trans('file.Created By')); ?></th>
                    <th><?php echo e(trans('file.Expired Date')); ?></th>
                    <th class="not-exported"><?php echo e(trans('file.action')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $lims_gift_card_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$gift_card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php 
                    $created_by = DB::table('users')->find($gift_card->created_by);
                ?>
                <tr data-id="<?php echo e($gift_card->id); ?>">
                    <td><?php echo e($key); ?></td>
                    <td><?php echo e($gift_card->card_no); ?></td>
                    <?php if($gift_card->customer_id): ?>
                    <?php $customer = DB::table('customers')->find($gift_card->customer_id);
                      $client = $customer->name;
                    ?>
                    <td><?php echo e($client); ?></td>
                    <?php else: ?>
                    <?php $user = DB::table('users')->find($gift_card->user_id);
                          $client = $user->name;
                     ?>
                    <td><?php echo e($client); ?></td>
                    <?php endif; ?>
                    <td><?php echo e($gift_card->amount); ?></td>
                    <td><?php echo e($gift_card->expense); ?></td>
                    <td><?php echo e($gift_card->amount - $gift_card->expense); ?></td>
                    <td><?php echo e($created_by->name); ?></td>
                    <?php if($gift_card->expired_date >= date("Y-m-d")): ?>
                      <td><div class="badge badge-success"><?php echo e(date('d-m-Y', strtotime($gift_card->expired_date))); ?></div></td>
                    <?php else: ?>
                      <td><div class="badge badge-danger"><?php echo e(date('d-m-Y', strtotime($gift_card->expired_date))); ?></div></td>
                    <?php endif; ?>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(trans('file.action')); ?>

                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li><button type="button" data-client="<?php echo e($client); ?>" data-card_no="<?php echo e($gift_card->card_no); ?>" data-amount="<?php echo e($gift_card->amount); ?>" data-expense="<?php echo e($gift_card->expense); ?>" data-expired_date="<?php echo e(date('d-m-Y', strtotime($gift_card->expired_date))); ?>" class="view-btn btn btn-link" data-toggle="modal" data-target="#viewModal"><i class="fa fa-eye"></i> <?php echo e(trans('file.View')); ?></button></li>
                                <li><button type="button" data-id="<?php echo e($gift_card->id); ?>" class="open-Edit_gift_card_Dialog btn btn-link" data-toggle="modal" data-target="#editModal"><i class="dripicons-document-edit"></i> <?php echo e(trans('file.edit')); ?></button></li>
                                <li><button type="button" data-id="<?php echo e($gift_card->id); ?>" class="recharge btn btn-link" data-toggle="modal" data-target="#rechargeModal"><i class="fa fa-money"></i> <?php echo e(trans('file.Recharge')); ?></button></li>
                                <li class="divider"></li>
                                <?php echo e(Form::open(['route' => ['gift_cards.destroy', $gift_card->id], 'method' => 'DELETE'] )); ?>

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
                <th></th>
                <th></th>
            </tfoot>
        </table>
    </div>
</section>

<div id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 id="exampleModalLabel" class="modal-title d-print-none"> <?php echo e(trans('file.Card Details')); ?> &nbsp;&nbsp;</h5>
              <button id="print-btn" type="button" class="btn btn-default btn-sm d-print-none"><i class="dripicons-print"></i> <?php echo e(trans('file.Print')); ?></button>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close d-print-none" id="close-btn"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
          </div>
          <div class="modal-body">
              <div class="gift-card" style="margin: 0 auto; max-width: 350px; position: relative; color:#fff;"><img src="<?php echo e(url('/images/gift_card/front.jpg')); ?>" width="350" height="200">
                <div style="position: absolute; padding: 15px; top:0; left: 0; width: 350px;">
                    <h3 class="d-inline">Gift Card</h3><h3 class="d-inline float-right"><?php echo e($general_setting->currency); ?> <span id="balance"></span></h3>
                    <p class="card-number" style="font-size: 28px;letter-spacing: 3px; margin-top: 15px;"></p>
                    <p class="client" style="text-transform: capitalize;margin-bottom: 10px;"></p>
                    <span class="valid" style="font-size: 11px;">Valid Thru</span>
                    <p class="valid-date" style="font-size: 11px;"></p>
                </div>
              </div>
              <br>
              <div class="gift-card" style="margin: 0 auto; max-width: 350px; position: relative; color:#fff;">
                <img src="<?php echo e(url('/images/gift_card/back.png')); ?>" width="350" height="200">
                <div class="site-title" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><?php if($general_setting->site_logo): ?>
                  <img src="<?php echo e(url('/logo', $general_setting->site_logo)); ?>" height="38px" width="38px">&nbsp;
                  <span style="font-size: 25px;"><?php endif; ?><?php echo e($general_setting->site_title); ?></span>
                </div>
              </div>
          </div>
      </div>
  </div>
</div>

<div id="gift_card-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Add Gift Card')); ?></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
              <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                <?php echo Form::open(['route' => 'gift_cards.store', 'method' => 'post']); ?>

                <?php 
                  $lims_warehouse_list = DB::table('warehouses')->where('is_active', true)->get();
                ?>
                  <div class="form-group">
                      <label><?php echo e(trans('file.Card No')); ?> *</label>
                      <div class="input-group">
                          <?php echo e(Form::text('card_no',null,array('required' => 'required', 'class' => 'form-control'))); ?>

                          <div class="input-group-append">
                              <button type="button" class="btn btn-default genbutton"><?php echo e(trans('file.Generate')); ?></button>
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <label><?php echo e(trans('file.Amount')); ?> *</label>
                      <input type="number" name="amount" step="any" required class="form-control">
                  </div>
                  <div class="form-group">
                      <label><?php echo e(trans('file.User List')); ?></label>&nbsp;
                      <input type="checkbox" id="user" name="user" value="1">
                  </div>
                  <div class="form-group user_list">
                      <label><?php echo e(trans('file.User')); ?> *</label>
                      <select name="user_id" class="selectpicker form-control" required data-live-search="true" data-live-search-style="begins" title="Select User...">
                          <?php $__currentLoopData = $lims_user_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($user->id); ?>"><?php echo e($user->name .' ('.$user->email.')'); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                  </div>
                  <div class="form-group customer_list">
                      <label><?php echo e(trans('file.customer')); ?> *</label>
                      <select name="customer_id" class="selectpicker form-control" required data-live-search="true" data-live-search-style="begins" title="Select Customer...">
                          <?php $__currentLoopData = $lims_customer_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->name .' ('.$customer->phone_number.')'); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <label><?php echo e(trans('file.Expired Date')); ?></label>
                      <input type="text" id="expired_date" name="expired_date" class="form-control">
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
              <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Update Gift Card')); ?></h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
          </div>
          <div class="modal-body">
            <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
              <?php echo Form::open(['route' => ['gift_cards.update', 1], 'method' => 'put']); ?>

              <?php 
                $lims_warehouse_list = DB::table('warehouses')->where('is_active', true)->get();
              ?>
                <div class="form-group">
                    <input type="hidden" name="gift_card_id">
                    <label><?php echo e(trans('file.Card No')); ?> *</label>
                    <div class="input-group">
                        <?php echo e(Form::text('card_no_edit',null,array('required' => 'required', 'class' => 'form-control'))); ?>

                        <div class="input-group-append">
                            <button type="button" class="btn btn-default genbutton"><?php echo e(trans('file.Generate')); ?></button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label><?php echo e(trans('file.Amount')); ?> *</label>
                    <input type="number" name="amount_edit" step="any" required class="form-control">
                </div>
                <div class="form-group">
                    <label><?php echo e(trans('file.User List')); ?> </label>&nbsp;
                    <input type="checkbox" id="user_edit" name="user_edit" value="1">
                </div>
                <div class="form-group user_list_edit">
                    <label><?php echo e(trans('file.User')); ?> *</label>
                    <select name="user_id_edit" class="selectpicker form-control" required data-live-search="true" data-live-search-style="begins" title="Select User...">
                        <?php $__currentLoopData = $lims_user_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->id); ?>"><?php echo e($user->name .' ('.$user->email.')'); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group customer_list_edit">
                    <label><?php echo e(trans('file.customer')); ?> *</label>
                    <select name="customer_id_edit" class="selectpicker form-control" required data-live-search="true" data-live-search-style="begins" title="Select Customer...">
                        <?php $__currentLoopData = $lims_customer_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->name .' ('.$customer->phone_number.')'); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label><?php echo e(trans('file.Expired Date')); ?></label>
                    <input type="text" id="expired_date_edit" name="expired_date_edit" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><?php echo e(trans('file.submit')); ?></button>
                </div>
              <?php echo e(Form::close()); ?>

          </div>
      </div>
  </div>
</div>

<div id="rechargeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 id="exampleModalLabel" class="modal-title"> <?php echo e(trans('file.Card No')); ?>: <span id="card-no"></span></h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
          </div>
          <div class="modal-body">
            <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
              <?php echo Form::open(['route' => ['gift_cards.recharge', 1], 'method' => 'post']); ?>

                <div class="form-group">
                    <input type="hidden" name="gift_card_id">
                    <label><?php echo e(trans('file.Amount')); ?> *</label>
                    <input type="number" name="amount" step="any" required class="form-control">
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
    $("ul#sale #gift-card-menu").addClass("active");

    var gift_card_id = [];
    var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#expired_date").val($.datepicker.formatDate('yy-mm-dd', new Date()));
    $(".user_list").hide();
    $("select[name='user_id']").prop('required',false);

    var expired_date = $('#expired_date');
    expired_date.datepicker({
     format: "yyyy-mm-dd",
     startDate: "<?php echo date('Y-m-d'); ?>",
     autoclose: true,
     todayHighlight: true
     });

    var expired_date = $('#expired_date_edit');
    expired_date.datepicker({
     format: "yyyy-mm-dd",
     startDate: "<?php echo date('Y-m-d'); ?>",
     autoclose: true,
     todayHighlight: true
     });

    $( ".view-btn" ).on("click", function() {
        $("#balance").text($(this).data('amount') - $(this).data('expense'));
        $(".valid-date").text($(this).data('expired_date'));
        $(".client").text($(this).data('client'));
        $(".card-number").text($(this).data('card_no'));
    });

    $( "#user" ).on("change", function() {
        if ($(this).is(':checked')) {
            $(".user_list").show();
            $(".customer_list").hide();
            $("select[name='user_id']").prop('required',true);
            $("select[name='customer_id']").prop('required',false);
        } 
        else {
            $(".user_list").hide();
            $(".customer_list").show();
            $("select[name='user_id']").prop('required',false);
            $("select[name='customer_id']").prop('required',true);
        }
    });

    $( "#user_edit" ).on("change", function() {
        if ($(this).is(':checked')) {
            $(".user_list_edit").show();
            $(".customer_list_edit").hide();
            $("select[name='user_id_edit']").prop('required',true);
            $("select[name='customer_id_edit']").prop('required',false);
        }
        else {
            $(".user_list_edit").hide();
            $(".customer_list_edit").show();
            $("select[name='user_id_edit']").prop('required',false);
            $("select[name='customer_id_edit']").prop('required',true);
        }
    });

    $("#print-btn").on("click", function(){
          var divToPrint=document.getElementById('viewModal');
          var newWin=window.open('','Print-Window');
          newWin.document.open();
          newWin.document.write('<link rel="stylesheet" href="<?php echo asset('/vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css"><style type="text/css">@media  print {.modal-dialog { max-width: 1000px;} }</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
          newWin.document.close();
          setTimeout(function(){newWin.close();},10);
    });

    $('#gift_card-modal .genbutton').on("click", function(){
      $.get('gift_cards/gencode', function(data){
        $("input[name='card_no']").val(data);      
      });
    });

    $('#editModal .genbutton').on("click", function(){
      $.get('gift_cards/gencode', function(data){
        $("#editModal input[name='card_no_edit']").val(data);
      });
    });

    $(document).ready(function() {
        $('.open-Edit_gift_card_Dialog').on('click', function() {
            var url = "gift_cards/"
            var id = $(this).data('id').toString();
            url = url.concat(id).concat("/edit");
            $.get(url, function(data) {
                $("input[name='gift_card_id']").val(data['id']);
                $("input[name='card_no_edit']").val(data['card_no']);
                $("input[name='amount_edit']").val(data['amount']);
                if(data['user_id']){
                  $("#user_edit").prop('checked', true);
                  $("select[name='user_id_edit']").val(data['user_id']);
                  $("select[name='customer_id_edit']").val('');
                  $("select[name='user_id_edit']").prop('required',true);
                  $("select[name='customer_id_edit']").prop('required',false);
                  $(".user_list_edit").show();
                  $(".customer_list_edit").hide();
                }
                else{
                  $("#user_edit").prop('checked', false);
                  $("select[name='customer_id_edit']").val(data['customer_id']);
                  $("select[name='user_id_edit']").val('');
                  $("select[name='user_id_edit']").prop('required',false);
                  $("select[name='customer_id_edit']").prop('required',true);
                  $(".user_list_edit").hide();
                  $(".customer_list_edit").show();
                }
                
                $("input[name='expired_date_edit']").val(data['expired_date']);
                $('.selectpicker').selectpicker('refresh');
            });
        });

        $('.recharge').on('click', function() {
            var id = $(this).data('id').toString();
            $("#rechargeModal input[name='gift_card_id']").val(id);

            var rowindex = $(this).closest('tr').index();
            var card_no = $('#gift_card-table tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(2)').text();
            $('#card-no').text(card_no);
        });
    })

function confirmDelete() {
    if (confirm("Are you sure want to delete?")) {
        return true;
    }
    return false;
}

    $('#gift_card-table').DataTable( {
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
                'targets': [0, 8]
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
                        gift_card_id.length = 0;
                        $(':checkbox:checked').each(function(i){
                            if(i){
                                gift_card_id[i-1] = $(this).closest('tr').data('id');
                            }
                        });
                        if(gift_card_id.length && confirm("Are you sure want to delete?")) {
                            $.ajax({
                                type:'POST',
                                url:'gift_cards/deletebyselection',
                                data:{
                                    gift_cardIdArray: gift_card_id
                                },
                                success:function(data){
                                    alert(data);
                                }
                            });
                            dt.rows({ page: 'current', selected: true }).remove().draw(false);
                        }
                        else if(!gift_card_id.length)
                            alert('No gift card is selected!');
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
            $( dt_selector.column( 4 ).footer() ).html(dt_selector.cells( rows, 4, { page: 'current' } ).data().sum().toFixed(2));
            $( dt_selector.column( 5 ).footer() ).html(dt_selector.cells( rows, 5, { page: 'current' } ).data().sum().toFixed(2));
            $( dt_selector.column( 3 ).footer() ).html(dt_selector.cells( rows, 3, { page: 'current' } ).data().sum().toFixed(2));
        }
        else {
            $( dt_selector.column( 4 ).footer() ).html(dt_selector.cells( rows, 4, { page: 'current' } ).data().sum().toFixed(2));
            $( dt_selector.column( 5 ).footer() ).html(dt_selector.cells( rows, 5, { page: 'current' } ).data().sum().toFixed(2));
            $( dt_selector.column( 3 ).footer() ).html(dt_selector.cells( rows, 3, { page: 'current' } ).data().sum().toFixed(2));
        }
    }

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devup/Desktop/laravel apps/saleproposV2/resources/views/gift_card/index.blade.php ENDPATH**/ ?>