<?php require_once 'header.php'; ?>

<?php

$nerr=$passerr=$usererr=$mailerr='';
$name=$username=$password=$email='';
$msg='';

if($_SERVER["REQUEST_METHOD"]=="POST"){
        if (empty($_POST["name"])) {
     $nerr = "Name is required";
   } else {
     $name = input($_POST["name"]);
   }
    if (empty($_POST["username"])) {
     $usererr = "Username is required";
   } else {
     $username = input($_POST["username"]);
   }
    if (empty($_POST["password"])) {
     $passerr = "Password is required";
   } else {
     $password = input($_POST["password"]);
   }
    if (empty($_POST["email"])) {
     $mailerr = "E-mail is required";
   } else {
     $email = input($_POST["email"]);
   }
   $use=mysqli_query($conn, "SELECT username FROM `user` WHERE username='$username' ");
     
   $num=mysqli_num_rows($use);

   if($num!=0) {
    $msg="Username already exists";
  }
   else if ($nerr==''&&$passerr==''&&$usererr==''&&$mailerr=='')
   {
   	print_r($name);
   	print_r($username);
   	print_r($password);
   	print_r($email);
   	$result = mysqli_query($conn, "SELECT id FROM user");
   	$row_f=mysqli_num_rows($result);
   	$sql=mysqli_query( $conn,"INSERT INTO user (`id`, `name`, `username`, `password`, `e-mail`) VALUES (NULL, '$name', '$username', '$password', '$email')");
   	$result = mysqli_query($conn, "SELECT id FROM user");
   	$row_s=mysqli_num_rows($result);

   	if($row_s>$row_f){ $msg="Registration Successful";}
   	else {$msg="Registration Error";}

   	//header('Location: userpage.php');


   }
}


function input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}


?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="utf=8">
</br></br>
<?php echo $msg;?></br></br>
<label for="nam">Name:</label>
<input type="text" name="name"  value="<?php echo $name?>" placeholder="please enter your name">*<?php echo $nerr;?>
</br></br>
<label for="user">Username:</label><input type="text" name="username"  value="<?php echo $username?>" placeholder="please enter your username">*<?php echo $usererr;?>
</br></br>
<label for="pass">Password:</label><input type="password"  minlength="8" name="password"  value="" placeholder="At least 8 character">*<?php echo $passerr;?>
</br></br>
<label for="mail">E-mail:</label><input type="email" name="email"  value="<?php echo $email?>" >*<?php echo $mailerr;?>
</br></br>
<input type="submit" name="reg" value="Registration">

</form>

<?php require_once 'footer.php';?>
