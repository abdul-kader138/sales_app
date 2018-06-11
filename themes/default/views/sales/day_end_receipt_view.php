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
                            <h3 style="text-transform:uppercase;">Day End Report</h3>
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
                        }
                        echo "</p>";
                        ?>

                        <div style="clear:both;"></div>
                        <table id="fileData" cellpadding="0" cellspacing="0" border="0"
                               class="table table-bordered table-hover table-striped"
                               style="margin-bottom: 5px;">
                            <tbody>
                            <tr>
                                <td width="70%"><b>Total Sale</b></td>
                                <td width="30%" id="total_sale"><?php echo $result->grand_total?></td>
                            </tr>
                            </tbody>
                        </table>
                        <table id="fileData" cellpadding="0" cellspacing="0" border="0"
                               class="table table-bordered table-hover table-striped"
                               style="margin-bottom: 5px;">
                            <tbody>
                            <tr>
                                <td width="70%">CashPayment</td>
                                <td width="30%" id="total_cash"><?php echo $result->cash?></td>
                            </tr>
                            <tr>
                                <td width="70%">Debit Card Payment</td>
                                <td width="30%" id="total_debit"><?php echo $result->debit?></td>
                            </tr>
                            <tr>
                                <td width="70%">Visa Card Payment</td>
                                <td width="30%" id="total_visa"><?php echo $result->vise?></td>
                            </tr>
                            <tr>
                                <td width="70%">Master Card Payment</td>
                                <td width="30%" id="total_mc"><?php echo $result->mc?></td>
                            </tr>
                            <tr>
                                <td width="70%"> Amex Payment</td>
                                <td width="30%" id="total_amex"><?php echo $result->amex?></td>
                            </tr>
                            <tr>
                                <td width="70%">Cheque Payment</td>
                                <td width="30%" id="total_cheque"><?php echo $result->cheque?></td>
                            </tr>
                            <tr>
                                <td width="70%">Gift Card Payment</td>
                                <td width="30%" id="total_gift"></td>
                            </tr>
                            <tr>
                                <td width="70%">Deposit Payment</td>
                                <td width="30%" id="total_deposit"><?php echo $result->cheque?></td>
                            </tr>
                            <tr>
                                <td width="70%"><b>Total Payment</b></td>
                                <td width="30%" id="total_payment"><?php echo $result->cheque?></td>
                            </tr>
                            </tbody>
                        </table>
                        <table id="fileData" cellpadding="0" cellspacing="0" border="0"
                               class="table table-bordered table-hover table-striped"
                               style="margin-bottom: 5px;">
                            <tbody>
                            <tr>
                                <td width="70%"><b>Total Dues </b></td>
                                <td width="30%" id="total_due"><b></b></td>
                            </tr>
                            </tbody>
                        </table>
                        <table id="fileData" cellpadding="0" cellspacing="0" border="0"
                               class="table table-bordered table-hover table-striped"
                               style="margin-bottom: 5px;">
                            <tbody>
                            <tr>
                                <td width="70%"><b>Total Return </b></td>
                                <td width="30%" id="total_return"><b><?php echo $result->return?></b></td>
                            </tr>
                            </tbody>
                        </table>
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
