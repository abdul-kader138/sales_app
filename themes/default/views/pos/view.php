<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if ($modal) { ?>
    <div class="modal-dialog no-modal-header" role="document"><div class="modal-content"><div class="modal-body">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i></button>
<?php
} else {
    ?><!doctype html>
    <html>
    <head>
        <meta charset="utf-8">
        <title><?=$page_title . " " . lang("no") . " " . $inv->id;?></title>
        <base href="<?=base_url()?>"/>
        <meta http-equiv="cache-control" content="max-age=0"/>
        <meta http-equiv="cache-control" content="no-cache"/>
        <meta http-equiv="expires" content="0"/>
        <meta http-equiv="pragma" content="no-cache"/>
        <link rel="shortcut icon" href="<?=$assets?>images/icon.png"/>
        <link rel="stylesheet" href="<?=$assets?>styles/theme.css" type="text/css"/>
        <style type="text/css" media="all">
            body { color: #000; }
            #wrapper { max-width: 480px; margin: 0 auto; padding-top: 20px; }
            .btn { border-radius: 0; margin-bottom: 5px; }
            .left { width:50%; float:left; text-align:left; margin-bottom: 3px; }
            .right { width:50%; float:right; text-align:right; margin-bottom: 3px; }
            .bootbox .modal-footer { border-top: 0; text-align: center; }
            h3 { margin: 5px 0; }
            .order_barcodes img { float: none !important; margin-top: 5px; }
            /*@media print {*/
            /*.no-print { display: none; }*/
            /*#wrapper { max-width: 480px; width: 100%; min-width: 350px; margin: 0 auto; }*/
            /*.no-border { border: none !important; }*/
            /*.border-bottom { border-bottom: 1px solid #ddd !important; }*/
            /*}*/

            @media print {
                #buttons { display: none; }
                #wrapper { max-width: 600px; width: 100%; margin: 0 auto; font-size:9px; margin-top::-100px; }
                #wrapper img { max-width:250px; width: 80%; }
            }
        </style>
    </head>

    <body>
<?php
} ?>
    <div id="wrapper">
    <div id="receiptData">
    <div class="no-print">
        <?php
        if ($message) {
            ?>
            <div class="alert alert-success">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <?=is_array($message) ? print_r($message, true) : $message;?>
            </div>
        <?php
        } ?>
    </div>
    <div id="receipt-data">
    <div class="text-center">
        <?= !empty($biller->logo) ? '<img src="'.base_url('assets/uploads/logos/'.$biller->logo).'" alt="">' : ''; ?>
        <h3 style="text-transform:uppercase;"><?=$biller->company != '-' ? $biller->company : $biller->name;?></h3>
        <?php
        echo "<p>" . $biller->address . " " . $biller->city . " " . $biller->postal_code . " " . $biller->state . " " . $biller->country .
            "<br>" . lang("tel") . ": " . $biller->phone;

        // comment or remove these extra info if you don't need
        if (!empty($biller->cf1) && $biller->cf1 != "-") {
            echo "<br>" . lang("bcf1") . ": " . $biller->cf1;
        }
        if (!empty($biller->cf2) && $biller->cf2 != "-") {
            echo "<br>" . lang("bcf2") . ": " . $biller->cf2;
        }
        if (!empty($biller->cf3) && $biller->cf3 != "-") {
            echo "<br>" . lang("bcf3") . ": " . $biller->cf3;
        }
        if (!empty($biller->cf4) && $biller->cf4 != "-") {
            echo "<br>" . lang("bcf4") . ": " . $biller->cf4;
        }
        if (!empty($biller->cf5) && $biller->cf5 != "-") {
            echo "<br>" . lang("bcf5") . ": " . $biller->cf5;
        }
        if (!empty($biller->cf6) && $biller->cf6 != "-") {
            echo "<br>" . lang("bcf6") . ": " . $biller->cf6;
        }
        // end of the customer fields

        echo "<br>";
        if ($biller->gst_reg != "") {
             echo '<span>'.lang("gst_reg")  . ": " . $biller->gst_reg . "</span> &nbsp;&nbsp;&nbsp;";
        }
        if ($biller->vat_reg != "") {
            echo '<span>'.lang("vat_reg")  . ": " . $biller->vat_reg . "</span>";
        }
//        if ($pos_settings->cf_title1 != "" && $pos_settings->cf_value1 != "") {
//            echo $pos_settings->cf_title1 . ": " . $pos_settings->cf_value1 . ", &nbsp;&nbsp;&nbsp;";
//        }
//        if ($pos_settings->cf_title2 != "" && $pos_settings->cf_value2 != "") {
//            echo $pos_settings->cf_title2 . ": " . $pos_settings->cf_value2 . "<br>";
//        }
        echo '</p>';
        ?>
    </div>
    <?php
    if ($Settings->invoice_view == 1) {
        ?>
        <div class="col-sm-12 text-center">
            <h4 style="font-weight:bold;"><?=lang('tax_invoice');?></h4>
        </div>
    <?php
    }
    echo "<p><span class='left'>" .lang("date") . ": " . $this->sma->hrld($inv->date) . "</span><span class='right'>";
    echo lang("sale_no_ref") . ": " . $inv->reference_no . "</span>";
    if (!empty($inv->return_sale_ref)) {
        echo '<span class="left">'.lang("return_ref").': '.$inv->return_sale_ref.'</span>';
        echo '<span class="right"></span>';
//        if ($inv->return_id) {
//            echo ' <a data-target="#myModal2" data-toggle="modal" href="'.site_url('sales/modal_view/'.$inv->return_id).'"><i class="fa fa-external-link no-print"></i>Return Details</a>';
//        } echo '</span>';
    }
    echo "<span class='left'>" .lang("sales_person") . ": " . $created_by->first_name." ".$created_by->last_name . "</span>";
    echo "<span class='right'>" .lang("customer") . ": " . ($customer->company && $customer->company != '-' ? $customer->company : $customer->name) . "</span>";
    if ($pos_settings->customer_details) {
//                    if ($customer->vat_no != "-" && $customer->vat_no != "") {
//                        echo "<span class='left'>" . lang("vat_no") . ": " . $customer->vat_no . "</span>";
//                    }
//                    echo lang("tel") . ": " . $customer->phone . "<br>";
        echo '<span class="left">&nbsp;&nbsp;&nbsp;&nbsp;</span>';
        echo "<span class='right'>" . lang("address") . ": " . $customer->address . ",";
        echo $customer->city ." ".$customer->state." ".$customer->country ."</span>";
//                    if (!empty($customer->cf1) && $customer->cf1 != "-") {
//                        echo "<br>" . lang("ccf1") . ": " . $customer->cf1;
//                    }
//                    if (!empty($customer->cf2) && $customer->cf2 != "-") {
//                        echo "<br>" . lang("ccf2") . ": " . $customer->cf2;
//                    }
//                    if (!empty($customer->cf3) && $customer->cf3 != "-") {
//                        echo "<br>" . lang("ccf3") . ": " . $customer->cf3;
//                    }
//                    if (!empty($customer->cf4) && $customer->cf4 != "-") {
//                        echo "<br>" . lang("ccf4") . ": " . $customer->cf4;
//                    }
//                    if (!empty($customer->cf5) && $customer->cf5 != "-") {
//                        echo "<br>" . lang("ccf5") . ": " . $customer->cf5;
//                    }
//                    if (!empty($customer->cf6) && $customer->cf6 != "-") {
//                        echo "<br>" . lang("ccf6") . ": " . $customer->cf6;
//                    }
    }
    echo "</p>";
    ?>

    <div style="clear:both;"></div>

    <table class="table table-condensed" cellspacing="0"  border-spacing="0" border="0">
        <thead>
        <tr>
            <th style="text-align:left; width:5px;" ><?php echo lang("sl") ?></th>
            <th style="text-align:left; width:180px;" ><?php echo lang("product") ?></th>
            <th style="text-align:left; width:60px;" ><?php echo lang("rate") ?></th>
            <th style="text-align:left; width:60px;" ><?php echo lang("tax") ?></th>
            <th style="text-align:left; width:60px;" ><?php echo lang("total") ?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $r = 1; $category = 0;
        $tax_summary = array();
        foreach ($rows as $row) {
            if ($pos_settings->item_order == 1 && $category != $row->category_id) {
                $category = $row->category_id;
                echo '<tr><td colspan="100%" class="no-border"><strong>'.$row->category_name.'</strong></td></tr>';
            }
            if ($Settings->invoice_view == 1) {
                if (isset($tax_summary[$row->tax_code])) {
                    $tax_summary[$row->tax_code]['items'] += $row->quantity;
                    $tax_summary[$row->tax_code]['tax'] += $row->item_tax;
                    $tax_summary[$row->tax_code]['amt'] += ($row->quantity * $row->net_unit_price) - $row->item_discount;
                } else {
                    $tax_summary[$row->tax_code]['items'] = $row->quantity;
                    $tax_summary[$row->tax_code]['tax'] = $row->item_tax;
                    $tax_summary[$row->tax_code]['amt'] = ($row->quantity * $row->net_unit_price) - $row->item_discount;
                    $tax_summary[$row->tax_code]['name'] = $row->tax_name;
                    $tax_summary[$row->tax_code]['code'] = $row->tax_code;
                    $tax_summary[$row->tax_code]['rate'] = $row->tax_rate;
                }
            }
            echo '<tr><td style="text-align:left;  width:5px;"> #' . $r . '</td><td style="text-align:left; width:180px;">' . $row->product_name. '(' . $row->product_code . ')'.'(' . $this->sma->formatQuantity($row->quantity)  . ')</td>';
            echo '<td style="text-align:left; width:60px;" class="no-border border-bottom">'. $this->sma->formatMoney($row->net_unit_price).'</td><td style="text-align:left; width:60px;" class="no-border border-bottom">'. $this->sma->formatMoney($row->item_tax).'</td><td style="text-align:left; width:60px;" class="no-border border-bottom text-right">' . $this->sma->formatMoney($row->subtotal) . '</td></tr>';
            $r++;
        }
        if ($return_rows) {
            echo '<tr class="warning"><td colspan="100%" class="no-border"><strong>'.lang('returned_items').'</strong></td></tr>';
            foreach ($return_rows as $row) {
                if ($pos_settings->item_order == 1 && $category != $row->category_id) {
                    $category = $row->category_id;
                    echo '<tr><td colspan="100%" class="no-border"><strong>'.$row->category_name.'</strong></td></tr>';
                }
                if ($Settings->invoice_view == 1) {
                    if (isset($tax_summary[$row->tax_code])) {
                        $tax_summary[$row->tax_code]['items'] += $row->quantity;
                        $tax_summary[$row->tax_code]['tax'] += $row->item_tax;
                        $tax_summary[$row->tax_code]['amt'] += ($row->quantity * $row->net_unit_price) - $row->item_discount;
                    } else {
                        $tax_summary[$row->tax_code]['items'] = $row->quantity;
                        $tax_summary[$row->tax_code]['tax'] = $row->item_tax;
                        $tax_summary[$row->tax_code]['amt'] = ($row->quantity * $row->net_unit_price) - $row->item_discount;
                        $tax_summary[$row->tax_code]['name'] = $row->tax_name;
                        $tax_summary[$row->tax_code]['code'] = $row->tax_code;
                        $tax_summary[$row->tax_code]['rate'] = $row->tax_rate;
                    }
                }

                echo '<tr><td style="text-align:left;  width:5px;"> #' . $r . '</td><td style="text-align:left; width:180px;">' . $row->product_name. '(' . $row->product_code . ')'.'(' . $this->sma->formatQuantity($row->quantity)  . ')</td>';
                echo '<td style="text-align:left; width:60px;" class="no-border border-bottom">'. $this->sma->formatMoney($row->net_unit_price).'</td><td style="text-align:left; width:60px;" class="no-border border-bottom">'. $this->sma->formatMoney($row->item_tax).'</td><td style="text-align:left; width:60px;" class="no-border border-bottom text-right">' . $this->sma->formatMoney($row->subtotal) . '</td></tr>';
                $r++;
              //  echo '<tr><td colspan="2" class="no-border">#' . $r . ': &nbsp;&nbsp;' . product_name($row->product_name, $printer->char_per_line) . ($row->variant ? ' (' . $row->variant . ')' : '') . '<span class="pull-right">' . ($row->tax_code ? '*'.$row->tax_code : '') . '</span></td></tr>';
                 //               echo '<tr><td class="no-border border-bottom">' . $this->sma->formatQuantity($row->quantity) . ' x '.$this->sma->formatMoney($row->net_unit_price + ($row->item_tax / $row->quantity)).'</td><td class="no-border border-bottom text-right">' . $this->sma->formatMoney($row->subtotal) . '</td></tr>';

                // echo '<tr><td class="no-border border-bottom">' . $this->sma->formatQuantity($row->quantity) . ' x ';
                // if ($row->item_discount != 0) {
                //     echo '<del>' . $this->sma->formatMoney($row->net_unit_price + ($row->item_discount / $row->quantity) + ($row->item_tax / $row->quantity)) . '</del> ';
                // }
                // echo $this->sma->formatMoney($row->net_unit_price + ($row->item_tax / $row->quantity)) . '</td><td class="no-border border-bottom text-right">' . $this->sma->formatMoney($row->subtotal) . '</td></tr>';
            }
        }

        ?>
        </tbody>
        <tfoot>
        <tr>
            <th><?=lang("Total");?> (<?= $default_currency->code; ?>)</th>
            <th colspan="100%" class="text-right"><?=$this->sma->formatMoney($inv->total);?></th>
        </tr>
        <tr>
            <th style="width: 100px;"><?=lang("Product Tax");?>(<?= $default_currency->code; ?>)</th>
            <th colspan="100%" class="text-right"><?=$this->sma->formatMoney($inv->product_tax);?></th>
        </tr>
        <?php

        if ($inv->order_tax != 0) {
            echo '<tr><th class="text-left">' . lang("tax") .'(' .  $default_currency->code.')</th><th colspan="100%" class="text-right" class="text-right">' . $this->sma->formatMoney($return_sale ? ($inv->order_tax+$return_sale->order_tax) : $inv->order_tax) . '</th></tr>';
        }

        if ($inv->order_discount != 0) {
            echo '<tr><th  style="width: 100px;" colspan="100%" class="text-right">' . lang("order_discount") .'(' .  $default_currency->code.')</th><th  colspan="100%" class="text-right">' . $this->sma->formatMoney($inv->order_discount) . '</th></tr>';
        }

        if ($inv->shipping != 0) {
            echo '<tr><th style="width: 100px;" colspan="100%" class="text-right">' . lang("shipping") .'(' .  $default_currency->code.')</th><th  colspan="100%" class="text-right">' . $this->sma->formatMoney($inv->shipping) . '</th></tr>';
        }

        if ($return_sale) {
            if ($return_sale->surcharge != 0) {
                echo '<tr><th style="width: 100px;"  colspan="100%" class="text-right">' . lang("order_discount") .'(' .  $default_currency->code.')</th><th  colspan="100%" class="text-right">' . $this->sma->formatMoney($return_sale->surcharge) . '</th></tr>';
            }
        }
        if ($card_charge->card_charge_percentage) {
            echo '<tr><th class="text-left">' . lang("card_charge") .'(' .  $default_currency->code.')</th><th colspan="100%" class="text-right" class="text-right">' . $this->sma->formatMoney($card_charge->card_charge_percentage) . '</th></tr>';
        }

        $card_charges=0;
        if($card_charge->card_charge_percentage){
            $card_charges=$card_charge->card_charge_percentage;
        }
        if ($pos_settings->rounding || $inv->rounding > 0) {
            ?>
            <tr>
                <th><?=lang("rounding");?>(<?= $default_currency->code; ?>)</th>
                <th class="text-right"><?= $this->sma->formatMoney($inv->rounding);?></th>
            </tr>
            <tr>
                <th style="width: 100px;"><?=lang("grand_total");?>(<?= $default_currency->code; ?>)</th>
                <th colspan="100%" class="text-right"><?=$this->sma->formatMoney($return_sale ? (($inv->grand_total + $inv->rounding)+$return_sale->grand_total+$card_charges) : ($inv->grand_total + $inv->rounding+$card_charges));?></th>
            </tr>
        <?php
        } else {
            ?>
            <tr>
                <th><?=lang("grand_total");?>(<?= $default_currency->code; ?>)</th>
                <th colspan="100%" class="text-right"><?=$this->sma->formatMoney($return_sale ? ($inv->grand_total+$return_sale->grand_total+$card_charges) : ($inv->grand_total+$card_charges));?></th>
            </tr>
        <?php
        }
        if ($inv->paid < $inv->grand_total) {
            ?>
            <tr>
                <th><?=lang("paid_amount");?>(<?= $default_currency->code; ?>)</th>
                <th  colspan="100%" class="text-right"><?=$this->sma->formatMoney($return_sale ? ($inv->paid+$return_sale->paid) : $inv->paid);?></th>
            </tr>
            <tr>
                <th><?=lang("due_amount");?>(<?= $default_currency->code; ?>)</th>
                <th  colspan="100%" class="text-right"><?=$this->sma->formatMoney(($return_sale ? (($inv->grand_total + $inv->rounding)+$return_sale->grand_total) : ($inv->grand_total + $inv->rounding)) - ($return_sale ? ($inv->paid+$return_sale->paid) : $inv->paid));?></th>
            </tr>
        <?php
        } ?>
        </tfoot>
    </table>
    <?php
    if ($payments) {
        echo '<table class="table table-striped table-condensed"><tbody>';
        foreach ($payments as $payment) {
            echo '<tr>';
            if (($payment->paid_by == 'cash' || $payment->paid_by == 'deposit') && $payment->pos_paid) {
                echo '<td>' . lang("paid_by") . ': ' . lang($payment->paid_by) . '</td>';
                echo '<td>' . lang("amount") . ': ' . $this->sma->formatMoney($payment->pos_paid == 0 ? $payment->amount : $payment->pos_paid) . ($payment->return_id ? ' (' . lang('returned') . ')' : '') . '</td>';
                echo '<td>' . lang("change") . ': ' . ($payment->pos_balance > 0 ? $this->sma->formatMoney($payment->pos_balance) : 0) . '</td>';
            } elseif (($payment->paid_by == 'CC' || $payment->paid_by == 'ppp' || $payment->paid_by == 'MasterCard' || $payment->paid_by == 'Amex' ||$payment->paid_by == 'Visa' || $payment->paid_by == 'stripe') && $payment->cc_no) {
                echo '<td>' . lang("paid_by") . ': ' . lang($payment->paid_by) . '</td>';
                echo '<td>' . lang("amount") . ': ' . $this->sma->formatMoney($payment->pos_paid) . ($payment->return_id ? ' (' . lang('returned') . ')' : '') . '</td>';
                echo '<td>' . lang("no") . ': ' . 'xxxx xxxx xxxx ' . substr($payment->cc_no, -4) . '</td>';
                echo '<td>' . lang("name") . ': ' . $payment->cc_holder . '</td>';
            } elseif (($payment->paid_by == 'DC') && $payment->cc_no) {
                echo '<td>' . lang("paid_by") . ': ' . lang($payment->paid_by) . '</td>';
                echo '<td>' . lang("amount") . ': ' . $this->sma->formatMoney($payment->pos_paid) . ($payment->return_id ? ' (' . lang('returned') . ')' : '') . '</td>';
                echo '<td>' . lang("no") . ': ' . 'xxxx xxxx xxxx ' . substr($payment->cc_no, -4) . '</td>';
                echo '<td>' . lang("name") . ': ' . $payment->cc_holder . '</td>';
            }elseif ($payment->paid_by == 'Cheque' && $payment->cheque_no) {
                echo '<td>' . lang("paid_by") . ': ' . lang($payment->paid_by) . '</td>';
                echo '<td>' . lang("amount") . ': ' . $this->sma->formatMoney($payment->pos_paid) . ($payment->return_id ? ' (' . lang('returned') . ')' : '') . '</td>';
                echo '<td>' . lang("cheque_no") . ': ' . $payment->cheque_no . '</td>';
            } elseif ($payment->paid_by == 'gift_card' && $payment->pos_paid) {
                echo '<td>' . lang("paid_by") . ': ' . lang($payment->paid_by) . '</td>';
                echo '<td>' . lang("no") . ': ' . $payment->cc_no . '</td>';
                echo '<td>' . lang("amount") . ': ' . $this->sma->formatMoney($payment->pos_paid) . ($payment->return_id ? ' (' . lang('returned') . ')' : '') . '</td>';
                echo '<td>' . lang("balance") . ': ' . ($payment->pos_balance > 0 ? $this->sma->formatMoney($payment->pos_balance) : 0) . '</td>';
            } elseif ($payment->paid_by == 'other' && $payment->amount) {
                echo '<td>' . lang("paid_by") . ': ' . lang($payment->paid_by) . '</td>';
                echo '<td>' . lang("amount") . ': ' . $this->sma->formatMoney($payment->pos_paid == 0 ? $payment->amount : $payment->pos_paid) . ($payment->return_id ? ' (' . lang('returned') . ')' : '') . '</td>';
                echo $payment->note ? '</tr><td colspan="2">' . lang("payment_note") . ': ' . $payment->note . '</td>' : '';
            }
            echo '</tr>';
        }
        echo '</tbody></table>';
    }

    if ($return_payments) {
        echo '<strong>'.lang('return_payments').'</strong><table class="table table-striped table-condensed"><tbody>';
        foreach ($return_payments as $payment) {
            $payment->amount = (0-$payment->amount);
            echo '<tr>';
            if (($payment->paid_by == 'cash' || $payment->paid_by == 'deposit') && $payment->pos_paid) {
                echo '<td>' . lang("paid_by") . ': ' . lang($payment->paid_by) . '</td>';
                echo '<td>' . lang("amount") . ': ' . $this->sma->formatMoney($payment->pos_paid == 0 ? $payment->amount : $payment->pos_paid) . ($payment->return_id ? ' (' . lang('returned') . ')' : '') . '</td>';
                echo '<td>' . lang("change") . ': ' . ($payment->pos_balance > 0 ? $this->sma->formatMoney($payment->pos_balance) : 0) . '</td>';
            } elseif (($payment->paid_by == 'CC' || $payment->paid_by == 'ppp' || $payment->paid_by == 'MasterCard' || $payment->paid_by == 'Amex' ||$payment->paid_by == 'Visa' || $payment->paid_by == 'stripe') && $payment->cc_no) {
                echo '<td>' . lang("paid_by") . ': ' . lang($payment->paid_by) . '</td>';
                echo '<td>' . lang("amount") . ': ' . $this->sma->formatMoney($payment->pos_paid) . ($payment->return_id ? ' (' . lang('returned') . ')' : '') . '</td>';
                echo '<td>' . lang("no") . ': ' . 'xxxx xxxx xxxx ' . substr($payment->cc_no, -4) . '</td>';
                echo '<td>' . lang("name") . ': ' . $payment->cc_holder . '</td>';
            } elseif (($payment->paid_by == 'DC') && $payment->cc_no) {
                echo '<td>' . lang("paid_by") . ': ' . lang($payment->paid_by) . '</td>';
                echo '<td>' . lang("amount") . ': ' . $this->sma->formatMoney($payment->pos_paid) . ($payment->return_id ? ' (' . lang('returned') . ')' : '') . '</td>';
                echo '<td>' . lang("no") . ': ' . 'xxxx xxxx xxxx ' . substr($payment->cc_no, -4) . '</td>';
                echo '<td>' . lang("name") . ': ' . $payment->cc_holder . '</td>';
            }elseif ($payment->paid_by == 'Cheque' && $payment->cheque_no) {
                echo '<td>' . lang("paid_by") . ': ' . lang($payment->paid_by) . '</td>';
                echo '<td>' . lang("amount") . ': ' . $this->sma->formatMoney($payment->pos_paid) . ($payment->return_id ? ' (' . lang('returned') . ')' : '') . '</td>';
                echo '<td>' . lang("cheque_no") . ': ' . $payment->cheque_no . '</td>';
            } elseif ($payment->paid_by == 'gift_card' && $payment->pos_paid) {
                echo '<td>' . lang("paid_by") . ': ' . lang($payment->paid_by) . '</td>';
                echo '<td>' . lang("no") . ': ' . $payment->cc_no . '</td>';
                echo '<td>' . lang("amount") . ': ' . $this->sma->formatMoney($payment->pos_paid) . ($payment->return_id ? ' (' . lang('returned') . ')' : '') . '</td>';
                echo '<td>' . lang("balance") . ': ' . ($payment->pos_balance > 0 ? $this->sma->formatMoney($payment->pos_balance) : 0) . '</td>';
            } elseif ($payment->paid_by == 'other' && $payment->amount) {
                echo '<td>' . lang("paid_by") . ': ' . lang($payment->paid_by) . '</td>';
                echo '<td>' . lang("amount") . ': ' . $this->sma->formatMoney($payment->pos_paid == 0 ? $payment->amount : $payment->pos_paid) . ($payment->return_id ? ' (' . lang('returned') . ')' : '') . '</td>';
                echo $payment->note ? '</tr><td colspan="2">' . lang("payment_note") . ': ' . $payment->note . '</td>' : '';
            }
            echo '</tr>';
        }
        echo '</tbody></table>';
    }

    if ($Settings->invoice_view == 1) {
        if (!empty($tax_summary)) {
            echo '<h4 style="font-weight:bold;">' . lang('tax_summary') . '</h4>';
            echo '<table class="table table-condensed"><thead><tr><th>' . lang('name') . '</th><th>' . lang('code') . '</th><th>' . lang('qty') . '</th><th>' . lang('tax_excl') . '</th><th>' . lang('tax_amt') . '</th></tr></td><tbody>';
            foreach ($tax_summary as $summary) {
                echo '<tr><td>' . $summary['name'] . '</td><td class="text-center">' . $summary['code'] . '</td><td class="text-center">' . $this->sma->formatQuantity($summary['items']) . '</td><td class="text-right">' . $this->sma->formatMoney($summary['amt']) . '</td><td class="text-right">' . $this->sma->formatMoney($summary['tax']) . '</td></tr>';
            }
            echo '</tbody></tfoot>';
            echo '<tr><th colspan="4" class="text-right">' . lang('total_tax_amount') . '</th><th class="text-right">' . $this->sma->formatMoney($return_sale ? $inv->product_tax+$return_sale->product_tax : $inv->product_tax) . '</th></tr>';
            echo '</tfoot></table>';
        }
    }
    ?>

    <?= $customer->award_points != 0 && $Settings->each_spent > 0 ? '<p class="text-center">'.lang('this_sale').': '.floor(($inv->grand_total/$Settings->each_spent)*$Settings->ca_point)
        .'<br>'.
        lang('total').' '.lang('award_points').': '. $customer->award_points . '</p>' : ''; ?>
    <?= $inv->note ? '<p class="text-center">' . $this->sma->decode_html($inv->note) . '</p>' : ''; ?>
    <?= $inv->staff_note ? '<p class="no-print"><strong>' . lang('staff_note') . ':</strong> ' . $this->sma->decode_html($inv->staff_note) . '</p>' : ''; ?>
    <?= $biller->invoice_footer ? '<p class="text-center">'.$this->sma->decode_html($biller->invoice_footer).'</p>' : ''; ?>
    </div>

    <div class="order_barcodes text-center">
        <?= $this->sma->save_barcode($inv->reference_no, 'code128', 30, false); ?>
        <br>
<!--        Print Qrcode
        //$this->sma->qrcode('link', urlencode(site_url('sales/view/' . $inv->id)), 1); -->
    </div>
    <div style="clear:both;"></div>
    </div>

    <div id="buttons" style="padding-top:10px; text-transform:uppercase;" class="no-print">
        <hr>
        <?php
        if ($message) {
            ?>
            <div class="alert alert-success">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <?=is_array($message) ? print_r($message, true) : $message;?>
            </div>
        <?php
        } ?>
        <?php
        if ($modal) {
            ?>
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <div class="btn-group" role="group">
                    <?php
                    if ($pos->remote_printing == 1) {
                        echo '<button onclick="window.print();" class="btn btn-block btn-primary">'.lang("print").'</button>';
                    } else {
                        echo '<button onclick="return printReceipt()" class="btn btn-block btn-primary">'.lang("print").'</button>';
                    }

                    ?>
                </div>
                <div class="btn-group" role="group">
                    <a class="btn btn-block btn-success" href="#" id="email"><?= lang("email"); ?></a>
                </div>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('close'); ?></button>
                </div>
            </div>
        <?php
        } else {
            ?>
            <span class="pull-right col-xs-12">
                    <?php
                    if ($pos->remote_printing == 1) {
                        echo '<button onclick="window.print();" class="btn btn-block btn-primary">'.lang("print").'</button>';
                    } else {
                        echo '<button onclick="return printReceipt()" class="btn btn-block btn-primary">'.lang("print").'</button>';
                        echo '<button onclick="return openCashDrawer()" class="btn btn-block btn-default">'.lang("open_cash_drawer").'</button>';
                    }
                    ?>
                </span>
            <span class="pull-left col-xs-12"><a class="btn btn-block btn-success" href="#" id="email"><?= lang("email"); ?></a></span>
            <span class="col-xs-12">
                    <a class="btn btn-block btn-warning" href="<?= site_url('pos'); ?>"><?= lang("back_to_pos"); ?></a>
                </span>
        <?php
        }
        if ($pos->remote_printing == 1) {
            ?>
            <div style="clear:both;"></div>
            <div class="col-xs-12" style="background:#F5F5F5; padding:10px;">
                <p style="font-weight:bold;">
                    Please don't forget to disble the header and footer in browser print settings.
                </p>
                <p style="text-transform: capitalize;">
                    <strong>FF:</strong> File &gt; Print Setup &gt; Margin &amp; Header/Footer Make all --blank--
                </p>
                <p style="text-transform: capitalize;">
                    <strong>chrome:</strong> Menu &gt; Print &gt; Disable Header/Footer in Option &amp; Set Margins to None
                </p>
            </div>
        <?php
        } ?>
        <div style="clear:both;"></div>
    </div>
    </div>

<?php
if( ! $modal) {
    ?>
    <script type="text/javascript" src="<?= $assets ?>js/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="<?= $assets ?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= $assets ?>js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?= $assets ?>js/custom.js"></script>
<?php
}
?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#email').click(function () {
                bootbox.prompt({
                    title: "<?= lang("email_address"); ?>",
                    inputType: 'email',
                    value: "<?= $customer->email; ?>",
                    callback: function (email) {
                        if (email != null) {
                            $.ajax({
                                type: "post",
                                url: "<?= site_url('pos/email_receipt') ?>",
                                data: {<?= $this->security->get_csrf_token_name(); ?>: "<?= $this->security->get_csrf_hash(); ?>", email: email, id: <?= $inv->id; ?>},
                        dataType: "json",
                            success: function (data) {
                            bootbox.alert({message: data.msg, size: 'small'});
                        },
                        error: function () {
                            bootbox.alert({message: '<?= lang('ajax_request_failed'); ?>', size: 'small'});
                            return false;
                        }
                    });
            }
        }
        });
        return false;
        });
        });

    </script>
<?php /* include FCPATH.'themes'.DIRECTORY_SEPARATOR.$Settings->theme.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'pos'.DIRECTORY_SEPARATOR.'remote_printing.php'; */ ?>
<?php include 'remote_printing.php'; ?>
<?php
if($modal) {
    ?>
    </div>
    </div>
    </div>
<?php
} else {
    ?>
    </body>
    </html>
<?php
}
?>
