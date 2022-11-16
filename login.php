<?php session_start()?>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <center>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label>Email or Phone Number </label><br/>
                <input type="text" name="txtUname"/><br/><br/>
                <label>Password </label><br/>
                <input type="password" name="txtPassword"><br/><br/>
                <input type="submit" name="btnSubmit" value="Login">
            </form>
            <p>Or new here? <a href="register.php">Be a user</a></p>
        </center>
        <?php 
            if(isset($_POST["btnSubmit"])){
                $username = $_POST['txtUname'];
                $password = $_POST['txtPassword'];
                $conn = mysqli_connect("localhost","root","root","php_db") or die(mysqli_error());
                $query = "select * from tbl_user where userEmail = '".$username."' and userPassword = '".$password."'";
                $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

                if(mysqli_num_rows($result)>0){
                    echo "<script>window.location='dashboard.php'</script>";
                    $_SESSION['login']="true";
                }
                else{
                    $query1 = "select * from tbl_user where userContact = '".$username."' and userPassword = '".$password."'";
                    // echo $username."  ".$password;
                    $result1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
                    if(mysqli_num_rows($result1)>0){
                        echo "<script>window.location='dashboard.php'</script>";
                        $_SESSION['login']="true";
                    }
                    else{
                        echo "<center>Login failed: Invalid credentials</center>";
                    }
                }
            }
        ?>
    </body>
</html>