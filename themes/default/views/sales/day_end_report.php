<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <div class="row modal-title">
                <p class="pull-left">Day End Report</p>
                <p class="pull-right">Date : <?php echo date('F d, Y'); ?></p>
            </div>
        </div>
        <div class="modal-body">

            <!-- STEP 1 -->
            <div class="jumbotron <?php echo $status ? 'hidden' : ''; ?>" id="step1">
                <div class="container text-info">
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <?= lang("Start Date", "Start Date"); ?>
                                        <?php echo form_input('start_date', (isset($_POST['start_date']) ? $_POST['start_date'] : ""), 'class="form-control datetime" id="start_date"'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <?= lang("End Date", "End Date"); ?>
                                        <?php echo form_input('end_date', (isset($_POST['end_date']) ? $_POST['end_date'] : ""), 'class="form-control datetime" id="end_date"'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12">
                                    <button class="btn btn-primary" type="button" id="sched_sales" name="login">Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- STEP 2 -->
            <div class="jumbotron <?php echo $status ? '' : 'hidden'; ?>" id="step2">
                <div class="container text-info">
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <div class="row">
                                <p>Report Of : <span id="sDate"></span> to <span
                                        id="eDate"></span>
                                <span> &nbsp;&nbsp;<button type="button"
                                                           class="btn btn-xs btn-default no-print pull-right"
                                                           onclick="window.print();">
                                        <i class="fa fa-print"></i> <?= lang('print'); ?>
                                    </button>&nbsp;
                                <button type="button"
                                        class="btn btn-xs btn-default no-print pull-right">
                                    <i class="fa fa-th"></i> <a id="receipt_url">Receipt view</a>
                                </button></span>
                                </p>
                                <table id="fileData" cellpadding="0" cellspacing="0" border="0"
                                       class="table table-bordered table-hover table-striped"
                                       style="margin-bottom: 5px;">
                                    <tbody>
                                    <tr>
                                        <td width="70%"><b>Total Sale</b></td>
                                        <td width="30%" id="total_sale"></td>
                                    </tr>
                                    </tbody>
                                </table>

                                <table id="fileData" cellpadding="0" cellspacing="0" border="0"
                                       class="table table-bordered table-hover table-striped"
                                       style="margin-bottom: 5px;">
                                    <tbody>
                                    <tr>
                                        <td width="70%">CashPayment</td>
                                        <td width="30%" id="total_cash"></td>
                                    </tr>
                                    <tr>
                                        <td width="70%">Debit Card Payment</td>
                                        <td width="30%" id="total_debit"></td>
                                    </tr>
                                    <tr>
                                        <td width="70%">Visa Card Payment</td>
                                        <td width="30%" id="total_visa"></td>
                                    </tr>
                                    <tr>
                                        <td width="70%">Master Card Payment</td>
                                        <td width="30%" id="total_mc"></td>
                                    </tr>
                                    <tr>
                                        <td width="70%"> Amex Payment</td>
                                        <td width="30%" id="total_amex"></td>
                                    </tr>
                                    <tr>
                                        <td width="70%">Cheque Payment</td>
                                        <td width="30%" id="total_cheque"></td>
                                    </tr>
                                    <tr>
                                        <td width="70%">Gift Card Payment</td>
                                        <td width="30%" id="total_gift"></td>
                                    </tr>
                                    <tr>
                                        <td width="70%">Deposit Payment</td>
                                        <td width="30%" id="total_deposit"></td>
                                    </tr>
                                    <tr>
                                        <td width="70%"><b>Total Payment</b></td>
                                        <td width="30%" id="total_payment"></td>
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
                                        <td width="30%" id="total_return"><b></b></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr/>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
<script src="<?= $assets ?>js/jquery-dateformat.min.js"></script>
<script>
    (function ($) {
        if ($) {

            $('#sched_sales').click(function () {
                $.post('<?php echo base_url(); ?>sales/day_end_sales', {
                    start_date: $('#start_date').val(),
                    end_date: $('#end_date').val(),
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                }, function (response) {
                    if (response == '0') {
                        $('#time_scheduler_error').removeClass('hidden');
                    } else {
                        var respon = JSON.parse(response);
                        $('#time_scheduler_error').addClass('hidden');
                        $('#step1').addClass('hidden');
                        $('#step2').removeClass('hidden');
                        //
                        var end_date = $('#end_date').val();
                        var start_date = $('#start_date').val();
                        var str = $('#end_date').val();
                        if (start_date) var sDate = start_date.substring(0, 11);
                        if (end_date) var eDate = end_date.substring(0, 11);

                        var base_url=window.location.pathname.substr(0, window.location.pathname.lastIndexOf('/'));
                        base_url = window.location.origin+base_url+'/sales/day_end_receipt_view?start_date='+start_date+'&end_date='+end_date;
                        $("#receipt_url").attr("href", base_url);
                        //
                        var cash = parseFloat(respon.cash);
                        var credit = parseFloat(respon.credit);
                        var debit = parseFloat(respon.debit);
                        var cheque = parseFloat(respon.cheque);
                        var amex = parseFloat(respon.amex);
                        var visa = parseFloat(respon.visa);
                        var mc = parseFloat(respon.mc);
                        var gift = parseFloat(respon.gift);
                        var deposit = parseFloat(respon.deposit);
                        var total_sale = parseFloat(respon.grand_total);
                        var total_return = parseFloat(respon.return);
                        var total_payment = 0.0;
                        if (total_sale) $('#total_sale').html(total_sale.toFixed(2));
                        if (cash) {
                            $('#total_cash').html(cash.toFixed(2));
                            total_payment = total_payment + parseFloat(cash.toFixed(2))
                        }
                        if (credit) {
                            $('#total_credit').html(credit.toFixed(2));
                            total_payment = total_payment + parseFloat(credit.toFixed(2))
                        }
                        if (debit) {
                            $('#total_debit').html(debit.toFixed(2));
                            total_payment = total_payment + parseFloat(debit.toFixed(2))
                        }
                        if (cheque) {
                            $('#total_cheque').html(cheque.toFixed(2));
                            total_payment = total_payment + parseFloat(cheque.toFixed(2))
                            console.log('go to cheque' + total_payment);
                        }
                        if (amex) {
                            $('#total_amex').html(amex.toFixed(2));
                            total_payment = total_payment + parseFloat(amex.toFixed(2))
                        }
                        if (visa) {
                            $('#total_visa').html(visa.toFixed(2));
                            total_payment = total_payment + parseFloat(visa.toFixed(2))
                        }
                        if (mc) {
                            $('#total_mc').html(mc.toFixed(2));
                            total_payment = total_payment + parseFloat(mc.toFixed(2))
                            console.log('go to mc' + total_payment);
                        }
                        if (gift) {
                            $('#total_gift').html(gift.toFixed(2));
                            total_payment = total_payment + parseFloat(gift.toFixed(2))
                        }
                        if (deposit) {
                            $('#total_deposit').html(deposit.toFixed(2));
                            total_payment = total_payment + parseFloat(deposit.toFixed(2))
                        }
                        if (total_return) {
                            var return_amount = total_return.toFixed(2);
                            $('#total_return').html(return_amount.substring(1));
                        }
                        if (total_payment) {
                            var total = total_payment.toFixed(2);
                            $('#total_payment').html(total);
                        }
                        var total_dues = (parseFloat(total_sale) - parseFloat(total_payment));
                        if (total_dues) $('#total_due').text(total_dues.toFixed(2));
                        if (sDate) $('#sDate').html(sDate);
                        if (eDate) $('#eDate').html(eDate);
                    }
                });
            });
        }
        $("#dayReportModal").on("hidden.bs.modal", function () {
            $('#step2').addClass('hidden');
            $('#step1').removeClass('hidden');
        });
    })(window.jQuery);
</script>
