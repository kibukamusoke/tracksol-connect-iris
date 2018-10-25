<?php
/**
 * IDE: PhpStorm.
 * Created by: Trevor
 * Date: 10/14/18
 * Time: 9:13 PM
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php');

if (isset($_POST) && !empty($_POST['store_code']) && !empty($_POST['store_name']) && !isset($_POST['store_id'])) {
    $data = array(
        'store_code' => $__Sec->MA_STR($_POST['store_code']),
        'store_name' => $__Sec->MA_STR($_POST['store_name']),
        'parent_id' => $__Sec->MA_INT(isset($_POST['parent_id']) ? $_POST['parent_id'] : null)
    );

    $response = $__STORE->addStore($data);
    if ($response['success']) {
        header('Location: /stores/res/' . $response['success'] . '/' . $__GB->b64encode($response['message']));
    } else {
        echo $__GB->DisplayError($response['message'], 'red');
    }
    unset($data);

}

if (isset($_GET['action']) && $_GET['action'] === 'modify' && isset($_GET['idx']) && $_GET['idx'] > 0) {// edit item

    $query = $__DB->select('store', '*', "store_id = '{$_GET['idx']}'");
    $data = $__DB->fetch_assoc($query);

}

if(isset($_POST['store_id'])) {
    $response = $__STORE->updateStore($_POST);
    if ($response['success']) {
        header('Location: /stores/res/' . $response['success'] . '/' . $__GB->b64encode($response['message']));
    } else {
        echo $__GB->DisplayError($response['message'], 'red');
    }
}

?>

<a class="navbar-brand" href="#store">
    Store
</a>
</div>
</div>
</nav>

<div class="content">

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Store <?php if (isset($data)) echo " - {$data['store_name']}" ?></h4>
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
                                           name="store_id" <?php if (isset($data)) echo 'value="' . $data['store_id'] . '"' ?> hidden>
                                    <!--<span class="help-block">A block of help text that breaks onto a new line.</span>-->
                                </div>
                            </div>
                        </fieldset>

                        <?php
                    }
                    ?>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Store Code</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"
                                       name="store_code" <?php if (isset($data)) echo 'value="' . $data['store_code'] . '"' ?>>
                                <!--<span class="help-block">A block of help text that breaks onto a new line.</span>-->
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Store Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="store_name"
                                       class="form-control" <?php if (isset($data)) echo 'value="' . $data['store_name'] . '"' ?>>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Parent</label>
                            <div class="col-sm-10">
                                <select class="selectpicker" name="parent_id" data-style="btn btn-danger btn-block" title="Select Parent Store" data-size="7">
                                    <?php
                                    $parentQuery = $__DB->select('store', '*', (isset($data) ? "store_id != {$data['store_id']} AND" : "") . " status = 1", 'store_name ASC');
                                    echo '<option value="' . (isset($data) ? $data['store_id'] : '1') . '" >None</option>';
                                    while ($parent = $__DB->fetch_assoc($parentQuery)) {
                                        echo '<option value="' . $parent['store_id'] . '" ' . (isset($data) && isset($data['parent_id']) && $parent['store_id'] == $data['parent_id'] ? ' selected ' : ' ') . ' >' .$parent['store_name'] . '</option>';
                                    }
                                    ?>
                                </select>
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
