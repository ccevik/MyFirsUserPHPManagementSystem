<?php include 'base.php'; ?>
<html>
<head>
  <title>My First User Management System</title>
</head>
<body>

<div id="main">
<?php

if(!empty($_SESSION['logged_in']) && !empty($_SESSION['username']))
{
               //ACCESS THE MAIN PAGE
?>


            <h1>MEMBER AREA</h1>
            <p>Thanks for Log in. You are<?php $_SESSION['username']; ?></p>
            <a href="logout.php">Logout</a>
 
<?php 
}elseif(!empty($_POST['username']) && !empty($_POST['password']))
{
                 //LET THE USER LOGIN

$username = mysql_real_escape_string($_POST['username']);
$password = mysql_real_escape_string($_POST['password']);

$checklogin = mysql_query("SELECT * FROM users WHERE username ='$username' AND password = '$password'");

            if(mysql_num_rows($checklogin) == 1)
            {
               $row = mysql_fetch_array($checklogin);
               $email = $row['email_address'];
               
               $_SESSION['username'] = $username;
               $_SESSION['email_address'] = $email;
               $_SESSION['logged_in'] = 1;
               
               echo '<h1>Success</h1>';
               echo '<p>We are now redirecting you to the member area.</p>';
            
            }else
            {
               echo '<h1>Error</h1>';
               echo '<p>Sorry, your account could not be found. Please <a href="index.php">Click here to try again.</a></p>';
            
            }
         }else{
?>         
             <h1>MEMBER LOGIN</h1>
             <p>Thanks for visiting! Please either login below, or <a href="register.php">Click here to register</a></p>
             <form method="POST" action="index.php" name="loginform" id="loginform">
                   <fieldset>
                       <label for="username">Username:</label><input type="text" name="username" id="username"/><br>
                       <label for="password">Password:</label><input type="password" name="password" id="password" /><br>
                       <input type="submit" name="login" id="login" value="login" />
                   </fieldset>
             
             
             </form>
             
             <?php
             }
?>












</div>
</body>
</html>