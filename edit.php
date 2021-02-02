<?php 
$task_data = "";

echo "<br><br><br><br>";
$email = $task = $desc = "";
$errors = array("email"=>NULL,"name"=>NULL,"desc"=>NULL);

// if deleting operation has been made
if (isset($_POST["delete"])) {
    include("config/db_connect.php");

    $id_to_delete = mysqli_real_escape_string($conn, $_POST["id_to_delete"]);
    $sql = "DELETE FROM tasks WHERE id = '$id_to_delete'";
    if(mysqli_query($conn,$sql)) {
        // success
        header("Location: index.php");
        echo $id_to_delete;
    } else {
        echo "Query Error: " . mysqli_error($conn);
    }
    $conn->close();
    // if the submit button was pressed
} else if (isset($_POST["update"])) {

    // validating the task name
    if (empty($_POST["taskName"])) {
        $errors["name"] = "Please enter a name!";
    } else {
        $task = $_POST["taskName"];
        if (!preg_match("/^[a-zA-Z\s,.!']+$/",$task)) {
            $errors["name"] = "Your task name should contain letters and spaces only!";
        }
    }

    // validating short desc
    if (empty($_POST["shortDesc"])) {
        $errors["desc"] = "You should enter a short description about the task!"; 
    } else {
        $desc = $_POST["shortDesc"];
        if (!preg_match("/^[a-zA-Z\s]+$/",$desc)) {
            $errors["desc"] = "Short description should only contain letters and spaces!";
        }
    }   
    // evaluate if the form is valid or not
    if (array_filter($errors)) {
        $formValid = 0;
        // not valid, not redirect
    } else {
        $formValid = 1;
        header("Location: index.php");
    }

    $id = $_POST["id_to_update"];
    $id_to_update = $_POST["id_to_update"];

    if ($formValid == 1) {
        include("config/db_connect.php");

        $time = date("Y-m-d");
       
        $sql = "UPDATE tasks 
        SET task_name='$task', short_desc='$desc', created_at='$time' 
        WHERE id='$id_to_update'";
    
        echo "<br><br><br>hello world";
        if(mysqli_query($conn, $sql)) {
            // success
            header("Location: index.php");
        } else {
            echo "<br><br><br>Query Error: " . mysqli_error($conn) . "!";
        }
        $conn->close();
    } 
}

// it will return true because of the url
if (isset($_GET["id"])) {
    include("config/db_connect.php");

    // to avoid the sql injection
    $id = mysqli_real_escape_string($conn, $_GET["id"]);

    // query command 
    $sql = "SELECT * FROM tasks WHERE id='$id'";

    // making the query
    $result = mysqli_query($conn, $sql);

    // creating a associative array from the results
    $task_data = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    $conn->close();
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit & Save</title>
</head>

    <?php include("templates/header.php"); ?>

    <?php if ($task_data): ?>
    <div class="container">
        <form class="form-signin" action="edit.php?id=<?php echo $id?>" method="POST">
            <div class="text-center mb-4">
                <h1 class="h3 mb-3 font-weight-normal">Edit To-Do</h1>
            </div>

            <div class="form-label-group">
                <label>Created By</label>
                <input class="form-control" value="<?php echo $task_data["email"]; ?>" readonly>
            </div>
            <br>

            <div class="form-label-group">
                <label>Created At</label>
                <input class="form-control" value="<?php echo $task_data["created_at"] ?>" readonly>
            </div>

            <br>
            <div class="form-label-group">
                <label for="taskName">Name of your Task
                    <div style="display:<?php if(!$errors["name"]) {echo "none";} else {echo "block";} ?>" class="alert alert-danger"> <?php if($errors["name"]) {echo $errors["name"];} ?> </div>
                </label>
                <input name="taskName" class="form-control" placeholder="Task Name" value="<?php if(!$task){ echo $task_data["task_name"];} else {echo $task;} ?>" required>
            </div>
            
            <br>
            <div class="form-label-group">
                <label for="shortDesc">Description
                    <div style="display:<?php if(!$errors["desc"]) {echo "none";} else {echo "block";} ?>" class="alert alert-danger"> <?php echo $errors["desc"]; ?> </div>
                </label>
                <input name="shortDesc" class="form-control" value="<?php if(!$desc){ echo $task_data["short_desc"];} else {echo $desc;} ?>" placeholder="Description">
            </div>

            <br>
            <br>
            <div class="row">
                <div class="col-6">
                    <input type="hidden" name="id_to_update" value="<?php echo $_GET['id'] ?>">
                    <input class="btn btn-lg btn-primary btn-block" name="update" type="submit" value="Save Task"></input>
                </div>
                <div class="col-6">
                    <input type="hidden" name="id_to_delete" value="<?php echo $_GET['id'] ?>">
                    <input class="btn btn-lg btn-danger btn-block" name="delete" type="submit" value="Delete Task">  
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-3"></div>
                <div class="d-flex col-6 justify-content-center">
                    <a href="index.php" class="btn btn-lg btn-info btn-block">&laquo; Go Back</a>
                </div>
                <div class="col-3"></div>
            </div>
            <br>
        </form>
    </div>
    
    <?php else: ?> 
        <p class="d-flex justify-content-center"><em>Sorry no such task exists... </em> 🙁</p>
        <br>
        <br>
    <?php endif ?>

    <?php include("templates/footer.php"); ?>

</html>