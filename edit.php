<?php 
    require_once('conn.php');

    if (isset($_REQUEST['update_id'])) {
        try {
            $id = $_REQUEST['update_id'];
            $select_stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
        } catch(PDOException $e) {
            $e->getMessage();
        }
    }

    if (isset($_REQUEST['btn_update'])) {
        $email_up = $_REQUEST['txt_email'];
        $password_up = $_REQUEST['txt_password'];

        if (empty($email_up)) {
            $errorMsg = "Please Enter Email";
        } else if (empty($password_up)) {
            $errorMsg = "Please Enter Password";
        } else {
            try {
                if (!isset($errorMsg)) {
                    $update_stmt = $db->prepare("UPDATE users SET email = :email_up, password = :password_up WHERE id = :id");
                    $update_stmt->bindParam(':email_up', $email_up);
                    $update_stmt->bindParam(':password_up', $password_up);
                    $update_stmt->bindParam(':id', $id);

                    if ($update_stmt->execute()) {
                        $updateMsg = "Record update successfully...";
                        header("refresh:2;index0.php");
                    }
                }
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
</head>
<body>

<div class="header">
        <h2>Edit Page</h2>
    </div>
    <div class="edit">

    <?php 
         if (isset($errorMsg)) {
    ?>
        <div class="alert alert-danger">
            <strong>Wrong! <?php echo $errorMsg; ?></strong>
        </div>
    <?php } ?>
    

    <?php 
         if (isset($updateMsg)) {
    ?>
        <div class="alert alert-success">
            <strong>Success! <?php echo $updateMsg; ?></strong>
        </div>
    <?php } ?>

    <form method="post" class="form-horizontal mt-5">
            
            <div class="input-group">
                <div class="row">
                    <label for="email" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_email" class="form-control" value="<?php echo $email; ?>">
                    </div>
                </div>
            </div>
            <div class="input-group">
                <div class="row">
                    <label for="password" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_password" class="form-control" value="<?php echo $password; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="col-md-12 mt-3">
                    <input type="submit" name="btn_update" class="btn btn-success" value="Update">
                    <a href="index0.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>


    </form>

    <script src="js/slim.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>