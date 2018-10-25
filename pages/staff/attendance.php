<?php
/**
 * IDE: PhpStorm.
 * Created by: Trevor
 * Date: 10/18/18
 * Time: 11:46 PM
 */


include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php');

?>

<a class="navbar-brand" href="#Dashboard">
    Staff Attendance
</a>

</div>
<div class="collapse navbar-collapse">
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
                            <th data-field="name" data-sortable="true">Name</th>
                            <th data-field="type" data-sortable="true">Type</th>
                            <th data-field="time" data-sortable="true">Time</th>
                            <th data-field="admin" data-sortable="true">Admin</th>
                            <th data-field="terminal" data-sortable="true">Terminal</th>
                            <th data-field="actions" class="td-actions text-right" data-events="operateEvents"
                                data-formatter="operateFormatter">Actions
                            </th>
                            </thead>
                            <tbody>

                            <?php
                            $query = $__DB->query('SELECT a.tmn_hw_id, a.tmn_time, a.type, a.admin_id, b.staff_code, b.staff_name FROM attendance_log a INNER JOIN staff b ON a.staff_id = b.staff_id ORDER BY tmn_time DESC');
                            while ($result = $__DB->fetch_assoc($query)) {
                                $adminQuery = $__DB->select('staff', '*', "staff_id = {$result['admin_id']}");
                                $admin = $__DB->fetch_assoc($adminQuery);
                                echo '<tr><td></td>';
                                echo '<td>' . $result['staff_name'] . '</td>';
                                echo '<td>' . $result['type'] . '</td>';
                                echo '<td>' . $result['tmn_time'] . '</td>';
                                echo '<td>' . (!empty($admin) ? $admin['staff_name'] : '') . '</td>';
                                echo '<td>' . dechex($result['tmn_hw_id']) . '</td>';
                                echo '<td></td>';
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
            '</div>',
        ].join('');
    }

    $().ready(function () {
        window.operateEvents = {
            'click .view': function (e, value, row, index) {
                info = JSON.stringify(row);

                swal('You click view icon, row: ', info);
                console.log(info);
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
