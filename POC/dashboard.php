<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Create your Virtual Machin here</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('db.php');
    session_start();
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['RAM'])) {
        // removes backslashes
        $username = stripslashes($_SESSION['username']); //stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $RAM    = stripslashes($_REQUEST['RAM']);
        $RAM    = mysqli_real_escape_string($con, $RAM);
        $CPU = stripslashes($_REQUEST['CPU']);
        $CPU = mysqli_real_escape_string($con, $CPU);
        $create_datetime = date("Y-m-d H:i:s");
        $port    = "SELECT max(IF(port IS NULL OR port = '',3000,port)) + 1 as port FROM `Machines`";
        $port_result = mysqli_query($con, $port) or die(mysql_error());
        $port_result = $port_result->fetch_array()[0];
        $query    = "INSERT into `Machines` (username, RAM, CPU, port, create_datetime)
                     VALUES ('$username', '$RAM', '$CPU', '$port_result', '$create_datetime')";
        $result   = mysqli_query($con, $query);
        $container_name = $username."_".$port_result;
        $docker_command = "docker run -d -e PUID=1000 -e PGID=1000 -e TZ=Europe/London -v /path/to/data:/config --restart unless-stopped --cpus=".$CPU." --memory=".$RAM."gb --name=".$container_name." -p ".$port_result.":3000 lscr.io/linuxserver/webtop:fedora-mate";
        $output = shell_exec($docker_command);
        if ($result) {
            // $output = shell_exec($docker_command);
            echo "<pre>$output</pre>";
            echo "<div class='form'>
                  <h3>Machine created Successfully.</h3><br/>
                  <p class='link'>Click here to create new machine <a href='dashboard.php'>New Machine</a></p>
                  <p class='link'>Click here to see list of machine <a href='VMDetails.php'>Active Machines</a></p>
                  </div>";
            
            // $Machine_list = "SELECT id, username, CPU, RAM, port, create_datetime FROM `Machines` WHERE username = '$username'";
            // $Machine_list_result = mysqli_query($con, $Machine_list);
            // echo "<div class='form'>
            //       <h3>List of Machines running.</h3><br/>
            //       </div>";
            // if ($Machine_list_result->num_rows > 0) {
            //     // output data of each row
            //     while($row = $Machine_list_result->fetch_assoc()) {
            //         $docker_kill = "docker kill ".$row["username"]."_".$row["port"];
            //         echo "<br> Id:". $row["id"]. ", username:". $row["username"]. ", CPU:". $row["CPU"]. ", RAM:" . $row["RAM"] . ", port:" . $row["port"] .  ", create_datetime:" . $row["create_datetime"] .  "<br>";
            //         // "<p class='link'>Click to delete machine <a href=shell_exec($docker_kill)>Delete Machine</a></p>
            //     }
            // } else {
            //     echo "0 results";
            // }
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>admin</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" action="" method="post">
        <p>Hey, <?php echo $_SESSION['username']; ?>!</p>
        <h1 class="login-title">Create your Virtual Machine Here!!</h1>
        <input type="text" class="login-input" name="RAM" placeholder="RAM" required />
        <input type="text" class="login-input" name="CPU" placeholder="CPU">
        <input type="submit" name="submit" value="Create" class="login-button">
        <p><a href="VMDetails.php">Virtual Machine List</a></p>
        <p><a href="logout.php">Logout</a></p>        
    </form>
<?php
    }
?>
</body>
</html>