<?php
    echo "<br><br><br>";
    include("config/db_connect.php");

    // testing out session variables
    session_start();
    $query = $_SERVER["QUERY_STRING"];
    if ($_SERVER["QUERY_STRING"]) {
        echo "$query<br>";
        unset($_SESSION["name"]);
    }
    $name = $_SESSION["name"] ?? "Guest";
    echo $name . "<br>";

    // get cookie
    $gender = $_COOKIE["gender"] ?? "Unknown";
    echo "$gender<br>";


    $command = "SELECT task_name, short_desc,id,created_at FROM tasks ORDER BY created_at";
    $result = $conn->query($command); 
    // alternative
    # $result = mysqli($conn, $command);


    // turn results into an array
    $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);




    if (isset($_POST["done"])) {
        // transferring the data to other data table
        $id = $_POST["id"];
        $name = $_POST["name"];
        $desc = $_POST["desc"];

        // done task insert commnad 
        $sql = "INSERT INTO `done tasks`(id,task_name,short_desc) VALUES ($id,'$name', '$desc')";
        $othersql = "DELETE FROM tasks WHERE id='$id'";

        if (mysqli_query($conn,$sql)) {
            // success
            
        } else {
            echo "Database Connection Error: " . mysqli_error($conn) . "!";
        }
        if (mysqli_query($conn,$othersql)) {
            // success
            header("Location: index.php");
        } else {
            echo "Database Connection Error: " . mysqli_error($conn) . "!";
        }
    }

    mysqli_free_result($result);
    $conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            #dash {
                color: white;
            } 
            .col-lg-4 {
                margin-bottom: 1.5rem;
                text-align: center;
            }
            .col-lg-4 p {
                margin-right: .75rem;
                margin-left: .75rem;
            }
            header .container {
                background: #f3f3f3;
            }
        </style>
        <script defer>
            
        </script>
    </head>
    <?php include("templates/header.php"); ?>

        <header>
            <div class="p-4 mb-4">
                <h3 class="d-flex justify-content-center p-2">Tasks 🎯⏰</h3>    
            </div>
        </header>
        <section class="container">
            <div class="row">
                <?php foreach($tasks as $task): ?> 
                    <div class="col-lg-4 myCard">
                        <img class="rounded-circle" src="https://cdn.pixabay.com/photo/2019/01/10/14/47/mountain-3925437_1280.jpg" alt="Generic placeholder image" width="140" height="140">
                        <h2 class="myHeading"><?php echo htmlspecialchars($task["task_name"]) ?></h2>
                        <p><?php echo htmlspecialchars($task["short_desc"]) ?></p>
                        <em>Assigned On: <?php echo htmlspecialchars($task["created_at"]) ?> </em>
                        <br><br>
                        <div class="row d-flex justify-content-center">
                            <form action="index.php" method="POST">
                                <input type="hidden" name="name" value="<?php echo $task['task_name']?>">
                                <input type="hidden" name="desc" value="<?php echo $task['short_desc']?>">
                                <input type="hidden" name="id" value="<?php echo $task['id']?>">
                                <div class="row">
                                    <div class="col-6">
                                        <input type="submit" class="btn btn-success" name="done" role="button" value="Mark As Done✔">
                                    </div>
                                    <div class="col-6">
                                        <p><a class="btn btn-secondary" href="edit.php?id=<?php echo $task["id"] ?>" role="button">View details &raquo;</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.col-lg-4 -->
                <?php endforeach ?>
                <?php if(!$tasks): ?> 
                    <div class="container">
                        <p class="justify-content-center d-flex"><em>No data to display...</em>😢</p>   
                    </div>
                <?php endif ?>
                <br><br><br>
            </div>
        </section>
      
    <br><br>
    <?php include("templates/footer.php"); ?>

</html>