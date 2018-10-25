<?php
/**
 * IDE: PhpStorm.
 * Created by: Trevor
 * Date: 10/14/18
 * Time: 9:13 PM
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php');

?>

<a class="navbar-brand" href="#Dashboard">
    Stock
</a>

</div>
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-right">
        <li>
            <a href="/istock" class="btn-rotate">
                <i class="ti-plus"></i>
                <span class="notification">Add New Item</span>
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
                            <th data-field="id" class="text-center">IDx</th>
                            <th data-field="code" data-sortable="true">Code</th>
                            <th data-field="name" data-sortable="true">Name</th>
                            <th data-field="category" data-sortable="true">Category</th>
                            <th data-field="min price" data-sortable="true">Min Price</th>
                            <th data-field="max price" data-sortable="true">Max Price</th>
                            <th data-field="tax group" data-sortable="true">Tax Group</th>
                            <th data-field="actions" class="td-actions text-right" data-events="operateEvents"
                                data-formatter="operateFormatter">Actions
                            </th>
                            </thead>
                            <tbody>

                            <?php
                            $query = $__DB->select('stock', '*', 'status = 1', 'stock_name ASC');
                            while ($result = $__DB->fetch_assoc($query)) {
                                $categoryQuery = $__DB->select('category', 'category_name', "cat_id = {$result['cat_id']}");
                                $category = $__DB->fetch_assoc($categoryQuery);
                                echo '<tr><td></td>';
                                echo '<td>' . $result['stock_id'] . '</td>';
                                echo '<td>' . $result['stock_code'] . '</td>';
                                echo '<td>' . $result['stock_name'] . '</td>';
                                echo '<td>' . (!empty($category) ? $category['category_name'] : 'UNCATEGORIZED') . '</td>';
                                echo '<td>' . $result['min_price'] . '</td>';
                                echo '<td>' . $result['max_price'] . '</td>';
                                echo '<td>' . $result['tax_group'] . '</td>';
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
                $.ajax({
                    url: '/internal/deleteStock',
                    //dataType: 'json',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({"stock_id": row.id}),
                    processData: false,
                    /*headers: {
                        "X-Auth-Token": "65af2bf5f5c7d6802d01bf967917e0cd"
                    }*/
                    beforeSend: function(request) {
                        request.setRequestHeader("X-Auth-Token", "65af2bf5f5c7d6802d01bf967917e0cd");
                    },
                    success: (data, textStatus, jQxhr) =>  {
                        //alert(data);
                        $table.bootstrapTable('remove', {
                            field: 'id',
                            values: [row.id]
                        });
                    },
                    error: function(jqXhr, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                })
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
