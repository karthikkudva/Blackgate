<?php
    include "connect.php";
    $uname = $_POST["username"];
    $pwd = $_POST["password"];
    // echo "username : ".$uname."\npassword : ".$pwd;
    $sql = "SELECT fname,lname FROM employee where username='".$uname."' and password='".$pwd."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo "<h1>Connected Successfully!</h1><br>";
        echo "<h2>Welcome Mr.".$user['fname']." ".$user['lname']."</h2><br>";
        header("Location: http://localhost/blackgate/index.php");
    }
    else{
        echo "<script>alert('Invalid Credentials. Try Again!'); </script>";
        header("Location: http://localhost/blackgate/login.php");
    }
?>