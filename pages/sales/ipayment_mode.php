<?php
/**
 * IDE: PhpStorm.
 * Created by: Trevor
 * Date: 10/14/18
 * Time: 9:13 PM
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php');

if (isset($_POST) && !empty($_POST['mode_code']) && !empty($_POST['mode_name']) && !isset($_POST['mode_id'])) {
    $data = array(
        'mode_code' => $__Sec->MA_STR($_POST['mode_code']),
        'mode_name' => $__Sec->MA_STR($_POST['mode_name'])
    );

    $response = $__SALES->addPaymentMode($data);
    if ($response['success']) {
        header('Location: /payment_modes/res/' . $response['success'] . '/' . $__GB->b64encode($response['message']));
    } else {
        echo $__GB->DisplayError($response['message'], 'red');
    }
    unset($data);

}

if (isset($_GET['action']) && $_GET['action'] === 'modify' && isset($_GET['idx']) && $_GET['idx'] > 0) {// edit item

    $query = $__DB->select('payment_modes', '*', "mode_id = '{$_GET['idx']}'");
    $data = $__DB->fetch_assoc($query);

}

if(isset($_POST['mode_id'])) {
    $response = $__SALES->updatePaymentMode($_POST);
    if ($response['success']) {
        header('Location: /payment_modes/res/' . $response['success'] . '/' . $__GB->b64encode($response['message']));
    } else {
        echo $__GB->DisplayError($response['message'], 'red');
    }
}

?>

<a class="navbar-brand" href="#payment_mode">
    Payment Mode
</a>
</div>
</div>
</nav>

<div class="content">

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Payment Mode <?php if (isset($data)) echo " - {$data['mode_name']}" ?></h4>
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
                                           name="mode_id" <?php if (isset($data)) echo 'value="' . $data['mode_id'] . '"' ?> hidden>
                                    <!--<span class="help-block">A block of help text that breaks onto a new line.</span>-->
                                </div>
                            </div>
                        </fieldset>

                        <?php
                    }
                    ?>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Mode Code</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"
                                       name="mode_code" <?php if (isset($data)) echo 'value="' . $data['mode_code'] . '"' ?>>
                                <!--<span class="help-block">A block of help text that breaks onto a new line.</span>-->
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Mode Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="mode_name"
                                       class="form-control" <?php if (isset($data)) echo 'value="' . $data['mode_name'] . '"' ?>>
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
