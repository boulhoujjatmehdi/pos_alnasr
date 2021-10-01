<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="<?php echo e(url('/logo', $general_setting->site_logo)); ?>" />
    <title><?php echo e($general_setting->site_title); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <style type="text/css">
        * {
            font-size: 14px;
            line-height: 24px;
            font-family: 'Ubuntu', sans-serif;
            text-transform: capitalize;
        }
        .btn {
            padding: 7px 10px;
            text-decoration: none;
            border: none;
            display: block;
            text-align: center;
            margin: 7px;
            cursor:pointer;
        }

        .btn-info {
            background-color: #999;
            color: #FFF;
        }

        .btn-primary {
            background-color: #6449e7;
            color: #FFF;
            width: 100%;
        }
        td,
        th,
        tr,
        table {
            border-collapse: collapse;
        }
        tr {border-bottom: 1px dotted #ddd;}
        td,th {padding: 7px 0;width: 50%;}

        table {width: 100%;}
        tfoot tr th:first-child {text-align: left;}

        .centered {
            text-align: center;
            align-content: center;
        }
        small{font-size:11px;}

        @media  print {
            * {
                font-size:12px;
                line-height: 18px;
            }
            td,th {padding: 5px 0;}
            .hidden-print {
                display: none !important;
            }
            @page  { margin: 0; } body { margin: 0.5cm; margin-bottom:1.6cm; } 
        }
    </style>
  </head>
<body>

<div style="max-width:800px;margin:0 auto">
    <?php if(preg_match('~[0-9]~', url()->previous())): ?>
        <?php $url = '../../pos'; ?>
    <?php else: ?>
        <?php $url = url()->previous(); ?>
    <?php endif; ?>
    <div class="hidden-print">
        <table>
            <tr>
                <td><a href="<?php echo e($url); ?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> <?php echo e(trans('file.Back')); ?></a> </td>
                <td><button onclick="window.print();" class="btn btn-primary"><i class="dripicons-print"></i> <?php echo e(trans('file.Print')); ?></button></td>
            </tr>
        </table>
        <br>
    </div>
        
    <div id="receipt-data">
        <div class="centered">
            <?php if($general_setting->site_logo): ?>
                <img src="<?php echo e(url('/logo', $general_setting->site_logo)); ?>" height="42" width="42" style="margin:10px 0;filter: brightness(0);">
            <?php endif; ?>
            
            <h2><?php echo e($lims_biller_data->company_name); ?></h2>
            
            <p><?php echo e(trans('file.Address')); ?>: <?php echo e($lims_warehouse_data->address); ?>

                <br><?php echo e(trans('file.Phone Number')); ?>: <?php echo e($lims_warehouse_data->phone); ?>

            </p>
        </div>
        <p><?php echo e(trans('file.Date')); ?>: <?php echo e($lims_sale_data->created_at); ?><br>
            <?php echo e(trans('file.reference')); ?>: <?php echo e($lims_sale_data->reference_no); ?><br>
            <?php echo e(trans('file.customer')); ?>: <?php echo e($lims_customer_data->name); ?>

        </p>
        <table>
            <tbody>
                <?php $total_product_tax = 0;?>
                <?php $__currentLoopData = $lims_product_sale_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_sale_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php 
                    $lims_product_data = \App\Product::find($product_sale_data->product_id);
                    $product_name = $lims_product_data->name;
                ?>
                <tr>
                    <td colspan="2">
                        <?php echo e($product_sale_data->qty); ?>&nbsp; x &nbsp; <?php echo e($product_name); ?>

                    </td>
                     <td colspan="2">
                        <?php echo e(number_format((float)($product_sale_data->total / $product_sale_data->qty), 2, '.', '')); ?>


                        <?php if($product_sale_data->tax_rate): ?>
                            <?php $total_product_tax += $product_sale_data->tax ?>
                            [<?php echo e(trans('file.Tax')); ?> (<?php echo e($product_sale_data->tax_rate); ?>%): <?php echo e($product_sale_data->tax); ?>]
                        <?php endif; ?>
                    </td>
                    <td style="text-align:right;vertical-align:bottom"><?php echo e(number_format((float)$product_sale_data->total, 2, '.', '')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2"><?php echo e(trans('file.Total')); ?></th>
                    <th colspan="3" style="text-align:right"><?php echo e(number_format((float)$lims_sale_data->total_price, 2, '.', '')); ?></th>
                </tr>
                <?php if($general_setting->invoice_format == 'gst' && $general_setting->state == 1): ?>
                <tr>
                    <td colspan="2">IGST</td>
                    <td style="text-align:right"><?php echo e(number_format((float)$total_product_tax, 2, '.', '')); ?></td>
                </tr>
                <?php elseif($general_setting->invoice_format == 'gst' && $general_setting->state == 2): ?>
                <tr>
                    <td colspan="2">SGST</td>
                    <td style="text-align:right"><?php echo e(number_format((float)($total_product_tax / 2), 2, '.', '')); ?></td>
                </tr>
                <tr>
                    <td colspan="2">CGST</td>
                    <td style="text-align:right"><?php echo e(number_format((float)($total_product_tax / 2), 2, '.', '')); ?></td>
                </tr>
                <?php endif; ?>

                <tr>
                    <th colspan="2"><?php echo e(trans('file.grand total')); ?></th>
                    <th colspan="3" style="text-align:right"><?php echo e(number_format((float)$lims_sale_data->grand_total, 2, '.', '')); ?></th>
                </tr>

            </tfoot>
        </table>
        <table>
            <?php
                $credit = $lims_sale_data->grand_total;
            ?>

            <tbody>
                <?php $__currentLoopData = $lims_payment_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $credit = $credit-$payment_data->amount;
                ?>
                <tr style="background-color:#ddd;">
                    <td style="padding: 5px;width:40%"><?php echo e(trans('file.Date')); ?>: <?php echo e($payment_data->created_at); ?></td>
                    <td style="padding: 5px;width:40%"><?php echo e(trans('file.Amount')); ?>: <?php echo e(number_format((float)$payment_data->amount, 2, '.', '')); ?></td>
                    <td style="padding: 5px;width:20%"><?php echo e(trans('file.Credit')); ?>: <?php echo e(number_format((float)$credit, 2, '.', '')); ?></td>
                </tr>                
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tr><td class="centered" colspan="3"><?php echo e(trans('file.Thank you for shopping with us. Please come again')); ?></td></tr>
                <tr>
                    <td class="centered" colspan="3">
                    <?php echo '<img style="margin-top:10px;" src="data:image/png;base64,' . DNS1D::getBarcodePNG($lims_sale_data->reference_no, 'C128') . '" width="300" alt="barcode"   />';?>

                    </td>
                </tr>
            </tbody>
        </table>
        <!-- <div class="centered" style="margin:30px 0 50px">
            <small><?php echo e(trans('file.Invoice Generated By')); ?> <?php echo e($general_setting->site_title); ?>.
            <?php echo e(trans('file.Developed By')); ?> </strong></small>
        </div> -->
    </div>
</div>

<script type="text/javascript">



</script>

</body>
</html>
<?php /**PATH /home/devup/Desktop/laravel apps/saleproposV2/resources/views/sale/invoice.blade.php ENDPATH**/ ?>