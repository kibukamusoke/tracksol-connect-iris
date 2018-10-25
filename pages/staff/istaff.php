<?php
/**
 * IDE: PhpStorm.
 * Created by: Trevor
 * Date: 10/14/18
 * Time: 9:13 PM
 */

include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php');

if (isset($_POST) && !empty($_POST['staff_code']) && !empty($_POST['staff_name']) && !isset($_POST['staff_id'])) {
    $data = array(
        'staff_code' => $__Sec->MA_STR($_POST['staff_code']),
        'staff_name' => $__Sec->MA_STR($_POST['staff_name']),
        'card_no' => $__Sec->MA_STR(isset($_POST['card_no']) ? $_POST['card_no'] : null),
        'phone' => $__Sec->MA_STR(isset($_POST['phone']) ? $_POST['phone'] : null),
        'department' => $__Sec->MA_STR(isset($_POST['department']) ? $_POST['department'] : null),
        'role' => $__Sec->MA_INT(isset($_POST['role']) ? $_POST['role'] : null)
    );

    $response = $__STAFF->addStaff($data);
    if ($response['success']) {
        header('Location: /staff/res/' . $response['success'] . '/' . $__GB->b64encode($response['message']));
    } else {
        echo $__GB->DisplayError($response['message'], 'red');
    }
    unset($data);

}

if (isset($_GET['action']) && $_GET['action'] === 'modify' && isset($_GET['idx']) && $_GET['idx'] > 0) {// edit item

    $query = $__DB->select('staff', '*', "staff_id = '{$_GET['idx']}'");
    $data = $__DB->fetch_assoc($query);

}

if(isset($_POST['staff_id'])) {
    $response = $__STAFF->updatestaff($_POST);
    if ($response['success']) {
        header('Location: /staff/res/' . $response['success'] . '/' . $__GB->b64encode($response['message']));
    } else {
        echo $__GB->DisplayError($response['message'], 'red');
    }
}

?>

<a class="navbar-brand" href="#staff">
    Staff
</a>
</div>
</div>
</nav>

<div class="content">

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Staff <?php if (isset($data)) echo " - {$data['staff_name']}" ?></h4>
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
                                           name="staff_id" <?php if (isset($data)) echo 'value="' . $data['staff_id'] . '"' ?> hidden>
                                    <!--<span class="help-block">A block of help text that breaks onto a new line.</span>-->
                                </div>
                            </div>
                        </fieldset>

                        <?php
                    }
                    ?>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Staff Code</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"
                                       name="staff_code" <?php if (isset($data)) echo 'value="' . $data['staff_code'] . '"' ?>>
                                <!--<span class="help-block">A block of help text that breaks onto a new line.</span>-->
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Staff Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="staff_name"
                                       class="form-control" <?php if (isset($data)) echo 'value="' . $data['staff_name'] . '"' ?>>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Card Number</label>
                            <div class="col-sm-10">
                                <input type="text" name="card_no"
                                       class="form-control" <?php if (isset($data)) echo 'value="' . $data['card_no'] . '"' ?>>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Phone Number</label>
                            <div class="col-sm-10">
                                <input type="text" name="phone"
                                       class="form-control" <?php if (isset($data)) echo 'value="' . $data['phone'] . '"' ?>>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Department</label>
                            <div class="col-sm-10">
                                <input type="text" name="department"
                                       class="form-control" <?php if (isset($data)) echo 'value="' . $data['department'] . '"' ?>>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Role</label>
                            <div class="col-sm-10">

                                <select class="selectpicker" name="role" data-style="btn btn-danger btn-block" title="Select Role" data-size="7">
                                    <option value="2"  <?php echo(isset($data) && $data['role'] == 2 ? ' selected ' : '') ?>>Administrator</option>
                                    <option value="1"  <?php echo(isset($data) && $data['role'] == 1? ' selected ' : '') ?>>Staff</option>
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
