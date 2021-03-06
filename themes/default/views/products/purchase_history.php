<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="modal-dialog modal-lg no-modal-header">
    <div class="modal-content">
        <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="fa fa-2x">&times;</i>
            </button>
            <button type="button" class="btn btn-xs btn-default no-print pull-right" style="margin-right:15px;" onclick="window.print();">
                <i class="fa fa-print"></i> <?= lang('print'); ?>
            </button>
            <div class="clearfix"></div>
            <div class="well well-sm">
                <div class="row bold">
                    <div class="col-xs-5">
                        <h4><b>Product Purchase History</b></h4>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="table-responsive">
                <table id="PoRData2" class="table table-bordered table-hover table-striped table-condensed">
                    <thead>
                    <tr>
                        <th><?= lang("date"); ?></th>
                        <th><?= lang("reference_no"); ?></th>
                        <th><?= lang("warehouse"); ?></th>
                        <th><?= lang("supplier"); ?></th>
                        <th><?= lang("product_qty"); ?></th>
                        <th><?= lang("grand_total"); ?></th>
                        <th><?= lang("paid"); ?></th>
                        <th><?= lang("balance"); ?></th>
                        <th><?= lang("status"); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="9" class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>
                    </tr>
                    </tbody>
                    <tfoot class="dtFilter">
                    <tr class="active">
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><?= lang("product_qty"); ?></th>
                        <th><?= lang("grand_total"); ?></th>
                        <th><?= lang("paid"); ?></th>
                        <th><?= lang("balance"); ?></th>
                        <th></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready( function() {
        $('#PoRData2').dataTable({
            "aaSorting": [[0, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
            "iDisplayLength": 10,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= site_url('reports/getPurchasesReport/?v=1&product=' . $id) ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                nRow.id = aData[9];
                nRow.className = (aData[5] > 0) ? "purchase_link2" : "purchase_link2 warning";
                return nRow;
            },
            "aoColumns": [{"mRender": fld}, null, null, null, {
                "bSearchable": false,
                "mRender": pqFormat
            }, {"mRender": currencyFormat}, {"mRender": currencyFormat}, {"mRender": currencyFormat}, {"mRender": row_status}],
            "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
                var gtotal = 0, paid = 0, balance = 0;
                for (var i = 0; i < aaData.length; i++) {
                    gtotal += parseFloat(aaData[aiDisplay[i]][5]);
                    paid += parseFloat(aaData[aiDisplay[i]][6]);
                    balance += parseFloat(aaData[aiDisplay[i]][7]);
                }
                var nCells = nRow.getElementsByTagName('th');
                nCells[5].innerHTML = currencyFormat(parseFloat(gtotal));
                nCells[6].innerHTML = currencyFormat(parseFloat(paid));
                nCells[7].innerHTML = currencyFormat(parseFloat(balance));
            }
        }).fnSetFilteringDelay().dtFilter([
            {column_number: 0, filter_default_label: "[<?=lang('date');?> (yyyy-mm-dd)]", filter_type: "text", data: []},
            {column_number: 1, filter_default_label: "[<?=lang('reference_no');?>]", filter_type: "text", data: []},
            {column_number: 2, filter_default_label: "[<?=lang('warehouse');?>]", filter_type: "text", data: []},
            {column_number: 3, filter_default_label: "[<?=lang('supplier');?>]", filter_type: "text", data: []},
            {column_number: 8, filter_default_label: "[<?=lang('status');?>]", filter_type: "text", data: []},
        ], "footer");
        
    });
</script>
