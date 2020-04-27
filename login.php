<!DOCTYPE html>
<html>
    <?php 
        include 'includes/header.php';
        include "server/connect.php";
        if($_POST){
            $uname = $_POST["username"];
            $pwd = $_POST["password"];
            $sql = "SELECT fname,lname FROM employee where username='".$uname."' and password='".$pwd."'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                header("Location: http://localhost/blackgate/index.php");
                echo "<script> alert('Connected Successfully!'); </script>";
            }
            else{
                echo "<script>alert('Invalid Credentials. Try Again!'); </script>";
            }
        }
    ?>
    <body>
        <div class="container-fluid text-center top-container">
            <img src="images/prison_icon.png">
        </div>
        <h1 class="text-center">Login</h1>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h3></h3>
                <form name="login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"><!-- onsubmit="return validate();"> -->
                    <label for="username"><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="username" id="username" required>
                    <br>
                    <label for="password"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" id="password" required>
                    <br class="clear">
                    <input class="btn-submit" type="submit" name="submit" value="Login">
                </form>
            </div>
        </div>
    </body>
</html>