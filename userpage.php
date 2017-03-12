
<?php require_once 'header.php'; ?>

<?php if($_SESSION==NULL)header('Location:home.php');
$all=$pt=$terr=$ferr='';

if(isset($_GET['d_id'])){
$di=$_REQUEST['d_id'];
$Dpq=mysqli_query($conn,"DELETE FROM post WHERE post_id='$di'");
header('Location:userpage.php');
}


if($_SERVER["REQUEST_METHOD"]=="POST"){
        if (empty($_POST["ptitle"])) {
     $terr = "Title is required";
   } else {
     $pt = filter($_POST["ptitle"]);
   }
    if (empty($_POST["postmes"])) {
     $ferr = "Post field is empty";
   } else {
     $all = filter($_POST["postmes"]);
   }
}
 function filter($q) {
     $q = trim($q);
     $q = stripslashes($q);
     $q = htmlspecialchars($q);
     return $q;
  }
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset="utf=8">
<?php echo $terr;?>
<p>Post Title:</p><input type="text" name="ptitle" style="width:600px; height:30px;"></br></br>
<?php echo $ferr;?>
Message:<p> <textarea name="postmes" rows="5" cols="70">

</textarea></p>

<input type="submit" name="subp" value="submit post">
</form>
<pre>
<?php  

$s_id=$_SESSION['id'];
$uid=$_SESSION['id'];

if($pt!=NULL){
$in=mysqli_query( $conn,"INSERT INTO post (`post_id`, `user_id`, `post_title`, `details`) VALUES (NULL, '$uid','$pt','$all')");
}
$sql=mysqli_query( $conn, "SELECT * FROM post WHERE user_id='$s_id' ORDER BY p_time DESC");
$rows=mysqli_num_rows($sql);


while ($data=mysqli_fetch_array($sql)) {
  $p=$data['post_id'];

	print_r($data);?>

<a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?d_id=$p";?>">Delete</a>
<?php
   
  echo "<a href='mydetails.php?sent_id=$p'>Details</a>";
}

 ?>
 </pre>
<?php require_once 'footer.php';?>