 <?php $__env->startSection('content'); ?>
<?php if(session()->has('message')): ?>
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('message')); ?></div> 
<?php endif; ?>
<?php if(session()->has('not_permitted')): ?>
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div> 
<?php endif; ?>

<section>
    <div class="container-fluid">
        <button class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="dripicons-plus"></i> <?php echo e(trans('file.Count Stock')); ?> </button>
    </div>
    <div class="table-responsive">
        <table id="stock-count-table" class="table stock-count-list">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th><?php echo e(trans('file.Date')); ?></th>
                    <th><?php echo e(trans('file.reference')); ?></th>
                    <th><?php echo e(trans('file.Warehouse')); ?></th>
                    <th><?php echo e(trans('file.category')); ?></th>
                    <th><?php echo e(trans('file.Brand')); ?></th>
                    <th><?php echo e(trans('file.Type')); ?></th>
                    <th class="not-exported"><?php echo e(trans('file.Initial File')); ?></th>
                    <th class="not-exported"><?php echo e(trans('file.Final File')); ?></th>
                    <th class="not-exported"><?php echo e(trans('file.action')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $lims_stock_count_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $stock_count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php 
                    $warehouse = DB::table('warehouses')->find($stock_count->warehouse_id);
                    $category_name = [];
                    $brand_name = [];
                    $initial_file = 'public/stock_count/' . $stock_count->initial_file;
                    $final_file = 'public/stock_count/' . $stock_count->final_file;
                ?>
                <tr>
                    <td><?php echo e($key); ?></td>
                    <td><?php echo e(date($general_setting->date_format, strtotime($stock_count->created_at->toDateString())) . ' '. $stock_count->created_at->toTimeString()); ?></td>
                    <td><?php echo e($stock_count->reference_no); ?></td>
                    <td><?php echo e($warehouse->name); ?></td>
                    <td>
                        <?php if($stock_count->category_id): ?>
                            <?php $__currentLoopData = explode(",",$stock_count->category_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat_key=>$category_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $category = \DB::table('categories')->find($category_id);
                                $category_name[] = $category->name;
                            ?>
                                <?php if($cat_key): ?>
                                    <?php echo e(', ' . $category->name); ?>

                                <?php else: ?>
                                    <?php echo e($category->name); ?>

                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($stock_count->brand_id): ?>
                            <?php $__currentLoopData = explode(",",$stock_count->brand_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand_key=>$brand_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $brand = \DB::table('brands')->find($brand_id);
                                $brand_name[] = $brand->title;
                            ?>
                                <?php if($brand_key): ?>
                                    <?php echo e(', '.$brand->title); ?>

                                <?php else: ?>
                                    <?php echo e($brand->title); ?>

                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </td>
                    <?php if($stock_count->type == 'full'): ?>
                        <?php $type = trans('file.Full') ?>
                        <td><div class="badge badge-primary"><?php echo e(trans('file.Full')); ?></div></td>
                    <?php else: ?>
                        <?php $type = trans('file.Partial') ?>
                        <td><div class="badge badge-info"><?php echo e(trans('file.Partial')); ?></div></td>
                    <?php endif; ?>
                    <td class="text-center">
                        <a download href="<?php echo e('public/stock_count/'.$stock_count->initial_file); ?>" title="<?php echo e(trans('file.Download')); ?>"><i class="dripicons-copy"></i></a>
                    </td>
                    <td class="text-center">
                        <?php if($stock_count->final_file): ?>
                        <a download href="<?php echo e('public/stock_count/'.$stock_count->final_file); ?>" title="<?php echo e(trans('file.Download')); ?>"><i class="dripicons-copy"></i></a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($stock_count->final_file): ?>
                            <div class="badge badge-success final-report" data-stock_count='["<?php echo e(date($general_setting->date_format, strtotime($stock_count->created_at->toDateString()))); ?>", "<?php echo e($stock_count->reference_no); ?>", "<?php echo e($warehouse->name); ?>", "<?php echo e($type); ?>", "<?php echo e(implode(", ", $category_name)); ?>", "<?php echo e(implode(", ", $brand_name)); ?>", "<?php echo e($initial_file); ?>", "<?php echo e($final_file); ?>", "<?php echo e($stock_count->id); ?>"]'><?php echo e(trans('file.Final Report')); ?>

                            </div>
                        <?php else: ?>
                            <div class="badge badge-primary finalize" data-id="<?php echo e($stock_count->id); ?>"><?php echo e(trans('file.Finalize')); ?>

                            </div>
                        <?php endif; ?>
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

<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <?php echo Form::open(['route' => 'stock-count.store', 'method' => 'post', 'files' => true]); ?>

        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Count Stock')); ?></h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
          <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label><?php echo e(trans('file.Warehouse')); ?> *</label>
                    <select required name="warehouse_id" id="warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select warehouse...">
                        <?php $__currentLoopData = $lims_warehouse_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($warehouse->id); ?>"><?php echo e($warehouse->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label><?php echo e(trans('file.Type')); ?> *</label>
                    <select class="form-control" name="type">
                        <option value="full"><?php echo e(trans('file.Full')); ?></option>
                        <option value="partial"><?php echo e(trans('file.Partial')); ?></option>
                    </select>
                </div>
                <div class="col-md-6 form-group" id="category">
                    <label><?php echo e(trans('file.category')); ?></label>
                    <select name="category_id[]" id="category_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Category..." multiple>
                        <?php $__currentLoopData = $lims_category_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-6 form-group" id="brand">
                    <label><?php echo e(trans('file.Brand')); ?></label>
                    <select name="brand_id[]" id="brand_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Brand..." multiple>
                        <?php $__currentLoopData = $lims_brand_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="form-group">       
              <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
            </div>
        </div>
        <?php echo e(Form::close()); ?>

      </div>
    </div>
</div>

<div id="finalizeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
        <?php echo e(Form::open(['route' => 'stock-count.finalize', 'method' => 'POST', 'files' => true] )); ?>

      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title"> <?php echo e(trans('file.Finalize Stock Count')); ?></h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
      </div>
        <div class="modal-body">
            <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.<strong><?php echo e(trans('file.You just need to update the Counted column in the initial file')); ?></strong> </small></p>
            <div class="form-group">
                <label><?php echo e(trans('file.Upload File')); ?> *</label>
                <input required type="file" name="final_file" class="form-control" />
            </div>
            <input type="hidden" name="stock_count_id">
            <div class="form-group">
                <label><?php echo e(trans('file.Note')); ?></label>
                <textarea rows="3" name="note" class="form-control"></textarea>
            </div>
            <div class="form-group">       
                <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
              </div>
        </div>
      <?php echo e(Form::close()); ?>

    </div>
  </div>
</div>

<div id="stock-count-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="container mt-3 pb-3">
                <div class="row border-bottom pb-2">
                    <div class="col-md-3">
                        <button id="print-btn" type="button" class="btn btn-default btn-sm d-print-none"><i class="dripicons-print"></i> <?php echo e(trans('file.Print')); ?></button>
                    </div>
                    <div class="col-md-6">
                        <h3 id="exampleModalLabel" class="modal-title text-center container-fluid"><?php echo e($general_setting->site_title); ?></h3>
                    </div>
                    <div class="col-md-3">
                        <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close d-print-none"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                    </div>
                    <div class="col-md-12 text-center">
                        <i style="font-size: 15px;"><?php echo e(trans('file.Stock Count')); ?></i>
                    </div>
                </div>
                <br>
                <div id="stock-count-content">
                </div>
                <br>
                <table class="table table-bordered stockdif-list">
                    <thead>
                        <th>#</th>
                        <th><?php echo e(trans('file.product')); ?></th>
                        <th><?php echo e(trans('file.Expected')); ?></th>
                        <th><?php echo e(trans('file.Counted')); ?></th>
                        <th><?php echo e(trans('file.Difference')); ?></th>
                        <th><?php echo e(trans('file.Cost')); ?></th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div id="stock-count-footer"></div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    $("ul#product").siblings('a').attr('aria-expanded','true');
    $("ul#product").addClass("show");
    $("ul#product #stock-count-menu").addClass("active");

    $("#category, #brand").hide();

    $('select[name=type]').on('change', function(){
        if($(this).val() == 'partial')
            $("#category, #brand").show(500);
        else
            $("#category, #brand").hide(500);
    });

    $('.finalize').on('click', function(){
        $('input[name="stock_count_id"]').val($(this).data('id'));
        $('#finalizeModal').modal('show');
    });

    $('.final-report').on('click', function(){
        var stock_count = $(this).data('stock_count');
        var htmltext = '<strong><?php echo e(trans("file.Date")); ?>: </strong>'+stock_count[0]+'<br><strong><?php echo e(trans("file.reference")); ?>: </strong>'+stock_count[1]+'<br><strong><?php echo e(trans("file.Warehouse")); ?>: </strong>'+stock_count[2]+'<br><strong><?php echo e(trans("file.Type")); ?>: </strong>'+stock_count[3];
        if(stock_count[4])
            htmltext += '<br><strong><?php echo e(trans("file.category")); ?>: </strong>'+stock_count[4];
        if(stock_count[5])
            htmltext += '<br><strong><?php echo e(trans("file.Brand")); ?>: </strong>'+stock_count[5];
        htmltext += '<br><span class="d-print-none mt-1"><strong><?php echo e(trans("file.Files")); ?>: </strong>&nbsp;&nbsp;<a href="'+stock_count[6]+'" class="btn btn-sm btn-primary"><i class="dripicons-download"></i> <?php echo e(trans("file.Initial File")); ?></a>&nbsp;&nbsp;<a href="'+stock_count[7]+'" class="btn btn-sm btn-info"><i class="dripicons-download"></i> <?php echo e(trans("file.Final File")); ?></a></span>';
        $.get('stock-count/stockdif/' + stock_count[8], function(data){
            $(".stockdif-list tbody").remove();
            var name_code = data[0];
            var expected = data[1];
            var counted = data[2];
            var dif = data[3];
            var cost = data[4];
            var newBody = $("<tbody>");
            if(name_code){
                $('.stockdif-list').removeClass('d-none')
                $.each(name_code, function(index){
                    var newRow = $("<tr>");
                    var cols = '';
                    cols += '<td><strong>' + (index+1) + '</strong></td>';
                    cols += '<td>' + name_code[index] + '</td>';
                    cols += '<td>' + parseFloat(expected[index]).toFixed(2) + '</td>';
                    cols += '<td>' + parseFloat(counted[index]).toFixed(2) + '</td>';
                    cols += '<td>' + parseFloat(dif[index]).toFixed(2) + '</td>';
                    cols += '<td>' + parseFloat(cost[index]).toFixed(2) + '</td>';
                    newRow.append(cols);
                    newBody.append(newRow);
                });

                if( !parseInt(data[5]) ) {
                    htmlFooter = '<a class="btn btn-primary d-print-none" href="stock-count/'+stock_count[8]+'/qty_adjustment"><i class="dripicons-plus"></i> <?php echo e(trans("file.Add Adjustment")); ?></a>';
                    $('#stock-count-footer').html(htmlFooter);
                }
            }
            else{
                $('.stockdif-list').addClass('d-none');
                $('#stock-count-footer').html('');
            }

            /*var newRow = $("<tr>");
            cols = '';
            cols += '<td colspan=6><strong><?php echo e(trans("file.Order Discount")); ?>:</strong></td>';
            cols += '<td>' + sale[19] + '</td>';
            newRow.append(cols);
            newBody.append(newRow);

            
            newRow.append(cols);
            newBody.append(newRow);*/

            $("table.stockdif-list").append(newBody);
        });

        $('#stock-count-content').html(htmltext);
        $('#stock-count-details').modal('show');
    });

    $("#print-btn").on("click", function(){
          var divToPrint=document.getElementById('stock-count-details');
          var newWin=window.open('','Print-Window');
          newWin.document.open();
          newWin.document.write('<link rel="stylesheet" href="<?php echo asset('/vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css"><style type="text/css">@media  print {.modal-dialog { max-width: 1000px;} }</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
          newWin.document.close();
          setTimeout(function(){newWin.close();},10);
    });

    $('#stock-count-table').DataTable( {
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
                'targets': [0, 7, 8, 9]
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
                    rows: ':visible',
                },
            },
            {
                extend: 'csv',
                text: '<?php echo e(trans("file.CSV")); ?>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                },
            },
            {
                extend: 'print',
                text: '<?php echo e(trans("file.Print")); ?>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                },
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
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devup/Desktop/laravel apps/saleproposV2/resources/views/stock_count/index.blade.php ENDPATH**/ ?>