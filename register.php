<?php

session_start();
$msg = '';

// If user has given a captcha!
if (isset($_POST['input']))

    // If the captcha is valid
    if ($_POST['input'] == $_SESSION['captcha'])
    {
        $msg = '<span style="color:green">SUCCESSFUL!!!</span>';
        $username = $_POST['txtName'];
        $email = $_POST['txtEmail'];
        $phone = $_POST['txtPhone'];
        $password = $_POST['txtPassword'];
        $conn = mysqli_connect("localhost","root","root","php_db") or die(mysqli_error());
        $query = "insert into tbl_user(userName, userEmail, userContact, userPassword) values('".$username."', '".$email."', ".$phone.",'".$password."')";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        echo "<script>window.location='login.php'</script>";
    }
    else
        $msg = '<span style="color:red">CAPTCHA FAILED!!!</span>';
?>

<style>
    body{
        display:flex;
        flex-direction:column;
        align-items: center;
        justify-content: center;
    }
</style>

<body>
   <!--  <h2>PROVE THAT YOU ARE NOT A ROBOT!!</h2>
    
    <strong>
        Type the text in the image to prove
        you are not a robot
    </strong> -->
    <h1>Register</h1>
    <form method="POST" action=" <?php echo $_SERVER['PHP_SELF']; ?>">
        <label>Full Name: </label>
        <input type="text" name="txtName"/><br/><br/>
        <label>Email Id: </label>
        <input type="email" name="txtEmail"><br/><br/>
        <label>Phone: </label>
        <input type="text" name="txtPhone"><br/><br/>
        <label>Password: </label>
        <input type="password" name="txtPassword"><br/><br/>
        <div style='margin:15px'>
            <img src="captcha.php">
        </div>
        <input type="text" name="input"/>
        <input type="hidden" name="flag" value="1"/>
        <input type="submit" value="Submit" name="submit"/>
        <p>Existing user? <a href="login.php">Login here..</a></p>
    </form>
    
    <div style='margin-bottom:5px'>
        <?php echo $msg; ?>
    </div>
    
    <div>
        Can't read the image? Click
        <a href='<?php echo $_SERVER['PHP_SELF']; ?>'>
            here
        </a>
        to refresh!
    </div>
</body>