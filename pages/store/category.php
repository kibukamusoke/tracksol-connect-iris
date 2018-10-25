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
    Categories
</a>

</div>
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-right">
        <li>
            <a href="/icategory" class="btn-rotate">
                <i class="ti-plus"></i>
                <span class="notification">Add New Category</span>
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
                            <th data-field="name" data-sortable="true">Name</th>
                            <th data-field="parent" data-sortable="true">Parent</th>
                            <th data-field="actions" class="td-actions text-right" data-events="operateEvents"
                                data-formatter="operateFormatter">Actions
                            </th>
                            </thead>
                            <tbody>

                            <?php
                            $query = $__DB->select('category', '*', 'status = 1', 'category_name ASC');
                            while ($result = $__DB->fetch_assoc($query)) {
                                $parentQuery = $__DB->select('category', 'category_name', "cat_id = {$result['parent_id']}");
                                $parent = $__DB->fetch_assoc($parentQuery);
                                echo '<tr><td></td>';
                                echo '<td>' . $result['cat_id'] . '</td>';
                                echo '<td>' . $result['category_name'] . '</td>';
                                echo '<td>' . (!empty($parent) ? $parent['category_name'] : '') . '</td>';
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
                window.location.href = "/icategory/" + row.id + "/modify";

                //swal('You click edit icon, row: ', info);
                //console.log(info);
            },
            'click .remove': function (e, value, row, index) {
                $.ajax({
                    url: '/internal/deleteCategory',
                    //dataType: 'json',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({"cat_id": row.id}),
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
