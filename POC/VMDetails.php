<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>List of Virtual Machines here</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<form class="form" method="post" name="login">
                <h1 class="login-title">List of Virtual Machines here</h1>
                <!-- <input type="submit" value="Login" name="submit" class="login-button"/> -->
                <!-- <p class="link"><a href="registration.php">New Registration</a></p> -->
          </form>
<?php
    require('db.php');
    session_start();
    // When form submitted, insert values into the database.
    $username = stripslashes($_SESSION['username']); //stripslashes($_REQUEST['username']);
    //escapes special characters in a string
    $username = mysqli_real_escape_string($con, $username);
    // $output = shell_exec($docker_command);
    $Machine_list = "SELECT id, username, CPU, RAM, port, create_datetime FROM `Machines` WHERE username = '$username'";
    $Machine_list_result = mysqli_query($con, $Machine_list);
    if ($Machine_list_result->num_rows > 0) {
        // output data of each row
        while($row = $Machine_list_result->fetch_assoc()) {
            $docker_kill = "docker kill ".$row["username"]."_".$row["port"];
            echo "<br> Id:". $row["id"]. ", username:". $row["username"]. ", CPU:". $row["CPU"]. ", RAM:" . $row["RAM"] . ", port:" . $row["port"] .  ", create_datetime:" . $row["create_datetime"] .  "<br>";
            // <input type="submit" value="Login" name="submit" class="login-button"/>;
        }
    } else {
        echo "0 results";
    }
    echo "<div class='form'>
    <p class='link'>Click here to create new machine <a href='dashboard.php'>New Machine</a></p>
    <p class='link'><a href='logout.php'>Logout</a></p>
    </div>";
        ?>
</body>
</html>