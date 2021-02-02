<?php 

echo "<br><br><br>";
$tasks = array("id"=>"","task_name"=>"","short_desc"=>"","finished_at"=>"");
include("config/db_connect.php");

// writing the command 
$sql = "SELECT id, task_name, short_desc, finished_at FROM `done tasks` ORDER BY finished_at DESC";

// getting the results 
$result = $conn->query($sql);

// converting the results into an associative array
if ($result) {
    $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
if ($result) {
    mysqli_free_result($result);
}

if (isset($_POST["sendto"])) {
    // delete from done tasks 
    // insert into tasks
    $id = $_POST["id"];
    $task = $_POST["name"];
    $desc = $_POST["desc"];

    $sql = "INSERT INTO tasks (id,task_name,short_desc,email) VALUES ($id,'$task','$desc','Anonymous')";
    $othersql = "DELETE FROM `done tasks` WHERE id='$id'";
    if(mysqli_query($conn,$sql)) {
        // success
    } else {
        echo "<br><br><br>Connection Problem: " . mysqli_error($conn);
    }

    if (mysqli_query($conn,$othersql)) {
        // success
        header("Location: done_tasks.php");
    } else {
        echo "<br><br><br>Connection Problem: " . mysqli_error($conn);
    }
} else if (isset($_POST["delete"])) {
    // delete from done tasks
    $id = $_POST["id"];
    $sql = "DELETE FROM `done tasks` WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: done_tasks.php");
    } else {
        echo "There has been a problem: " . mysqli_error($conn);
    }

} 

$conn->close();

?>

<html>
<head>

<title>Done Tasks</title>
<style>
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
    .wrapper {
        opacity: 0.5;
    }
</style>

</head>

<?php include("templates/header.php"); ?>

    <header>
        <div class="p-4 mb-4">
            <h3 class="d-flex justify-content-center p-2">Done Tasks ✔🎯</h3>    
        </div>
    </header>

    <?php foreach($tasks as $task): ?>
        <div class="col-lg-4">
            <div class="wrapper">
                <img class="rounded-circle" src="https://cdn.pixabay.com/photo/2019/01/10/14/47/mountain-3925437_1280.jpg" alt="Generic placeholder image" width="140" height="140">
                <br>
                <h2><?php echo htmlspecialchars($task["task_name"]) ?></h2>
                <p><?php echo htmlspecialchars($task["short_desc"]) ?></p>
                <em>Completed On: <?php echo htmlspecialchars($task["finished_at"]) ?> </em>
            </div>            
            <br>
            <div class="row d-flex justify-content-center">
            <form action="done_tasks.php" method="POST">
                <input type="hidden" name="name" value="<?php echo $task['task_name']?>">
                <input type="hidden" name="desc" value="<?php echo $task['short_desc']?>">
                <input type="hidden" name="id" value="<?php echo $task['id']?>">
                <div class="row">
                    <div class="col-4">
                        <input type="submit" class="btn btn-danger" name="delete" role="button" value="Delete">
                    </div>
                    <div class="col-8">
                        <input type="submit" class="btn btn-info" name="sendto" role="button" value="Send to To-Do List &raquo;">
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

<?php include("templates/footer.php"); ?>

<script>
    $("#addLink").removeClass("active");
    $("#doneLink").addClass("active");
</script>

</html>