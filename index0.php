<?php 

    require_once('conn.php');

    if (isset($_REQUEST['delete_id'])) {
        $id = $_REQUEST['delete_id'];

        $select_stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        // Delete an original record from db
        $delete_stmt = $db->prepare('DELETE FROM users WHERE id = :id');
        $delete_stmt->bindParam(':id', $id);
        $delete_stmt->execute();

        header('Location:index0.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
</head>

<body>
    <div class="input-group">
            <h2>DOCUMENT</h2>
            <button type="submit" name="add" class="btn"><a href="add.php" style="color: green ;">ADD+ </a></button>
            <button type="submit" name="logout" class="btn"><a href="index.php?logout='1'" style="color: red;"> LOGOUT </a></button>
        </div>
    
    <div class="container_tb">
    <table border="1" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Password</th>
                <th>Email</th>
                <th>Level</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
            <?php 
                $select_stmt = $db->prepare("SELECT * FROM users");
                $select_stmt->execute();

                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>

                <tr>
                    <td><?php echo $row["username"]; ?></td>
                    <td><?php echo $row["password"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td><?php echo $row["Userlevel"]; ?></td>
                    <td><a href="edit.php?update_id=<?php echo $row["id"]; ?>" class="btn btn-warning">edit</a></td>
                    <td><a href="?delete_id=<?php echo $row["id"]; ?>" class="btn btn-danger">delete</a></td>
                </tr>
               
            <?php } ?>
        </tbody>
    </table>

    </div>
    
    <script src="js/slim.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    
</body>
</html>