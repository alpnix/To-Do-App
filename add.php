<?php
include("config/connect_db.php");

$email = $task = $desc = "";
$errors = array("email"=>NULL,"name"=>NULL,"desc"=>NULL);


if (isset($_POST["submit"])) {

    include("config/validate_info.php");

    if ($formValid == 1) {
        // avoiding sql injection
        $email = mysqli_real_escape_string($conn, $email);
        $task = mysqli_real_escape_string($conn, $task);
        $desc = mysqli_real_escape_string($conn, $desc);
        // typing the command 
        $sql = "INSERT INTO tasks (task_name,email,short_desc) VALUES ('$task','$email','$desc')";

        if (mysqli_query($conn, $sql)) {
            // success
            header("Location: index.php");
        } else {
            // error
            echo "query error: " . mysqli_error($conn); 
        }
    }

}

?>
<!DOCTYPE html>
<html>

    <?php include("templates/header.php"); ?>
    <?php echo "<br><br><br>";?>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Adding a New Task</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/floating-labels/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        #addItem {
            color: white;
        } 
    </style>

  </head>

  <body>
    <div class="container">
        <form class="form-signin" action="add.php" method="POST">
            <div class="text-center mb-4">
                <h1 class="h3 mb-3 font-weight-normal">Add To-Do</h1>
            </div>

            <div class="form-label-group">
                <label for="inputEmail">Your Email
                    <div style="display:<?php if(!$errors["email"]) {echo "none";} else {echo "block";} ?>" class="alert alert-danger"> <?php if($errors["email"]) {echo $errors["email"];} ?> </div>            
                </label>
                <input name="email"" id="inputEmail" class="form-control" value="<?php if($email != "") {echo $email;} ?>" placeholder="Your Email" autofocus>
            </div>
            <br>
            <div class="form-label-group">
                <label for="taskName">Name of your Task
                    <div style="display:<?php if(!$errors["name"]) {echo "none";} else {echo "block";} ?>" class="alert alert-danger"> <?php if($errors["name"]) {echo $errors["name"];} ?> </div>
                </label>
                <input name="taskName" class="form-control" placeholder="Task Name" value="<?php echo $task ?>" required>
            </div>
            <br>
            <div class="form-label-group">
                <label for="shortDesc">Description
                    <div style="display:<?php if(!$errors["desc"]) {echo "none";} else {echo "block";} ?>" class="alert alert-danger"> <?php echo $errors["desc"]; ?> </div>
                </label>
                <input name="shortDesc" class="form-control" value="<?php echo $desc ?>" placeholder="Description">
            </div>
            <br>
            <br>
            <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Add Task</button>
            <br>
        </form>
    </div>
    <script>
        const addItem = document.querySelector("#add");
        const dash = document.querySelector("#dash");
        dash.removeClass("active");
        addItem.addClass("active");
    </script>
  </body>
    <?php include("templates/footer.php"); ?>
<script>
    $("#addLink").addClass("active");
    $("#doneLink").removeClass("active");
</script>


</html>
