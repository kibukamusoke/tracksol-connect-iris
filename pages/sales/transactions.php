<?php
/**
 * IDE: PhpStorm.
 * Created by: Trevor
 * Date: 10/14/18
 * Time: 9:13 PM
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php');

$dayTotalQuery = $__DB->query('SELECT SUM(line_total) AS total FROM sales_detail');
$total = $__DB->fetch_assoc($dayTotalQuery);
?>

<a class="navbar-brand" href="#Dashboard">
    Sales
</a>

</div><div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-right">
        <li>
            <a class="btn-rotate">
                <span class="notification">TOTAL: UGX <?=$total['total']?></span>
            </a>

        </li>
    </ul>
</div>
</div>
</nav>

<div class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="toolbar">
                            <!--Here you can write extra buttons/actions for the toolbar-->
                        </div>
                        <table id="bootstrap-table" class="table">
                            <thead>
                            <th data-field="state" data-checkbox="true"></th>
                            <th data-field="Item" data-sortable="true">Stock Item</th>
                            <th data-field="Quantity" data-sortable="true">Quantity</th>
                            <th data-field="Unit Price" data-sortable="true">Unit Price</th>
                            <th data-field="Discount" data-sortable="true">Discount</th>
                            <th data-field="Total" data-sortable="true">Total</th>
                            <th data-field="Txn ID" data-sortable="true">Txn ID</th>
                            <th data-field="Customer" data-sortable="true">Customer</th>
                            <th data-field="Remarks" data-sortable="true">Remarks</th>
                            <th data-field="Tmn Time" data-sortable="true">Txn Time</th>
                            <th data-field="Logged Time" data-sortable="true">Logged Time</th>
                            <th data-field="Staff" data-sortable="true">Staff</th>

                            </thead>
                            <tbody>

                            <?php
                            $query = $__DB->select('sales_detail', '*', null, 'tmn_time DESC');
                            while ($result = $__DB->fetch_assoc($query)) {
                                echo '<tr><td></td>';
                                echo '<td>' . $result['stock_name'] .'/'. $result['stock_code'] . '</td>';
                                echo '<td>' . $result['quantity'] . '</td>';
                                echo '<td>' . $result['unit_price'] . '</td>';
                                echo '<td>' . $result['line_discount'] . '</td>';
                                echo '<td>' . $result['line_total'] . '</td>';
                                echo '<td>' . $result['tmn_hw_id'] .'/'. $result['tmn_txn_id'] . '</td>';
                                echo '<td>' . $result['customer_name'] . '</td>';
                                echo '<td>' . $result['remarks'] . '</td>';
                                echo '<td>' . $result['tmn_time'] . '</td>';
                                echo '<td>' . $result['created_dt'] . '</td>';
                                echo '<td>' . $result['created_by'] . '</td>';

                                echo '</tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div><!--  end card  -->
            </div> <!-- end col-md-12 -->
        </div> <!-- end row -->
    </div>


</div>


<script type="text/javascript">

    var $table = $('#bootstrap-table');

    function operateFormatter(value, row, index) {
        return [
            '<div class="table-icons">',
            '<a rel="tooltip" title="View" class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">',
            '<i class="ti-image"></i>',
            '</a>',
            '<a rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon table-action edit" href="javascript:void(0)">',
            '<i class="ti-pencil-alt"></i>',
            '</a>',
            '<a rel="tooltip" title="Remove" class="btn btn-simple btn-danger btn-icon table-action remove" href="javascript:void(0)">',
            '<i class="ti-close"></i>',
            '</a>',
            '</div>',
        ].join('');
    }

    $().ready(function () {
        window.operateEvents = {
            'click .view': function (e, value, row, index) {
                info = JSON.stringify(row);

                swal('You click view icon, row: ', info);
                console.log(info);
            },
            'click .edit': function (e, value, row, index) {
                info = JSON.stringify(row);
                // redirect to edit screen ::
                window.location.href = "/istock/" + row.id + "/modify";

                //swal('You click edit icon, row: ', info);
                //console.log(info);
            },
            'click .remove': function (e, value, row, index) {
                console.log(row);
                $table.bootstrapTable('remove', {
                    field: 'id',
                    values: [row.id]
                });
            }
        };

        $table.bootstrapTable({
            toolbar: ".toolbar",
            clickToSelect: true,
            showRefresh: true,
            search: true,
            showToggle: true,
            showColumns: true,
            pagination: true,
            searchAlign: 'left',
            pageSize: 8,
            clickToSelect: false,
            pageList: [8, 10, 25, 50, 100],

            formatShowingRows: function (pageFrom, pageTo, totalRows) {
                //do nothing here, we don't want to show the text "showing x of y from..."
            },
            formatRecordsPerPage: function (pageNumber) {
                return pageNumber + " rows visible";
            },
            icons: {
                refresh: 'fa fa-refresh',
                toggle: 'fa fa-th-list',
                columns: 'fa fa-columns',
                detailOpen: 'fa fa-plus-circle',
                detailClose: 'ti-close'
            }
        });

        //activate the tooltips after the data table is initialized
        $('[rel="tooltip"]').tooltip();

        $(window).resize(function () {
            $table.bootstrapTable('resetView');
        });
    });

</script>


<?php
include_once($footerFile);
?>
