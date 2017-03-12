
<?php require_once 'header.php'; ?>
<?php
$mg="";
 if($_REQUEST!=NULL){
 if($_REQUEST["msg"]=="1") {
 $mg="You have to log in first";
 }

// if($_REQUEST["msg2"]=="2") {
// $mg="lsadjflasdjfljl";
// }
}

  $nameErr = $passwordErr ="";
   $name=$password  ="";
   $err='';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["username"])) {
     $nameErr = "Username is required";
   } else {
     $name = test_input($_POST["username"]);
   }
   
   if (empty($_POST["password"])) {
     $passwordErr = "Password is required";
   } else {
     $password = test_input($_POST["password"]);
   }
    

   if($nameErr==''&&$passwordErr ==''){
    
  $sql=mysqli_query( $conn, "SELECT * FROM user WHERE username='$name' AND password='$password' ");
  
	$num_rows = mysqli_num_rows($sql);
  
  $data=mysqli_fetch_array($sql);

    $unam=$data['username'];
    $id=$data['id'];
    $nam=$data['name'];
    
    if($num_rows == 0) {
	$err="Username & password don't match";
	}
    else{
          
  $_SESSION["username"] = "$unam";
  $_SESSION["id"] = "$id";
  $_SESSION["name"] = "$nam";
  print_r($_SESSION);
     	      header('Location: userpage.php');
      }
       }
  }

  function test_input($data) {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
  }
  ?>
  <?php echo $mg?>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="utf-8">
   <span> <?php echo $err; ?></span>
  </br></br>
  	Username: <input type="text" name="username" value="<?php echo $name?>">
  <span class="error"> <?php echo $nameErr;?></span>
  </br></br>
  Password:
  <input type="password" name="password">
  <span class="error"> <?php echo $passwordErr;?></span>
  <br><br>

  <input type="submit" name="submit" value="Log in"> 
  </form>
  <?php require_once 'footer.php';?>

