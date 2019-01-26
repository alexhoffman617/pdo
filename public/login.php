<?php
   ob_start();
   session_start();
?>

<?
   // error_reporting(E_ALL);
   // ini_set("display_errors", 1);
?>

<html lang = "en">
   
   <head>
      <title>Tutorialspoint.com</title>
      <link href = "css/bootstrap.min.css" rel = "stylesheet">
      
      <style>
         body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #ADABAB;
         }
         
         .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
            color: #017572;
         }
         
         .form-signin .form-signin-heading,
         .form-signin .checkbox {
            margin-bottom: 10px;
         }
         
         .form-signin .checkbox {
            font-weight: normal;
         }
         
         .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
         }
         
         .form-signin .form-control:focus {
            z-index: 2;
         }
         
         .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            border-color:#017572;
         }
         
         .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-color:#017572;
         }
         
         h2{
            text-align: center;
            color: #017572;
         }
      </style>
      
   </head>
	
   <body>
      
      <h2>Enter Username and Password</h2> 
      <div class = "container form-signin">
         
         <?php
         
         require "../config.php";
         require "../common.php";

         if (isset($_POST['submit']) && !empty($_POST['email']) 
            && !empty($_POST['password'])) {

                $msg = '';
            
                try  {
                  $connection = new PDO($dsn, $username, $password, $options);

                  $sql = "SELECT * 
                          FROM owners
                          WHERE email = :email AND pass = :pass";
              
                  $email = $_POST['email'];
                  $password = $_POST['password'];
                  $statement = $connection->prepare($sql);
                  $statement->bindParam(':email', $email, PDO::PARAM_STR);
                  $statement->bindParam(':pass', $password, PDO::PARAM_STR);
                  $statement->execute();
              
                  $result = $statement->fetchAll();
            
                  if ($result && $statement->rowCount() > 0) {
                    echo 'You are logged in';
                  } else {
                   $msg = 'Wrong email or password';
                  }
                } catch(PDOException $error) {
                    echo $sql . "<br> Login Failed:" . $error->getMessage();
                }
              }
         ?>
      </div> <!-- /container -->
      
      <div class = "container">
      
         <form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input type = "text" class = "form-control" 
               name = "email" placeholder = "email = test@test.com" 
               required autofocus></br>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "password = password" required>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "submit">Login</button>
         </form>
			
         Click here to clean <a href = "logout.php" tite = "Logout">Session.
         
      </div> 

      <a href="index.php">Back to home</a>

      
   </body>
</html>