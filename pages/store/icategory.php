<?php
/**
 * IDE: PhpStorm.
 * Created by: Trevor
 * Date: 10/14/18
 * Time: 9:13 PM
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php');

if (isset($_POST) && !empty($_POST['category_name']) && !isset($_POST['cat_id'])) {
    $data = array(
        'category_name' => $__Sec->MA_STR($_POST['category_name']),
        'parent_id' => $__Sec->MA_INT(isset($_POST['parent_id']) && !empty($_POST['parent_id']) ? $_POST['parent_id'] : null)
    );

    $response = $__STORE->addCategory($data);
    if ($response['success']) {
        header('Location: /category/res/' . $response['success'] . '/' . $__GB->b64encode($response['message']));
    } else {
        echo $__GB->DisplayError($response['message'], 'red');
    }
    unset($data);

}

if (isset($_GET['action']) && $_GET['action'] === 'modify' && isset($_GET['idx']) && $_GET['idx'] > 0) {// edit item

    $query = $__DB->select('category', '*', "cat_id = '{$_GET['idx']}'");
    $data = $__DB->fetch_assoc($query);

}

if(isset($_POST['cat_id'])) {
    $response = $__STORE->updateCategory($_POST);
    if ($response['success']) {
        header('Location: /category/res/' . $response['success'] . '/' . $__GB->b64encode($response['message']));
    } else {
        echo $__GB->DisplayError($response['message'], 'red');
    }
}

?>

<a class="navbar-brand" href="#store">
    Category
</a>
</div>
</div>
</nav>

<div class="content">

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Category <?php if (isset($data)) echo " - {$data['category_name']}" ?></h4>
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
                                           name="cat_id" <?php if (isset($data)) echo 'value="' . $data['cat_id'] . '"' ?> hidden>
                                    <!--<span class="help-block">A block of help text that breaks onto a new line.</span>-->
                                </div>
                            </div>
                        </fieldset>

                        <?php
                    }
                    ?>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Category Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="category_name"
                                       class="form-control" <?php if (isset($data)) echo 'value="' . $data['category_name'] . '"' ?>>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Parent</label>
                            <div class="col-sm-10">
                                <select class="selectpicker" name="parent_id" data-style="btn btn-danger btn-block" title="Select Parent Category" data-size="7">
                                    <?php
                                    $parentQuery = $__DB->select('category', '*', (isset($data) ? "cat_id != {$data['cat_id']} AND" : "") . " status = 1", 'category_name ASC');
                                    echo '<option value="' . (isset($data) ? $data['cat_id'] : '-1') . '" selected>None</option>';
                                    while ($parent = $__DB->fetch_assoc($parentQuery)) {
                                        echo '<option value="' . $parent['cat_id'] . '" ' . (isset($data) && isset($data['parent_id']) && $parent['cat_id'] == $data['cat_id'] ? ' selected ' : ' ') . ' >' .$parent['category_name'] . '</option>';
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
