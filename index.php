<?php

include 'connection/DBBroker.php';
include 'model/User.php';
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
   // $conn=new mysqli();
   $uname = $_POST['username'];
   $upass = $_POST['password'];
   $korisnik = new User(1, $uname, $upass);
   $odgovor = User::logInUser($uname, $upass, $conn);
   if ($odgovor->num_rows == 1) {
      echo "<script> console.log('Uspesno ste se prijavili!') </script>";
     
      $_SESSION['user_id'] = $korisnik->id;
      header('Location: main.php');
      exit();
   } else {
      echo "Neuspšna prijava.";
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>LogIn</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">

</head>

<body>
   
   <form method="POST" action="#" id="frmID">
      
      <div class="con">
        
         <header class="head-form">
            <h2>Log In</h2>
            <p>login here using your username and password</p>
         </header>
        
         <br>
         <div class="field-set">

           
            <span class="input-item">
               <i class="fa fa-user-circle"></i>
            </span>
           
            <input class="form-input" id="txt-input" name="username" type="text" placeholder="UserName" required>

            <br>

           
            <span class="input-item">
               <i class="fa fa-key"></i>
            </span>
            
            <input class="form-input" type="password" placeholder="Password" id="pwd" name="password" required>
            <br>
            <button class="log-in" type="submit" name="submit">Log In</button>
         </div>

      </div>

   </form>
   </div initial-scale="1.0">
   <script src="logIn.js"></script>
</body>

</html>