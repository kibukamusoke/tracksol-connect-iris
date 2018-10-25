<?php
/**
 * IDE: PhpStorm.
 * Created by: Trevor
 * Date: 10/14/18
 * Time: 9:13 PM
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php');

if (isset($_POST) && !empty($_POST['stock_code']) && !empty($_POST['stock_name']) && !empty($_POST['min_price']) && !isset($_POST['stock_id'])) {
    $data = array(
        'stock_code' => $__Sec->MA_STR($_POST['stock_code']),
        'stock_name' => $__Sec->MA_STR($_POST['stock_name']),
        'min_price' => $__Sec->MA_INT($_POST['min_price']),
        'max_price' => $__Sec->MA_INT(isset($_POST['max_price']) ? $_POST['max_price'] : null),
        'cat_id' => $__Sec->MA_INT(isset($_POST['cat_id']) ? $_POST['cat_id'] : -1)
    );

    $response = $__STORE->addStockItem($data);
    if ($response['success']) {
        header('Location: /stock/res/' . $response['success'] . '/' . $__GB->b64encode($response['message']));
    } else {
        echo $__GB->DisplayError($response['message'], 'red');
    }
    unset($data);

}

if (isset($_GET['action']) && $_GET['action'] === 'modify' && isset($_GET['idx']) && $_GET['idx'] > 0) {// edit item

    $query = $__DB->select('stock', '*', "stock_id = '{$_GET['idx']}'");
    $data = $__DB->fetch_assoc($query);

}

if(isset($_POST['stock_id'])) {
    $response = $__STORE->updateStockItem($_POST);
    if ($response['success']) {
        header('Location: /stock/res/' . $response['success'] . '/' . $__GB->b64encode($response['message']));
    } else {
        echo $__GB->DisplayError($response['message'], 'red');
    }
}

?>

<a class="navbar-brand" href="#stock">
    Stock
</a>
</div>
</div>
</nav>

<div class="content">

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Stock Item <?php if (isset($data)) echo " - {$data['stock_name']}" ?></h4>
            </div>
            <div class="card-content">
                <form method="post" action="#" class="form-horizontal">
                    <?php
                    if (isset($data)) {
                        ?>
                        <fieldset>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">ID</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control"
                                           name="stock_id" <?php if (isset($data)) echo 'value="' . $data['stock_id'] . '"' ?> hidden>
                                    <!--<span class="help-block">A block of help text that breaks onto a new line.</span>-->
                                </div>
                            </div>
                        </fieldset>

                        <?php
                    }
                    ?>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Stock Code</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"
                                       name="stock_code" <?php if (isset($data)) echo 'value="' . $data['stock_code'] . '"' ?>>
                                <!--<span class="help-block">A block of help text that breaks onto a new line.</span>-->
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Stock Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="stock_name"
                                       class="form-control" <?php if (isset($data)) echo 'value="' . $data['stock_name'] . '"' ?>>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-10">

                                <select class="selectpicker" name="cat_id" data-style="btn btn-danger btn-block" title="Select Category" data-size="7">
                                    <?php
                                    $catQuery = $__DB->select('category', '*', 'status = 1', 'category_name ASC');
                                    while ($cat = $__DB->fetch_assoc($catQuery)) {
                                        echo '<option value="' . $cat['cat_id'] . '" ' . (isset($data) && $cat['cat_id'] == $data['cat_id'] ? ' selected ' : ' ') . ' >' .$cat['category_name'] . '</option>';
                                    }
                                    ?>

                                </select>

                            </div>
                        </div>
                    </fieldset>


                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tax Group</label>
                            <div class="col-sm-10">
                                <input type="number" name="tax_group"
                                       class="form-control" <?php if (isset($data)) echo 'value="' . $data['tax_group'] . '"' ?>>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Min Price</label>
                            <div class="col-sm-10">
                                <input type="number" name="min_price"
                                       class="form-control" <?php if (isset($data)) echo 'value="' . $data['min_price'] . '"' ?>>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Max Price</label>
                            <div class="col-sm-10">
                                <input type="number" name="max_price"
                                       class="form-control" <?php if (isset($data)) echo 'value="' . $data['max_price'] . '"' ?>>
                            </div>
                        </div>
                    </fieldset>

                    <button type="submit" class="btn btn-fill btn-info btn-full">Submit</button>
                </form>
            </div>
        </div>  <!-- end card -->
    </div> <!-- end col-md-12 -->


</div>


<?php
include_once($footerFile);
?>
