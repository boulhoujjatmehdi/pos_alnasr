 <?php $__env->startSection('content'); ?>
<?php if(session()->has('message')): ?>
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo session()->get('message'); ?></div> 
<?php endif; ?>
<?php if(session()->has('not_permitted')): ?>
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div> 
<?php endif; ?>

<section>
    <div class="table-responsive">
        <table id="delivery-table" class="table">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th><?php echo e(trans('file.Delivery Reference')); ?></th>
                    <th><?php echo e(trans('file.Sale Reference')); ?></th>
                    <th><?php echo e(trans('file.customer')); ?></th>
                    <th><?php echo e(trans('file.Address')); ?></th>
                    <th><?php echo e(trans('file.Status')); ?></th>
                    <th class="not-exported"><?php echo e(trans('file.action')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $lims_delivery_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$delivery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php 
                    $customer_sale = DB::table('sales')->join('customers', 'sales.customer_id', '=', 'customers.id')->where('sales.id', $delivery->sale_id)->select('sales.reference_no','customers.name')->get();

                    if($delivery->status == 1)
                        $status = trans('file.Packing');
                    elseif($delivery->status == 2)
                        $status = trans('file.Delivering');
                    else
                        $status = trans('file.Delivered');
                    
                    $barcode = \DNS2D::getBarcodePNG($delivery->reference_no, 'QRCODE');
                ?>
                <tr class="delivery-link" data-barcode="<?php echo e($barcode); ?>" data-delivery='["<?php echo e(date($general_setting->date_format, strtotime($delivery->created_at->toDateString()))); ?>", "<?php echo e($delivery->reference_no); ?>", "<?php echo e($delivery->sale->reference_no); ?>", "<?php echo e($status); ?>", "<?php echo e($delivery->id); ?>", "<?php echo e($delivery->sale->customer->name); ?>", "<?php echo e($delivery->sale->customer->phone_number); ?>", "<?php echo e($delivery->sale->customer->address); ?>", "<?php echo e($delivery->sale->customer->city); ?>", "<?php echo e($delivery->note); ?>", "<?php echo e($delivery->user->name); ?>", "<?php echo e($delivery->delivered_by); ?>", "<?php echo e($delivery->recieved_by); ?>"]'>
                    <td><?php echo e($key); ?></td>
                    <td><?php echo e($delivery->reference_no); ?></td>
                    <td><?php echo e($customer_sale[0]->reference_no); ?></td>
                    <td><?php echo e($customer_sale[0]->name); ?></td>
                    <td><?php echo e($delivery->address); ?></td>
                    <?php if($delivery->status == 1): ?>
                    <td><div class="badge badge-info"><?php echo e($status); ?></div></td>
                    <?php elseif($delivery->status == 2): ?>
                    <td><div class="badge badge-primary"><?php echo e($status); ?></div></td>
                    <?php else: ?>
                    <td><div class="badge badge-success"><?php echo e($status); ?></div></td>
                    <?php endif; ?>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(trans('file.action')); ?>

                              <span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li>
                                    <button type="button" data-id="<?php echo e($delivery->id); ?>" class="open-EditCategoryDialog btn btn-link"><i class="dripicons-document-edit"></i> <?php echo e(trans('file.edit')); ?></button>
                                </li>
                                <li class="divider"></li>
                                <?php echo e(Form::open(['route' => ['delivery.delete', $delivery->id], 'method' => 'post'] )); ?>

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
        </table>
    </div>
</seaction>

<!-- Modal -->
<div id="delivery-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <div class="container mt-3 pb-2 border-bottom">
            <div class="row">
                <div class="col-md-3">
                    <button id="print-btn" type="button" class="btn btn-default btn-sm d-print-none"><i class="dripicons-print"></i> <?php echo e(trans('file.Print')); ?></button>

                    <?php echo e(Form::open(['route' => 'delivery.sendMail', 'method' => 'post', 'class' => 'sendmail-form'] )); ?>

                        <input type="hidden" name="delivery_id">
                        <button class="btn btn-default btn-sm d-print-none"><i class="dripicons-mail"></i> <?php echo e(trans('file.Email')); ?></button>
                    <?php echo e(Form::close()); ?>

                </div>
                <div class="col-md-6">
                    <h3 id="exampleModalLabel" class="modal-title text-center container-fluid">
                        <img src="<?php echo e(url('/logo', $general_setting->site_logo)); ?>" width="30">
                        <?php echo e($general_setting->site_title); ?>

                    </h3>
                </div>
                <div class="col-md-3">
                    <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close d-print-none"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="col-md-12 text-center">
                    <i style="font-size: 15px;"><?php echo e(trans('file.Delivery Details')); ?></i>
                </div>
            </div>
        </div>
        <div class="modal-body">
            <table class="table table-bordered" id="delivery-content">
                <tbody></tbody>
            </table>
            <br>
            <table class="table table-bordered product-delivery-list">
                <thead>
                    <th>No</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Qty</th>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div id="delivery-footer" class="row">
            </div>            
        </div>    
      </div>
    </div>
</div>

<div id="edit-delivery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Update Delivery')); ?></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                <?php echo Form::open(['route' => 'delivery.update', 'method' => 'post', 'files' => true]); ?>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label><?php echo e(trans('file.Delivery Reference')); ?></label>
                        <p id="dr"></p>
                    </div>
                    <div class="col-md-6 form-group">
                        <label><?php echo e(trans('file.Sale Reference')); ?></label>
                        <p id="sr"></p>
                    </div>
                    <div class="col-md-12 form-group">
                        <label><?php echo e(trans('file.Status')); ?> *</label>
                        <select name="status" required class="form-control selectpicker">
                            <option value="1"><?php echo e(trans('file.Packing')); ?></option>
                            <option value="2"><?php echo e(trans('file.Delivering')); ?></option>
                            <option value="3"><?php echo e(trans('file.Delivered')); ?></option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-2 form-group">
                        <label><?php echo e(trans('file.Delivered By')); ?></label>
                        <input type="text" name="delivered_by" class="form-control">
                    </div>
                    <div class="col-md-6 mt-2 form-group">
                        <label><?php echo e(trans('file.Recieved By')); ?></label>
                        <input type="text" name="recieved_by" class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label><?php echo e(trans('file.customer')); ?> *</label>
                        <p id="customer"></p>
                    </div>
                    <div class="col-md-6 form-group">
                        <label><?php echo e(trans('file.Attach File')); ?></label>
                        <input type="file" name="file" class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label><?php echo e(trans('file.Address')); ?> *</label>
                        <textarea rows="3" name="address" class="form-control" required></textarea>
                    </div>
                    <div class="col-md-6 form-group">
                        <label><?php echo e(trans('file.Note')); ?></label>
                        <textarea rows="3" name="note" class="form-control"></textarea>
                    </div>
                </div>
                <input type="hidden" name="reference_no">
                <input type="hidden" name="delivery_id">
                <button type="submit" class="btn btn-primary"><?php echo e(trans('file.submit')); ?></button>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $("ul#sale").siblings('a').attr('aria-expanded','true');
    $("ul#sale").addClass("show");
    $("ul#sale #delivery-menu").addClass("active");

    var delivery_id = [];
    var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#print-btn").on("click", function(){
          var divToPrint=document.getElementById('delivery-details');
          var newWin=window.open('','Print-Window');
          newWin.document.open();
          newWin.document.write('<link rel="stylesheet" href="<?php echo asset('/vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css"><style type="text/css">@media  print {.modal-dialog { max-width: 1000px;} }</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
          newWin.document.close();
          setTimeout(function(){newWin.close();},10);
    });

    function confirmDelete() {
      if (confirm("Are you sure want to delete?")) {
          return true;
      }
      return false;
    }

    $("tr.delivery-link td:not(:first-child, :last-child)").on("click", function() {
        var delivery = $(this).parent().data('delivery');
        var barcode = $(this).parent().data('barcode');
        deliveryDetails(delivery, barcode);
    });

    function deliveryDetails(delivery, barcode) {
        $('input[name="delivery_id"]').val(delivery[4]);
        $("#delivery-content tbody").remove();
        var newBody = $("<tbody>");
        var rows = '';
        rows += '<tr><td>Date</td><td>'+delivery[0]+'</td></tr>';
        rows += '<tr><td>Delivery Reference</td><td>'+delivery[1]+'</td></tr>';
        rows += '<tr><td>Sale Reference</td><td>'+delivery[2]+'</td></tr>';
        rows += '<tr><td>Status</td><td>'+delivery[3]+'</td></tr>';
        rows += '<tr><td>Customer Name</td><td>'+delivery[5]+'</td></tr>';
        rows += '<tr><td>Address</td><td>'+delivery[7]+', '+delivery[8]+'</td></tr>';
        rows += '<tr><td>Phone Number</td><td>'+delivery[6]+'</td></tr>';
        rows += '<tr><td>Note</td><td>'+delivery[9]+'</td></tr>';

        newBody.append(rows);
        $("table#delivery-content").append(newBody);

        $.get('delivery/product_delivery/' + delivery[4], function(data) {
            $(".product-delivery-list tbody").remove();
            var code = data[0];
            var description = data[1];
            var qty = data[2];
            var newBody = $("<tbody>");
            $.each(code, function(index) {
                var newRow = $("<tr>");
                var cols = '';
                cols += '<td><strong>' + (index+1) + '</strong></td>';
                cols += '<td>' + code[index] + '</td>';
                cols += '<td>' + description[index] + '</td>';
                cols += '<td>' + qty[index] + '</td>';
                newRow.append(cols);
                newBody.append(newRow);
            });
            $("table.product-delivery-list").append(newBody);
        });

        var htmlfooter = '<div class="col-md-4 form-group"><p>Prepared By: '+delivery[10]+'</p></div>';
        htmlfooter += '<div class="col-md-4 form-group"><p>Delivered By: '+delivery[11]+'</p></div>';
        htmlfooter += '<div class="col-md-4 form-group"><p>Recieved By: '+delivery[12]+'</p></div>';
        htmlfooter += '<br><br><br><br>';
        htmlfooter += '<div class="col-md-2 offset-md-5"><img style="max-width:850px;height:100%;max-height:130px" src="data:image/png;base64,'+barcode+'" alt="barcode" /></div>';

        $('#delivery-footer').html(htmlfooter);
        $('#delivery-details').modal('show');
    }

    $(document).ready(function() {
        $('.open-EditCategoryDialog').on('click', function(){
          var url ="delivery/"  
          var id = $(this).data('id').toString();
          url = url.concat(id).concat("/edit");
          
          $.get(url, function(data){
                $('#dr').text(data[0]);
                $('#sr').text(data[1]);
                $('select[name="status"]').val(data[2]);
                $('.selectpicker').selectpicker('refresh');
                $('input[name="delivered_by"]').val(data[3]);
                $('input[name="recieved_by"]').val(data[4]);
                $('#customer').text(data[5]);
                $('textarea[name="address"]').val(data[6]);
                $('textarea[name="note"]').val(data[7]);
                $('input[name="reference_no"]').val(data[0]);
                $('input[name="delivery_id"]').val(id);
          });
          $("#edit-delivery").modal('show');
        });
    });

    $('#delivery-table').DataTable( {
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
                text: '<?php echo e(trans("file.delete")); ?>',
                className: 'buttons-delete',
                action: function ( e, dt, node, config ) {
                    if(user_verified == '1') {
                        delivery_id.length = 0;
                        $(':checkbox:checked').each(function(i){
                            if(i){
                                delivery_id[i-1] = $(this).closest('tr').data('id');
                            }
                        });
                        if(delivery_id.length && confirm("Are you sure want to delete?")) {
                            $.ajax({
                                type:'POST',
                                url:'delivery/deletebyselection',
                                data:{
                                    deliveryIdArray: delivery_id
                                },
                                success:function(data){
                                    alert(data);
                                }
                            });
                            dt.rows({ page: 'current', selected: true }).remove().draw(false);
                        }
                        else if(!delivery_id.length)
                            alert('Nothing is selected!');
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
    } );
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devup/Desktop/laravel apps/saleproposV2/resources/views/delivery/index.blade.php ENDPATH**/ ?>