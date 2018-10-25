<?php
/**
 * IDE: PhpStorm.
 * Created by: Trevor
 * Date: 10/14/18
 * Time: 9:13 PM
 */


include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php');

if (isset($_POST) && !empty($_POST['customer_name']) && !isset($_POST['customer_id'])) {
    $data = array(
        'customer_name' => $__Sec->MA_STR($_POST['customer_name']),
        'card_no' => $__Sec->MA_STR($_POST['card_no']),
        'phone' => $__Sec->MA_STR($_POST['phone']),
        'address' => $__Sec->MA_STR($_POST['address'])
    );

    $response = $__CUSTOMER->addCustomer($data);
    if ($response['success']) {
        header('Location: /customers/res/' . $response['success'] . '/' . $__GB->b64encode($response['message']));
    } else {
        echo $__GB->DisplayError($response['message'], 'red');
    }
    unset($data);

}

if (isset($_GET['action']) && $_GET['action'] === 'modify' && isset($_GET['idx']) && $_GET['idx'] > 0) {// edit item

    $query = $__DB->select('customer', '*', "customer_id = '{$_GET['idx']}'");
    $data = $__DB->fetch_assoc($query);

}

if(isset($_POST['customer_id'])) {
    $response = $__CUSTOMER->updateCustomer($_POST);
    if ($response['success']) {
        header('Location: /customers/res/' . $response['success'] . '/' . $__GB->b64encode($response['message']));
    } else {
        echo $__GB->DisplayError($response['message'], 'red');
    }
}

?>

<a class="navbar-brand" href="#customer">
    Customer
</a>
</div>
</div>
</nav>

<div class="content">

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Customer <?php if (isset($data)) echo " - {$data['customer_name']}" ?></h4>
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
                                           name="customer_id" <?php if (isset($data)) echo 'value="' . $data['customer_id'] . '"' ?> hidden>
                                    <!--<span class="help-block">A block of help text that breaks onto a new line.</span>-->
                                </div>
                            </div>
                        </fieldset>

                        <?php
                    }
                    ?>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="customer_name"
                                       class="form-control" <?php if (isset($data)) echo 'value="' . $data['customer_name'] . '"' ?>>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Card #</label>
                            <div class="col-sm-10">
                                <input type="text" name="card_no"
                                       class="form-control" <?php if (isset($data)) echo 'value="' . $data['card_no'] . '"' ?>>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" name="phone"
                                       class="form-control" <?php if (isset($data)) echo 'value="' . $data['phone'] . '"' ?>>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-10">
                                <input type="text" name="address"
                                       class="form-control" <?php if (isset($data)) echo 'value="' . $data['address'] . '"' ?>>
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
