<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="{{url('/logo', $general_setting->site_logo)}}" />
    <title>{{$general_setting->site_title}}</title>
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
        td,th {padding: 7px 0;width: 10%; text-align: center;}

        table {width: 100%;}
        tfoot tr th:first-child {text-align: left;}

        .centered {
            text-align: center;
            align-content: center;
        }
        small{font-size:11px;}

        @media print {
            * {
                font-size:12px;
                line-height: 18px;
            }
            td,th {padding: 5px 0;}
            .hidden-print {
                display: none !important;
            }
            @page { margin: 0; } body { margin: 0.5cm; margin-bottom:1.6cm; } 
        }
    </style>
  </head>
<body>

<div style="max-width:800px;margin:0 auto">
    @if(preg_match('~[0-9]~', url()->previous()))
        @php $url = '../../pos'; @endphp
    @else
        @php $url = url()->previous(); @endphp
    @endif
    <div class="hidden-print">
        <table>
            <tr>
                <td><a href="{{$url}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> {{trans('file.Back')}}</a> </td>
                <td><button onclick="window.print();" class="btn btn-primary"><i class="dripicons-print"></i> {{trans('file.Print')}}</button></td>
            </tr>
        </table>
        <br>
    </div>
        
    <div id="receipt-data">
        <div class="centered">
            {{-- @if(!$general_setting->site_logo)
                <img src="{{url('/logo', $general_setting->site_logo)}}" height="42" width="42" style="margin:10px 0;filter: brightness(0);">
            @endif --}}

            
            <h2>{{ $general_setting->site_title  }}</h2>
            <h2>Plomberie - Sanitaire - Électricité - Peinture - Drougrie</h2   >
            
            <p>{{trans('file.Address')}}: {{$lims_warehouse_data->address}}
                <br>{{trans('file.Phone Number')}}: {{$lims_warehouse_data->phone}}
            </p>
        </div>
        <p>{{trans('file.Date')}}: {{$lims_sale_data->created_at}}<br>
            {{trans('file.reference')}}: {{$lims_sale_data->reference_no}}<br>
            {{trans('file.customer')}}: {{$lims_customer_data->name}}
        </p>
        <table  >
            <tbody>
                <?php $total_product_tax = 0;?>

                <tr style="border: 1px solid black;">

                    <td >qty</td>
                    <td colspan="1" style="border: 1px solid black; width:75%;text-align:left;">nome</td>
                    <td colspan="1" style="border: 1px solid black;">PU</td>
                    <td colspan="1" style="border: 1px solid black;">PT</td>
                </tr>
                @foreach($lims_product_sale_data as $product_sale_data)
                <?php 
                    $lims_product_data = \App\Product::find($product_sale_data->product_id);
                    $product_name = $lims_product_data->name;
                ?>
                <tr style="border: 1px solid black;">
                    <td>
                        {{$product_sale_data->qty}}
                    </td>
                    <td colspan="1" style="border: 1px solid black; text-align:left;">
                        {{$product_name}}
                    </td>
                     <td colspan="1" style="border: 1px solid black;">
                        {{number_format((float)($product_sale_data->total / $product_sale_data->qty), 2, '.', '')}}

                        @if($product_sale_data->tax_rate)
                            <?php $total_product_tax += $product_sale_data->tax ?>
                            [{{trans('file.Tax')}} ({{$product_sale_data->tax_rate}}%): {{$product_sale_data->tax}}]
                        @endif
                    </td>
                    <td colspan="1" style="border: 1px solid black;">{{number_format((float)$product_sale_data->total, 2, '.', '')}}</td>
                    {{-- style="text-align:right;vertical-align:bottom" --}}
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr style=" border-bottom: 1px solid black;">
                    <th colspan="2">{{trans('file.Total')}}</th>
                    <th colspan="3" style="text-align:right;">{{number_format((float)$lims_sale_data->total_price, 2, '.', '')}}</th>
                </tr>
                @if($general_setting->invoice_format == 'gst' && $general_setting->state == 1)
                <tr>
                    <td colspan="2">IGST</td>
                    <td style="text-align:right">{{number_format((float)$total_product_tax, 2, '.', '')}}</td>
                </tr>
                @elseif($general_setting->invoice_format == 'gst' && $general_setting->state == 2)
                <tr>
                    <td colspan="2">SGST</td>
                    <td style="text-align:right">{{number_format((float)($total_product_tax / 2), 2, '.', '')}}</td>
                </tr>
                <tr>
                    <td colspan="2">CGST</td>
                    <td style="text-align:right">{{number_format((float)($total_product_tax / 2), 2, '.', '')}}</td>
                </tr>
                @endif



            </tfoot>
        </table>
        <table style="margin-top:10px;">
            @php
                $credit = $lims_sale_data->grand_total;
            @endphp

            <tbody>
                @foreach($lims_payment_data as $payment_data)
                @php
                    $credit = $credit-$payment_data->amount;
                @endphp
                <tr style="background-color:#ddd; border:1px solid black">
                    <td style="padding: 5px;width:40%; text-align:left;">{{trans('file.Date')}}: {{$payment_data->created_at->format('Y-m-d')}}</td>
                    <td style="padding: 5px;width:40%">{{trans('file.Amountt')}}: {{number_format((float)$payment_data->amount, 2, '.', '')}}</td>
                    <td style="padding: 5px;width:20%; text-align:right;">{{trans('file.Credit')}}: {{number_format((float)$credit, 2, '.', '')}}</td>
                </tr>                
                @endforeach
                <tr><td class="centered" colspan="3">{{trans('file.Thank you for shopping with us. Please come again')}}</td></tr>
                <tr>
                    <td class="centered" colspan="3">
                    <?php echo '<img style="margin-top:10px;" src="data:image/png;base64,' . DNS1D::getBarcodePNG($lims_sale_data->reference_no, 'C128') . '" width="300" alt="barcode"   />';?>

                    </td>
                </tr>
            </tbody>
        </table>
        <!-- <div class="centered" style="margin:30px 0 50px">
            <small>{{trans('file.Invoice Generated By')}} {{$general_setting->site_title}}.
            {{trans('file.Developed By')}} </strong></small>
        </div> -->
    </div>
</div>

<script type="text/javascript">



</script>

</body>
</html>
