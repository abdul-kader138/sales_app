<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <div class="row modal-title">
                <p class="pull-left">Day End Report</p>
                <p class="pull-right">Date : <?php echo date( 'F d, Y' ); ?></p>
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
                                    <button class="btn btn-primary" type="button" id="sched_sales" name="login">Submit</button>
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
                                <p class="pull-right">Day End Report Of :> <span id="sDate"></span></p>
                                <table id="fileData" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover table-striped" style="margin-bottom: 5px;">
                                    <tbody>
                                    <tr>
                                        <td>Total Sale</td>
                                        <td id="total_sale"></td>
                                    </tr>
                                    <tr>
                                        <td>Total Paid</td>
                                        <td id="total_paid"></td>
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
    (function($) {
        if ($) {

            $('#sched_sales').click(function() {
                $.post('<?php echo base_url(); ?>sales/day_end_sales', {
                    start_date: $('#start_date').val(),
                    end_date: $('#end_date').val(),
                    '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
                }, function(response) {
                    if (response == '0') {
                        $('#time_scheduler_error').removeClass('hidden');
                    } else {
                        var respon=JSON.parse(response);
                        $('#time_scheduler_error').addClass('hidden');
                        $('#step1').addClass('hidden');
                        $('#step2').removeClass('hidden');
                        $('#total_sale').html(respon.grand_total);
                        $('#total_paid').html(respon.paid);
                        var inputdate = respon.date;
                        DateTime date = DateTime.Parse(inputdate);
                        String newDate = date.ToString("DD-MM-YYYY");
                        console.log(newDate);
                        $('#sDate').html(newDate);
                    }
                });
            });
//
//            $('#sched_logout').click(function() {
//                $.post('<?php //echo base_url(); ?>//time_scheduler/ajax_logout', {
//                    '<?php //echo $this->security->get_csrf_token_name(); ?>//':'<?php //echo $this->security->get_csrf_hash(); ?>//'
//                }, function() {
//                    $('#step2').addClass('hidden');
//                    $('#step1').removeClass('hidden');
//                });
//            });

//            $('.time-punch-btn').click(function() {
//                var time_type = $(this).attr('time-punch-type');
//
//                $.post('<?php //echo base_url(); ?>//time_scheduler/ajax_punch_time', {
//                    time_type : time_type,
//                    '<?php //echo $this->security->get_csrf_token_name(); ?>//':'<?php //echo $this->security->get_csrf_hash(); ?>//'
//                }, function() {
//                    refresh();
//                });
//            });

//            refresh();
        }
        $("#dayReportModal").on("hidden.bs.modal", function () {
            $('#step2').addClass('hidden');
            $('#step1').removeClass('hidden');
        });
    })(window.jQuery);
</script>
