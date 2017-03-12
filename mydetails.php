<?php require_once 'header.php';?>
<?php if($_SESSION==NULL)header('Location:home.php');
	
$cerr="";
print_r($_POST);

$postid=$_REQUEST["sent_id"];

if(isset($_GET['del_id'])){
$did=$_REQUEST["del_id"];
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
        if (empty($_POST["comm"])) {
     $cerr="Comment field is empty";
   }else {
     $cm = filter($_POST["comm"]);
     $cm = mysqli_real_escape_string($conn, $cm);
     $uid=$_SESSION['id'];
     $cmt=mysqli_query($conn, "INSERT INTO `comment` ( `post_id`, `user_id`, `content`) VALUES ( '$postid', '$uid', '$cm');" );
   }

}
   function filter($q) {
     $q = trim($q);
     $q = stripslashes($q);
     $q = htmlspecialchars($q);
     return $q;
  }
   ?>
<pre>
<?php


 $sql=mysqli_query($conn,"SELECT * FROM post WHERE post_id='$postid'");
 if(isset($_GET['del_id'])){
$did=$_REQUEST["del_id"];

 if($did!=NULL){
 	echo $did;
 $dql=mysqli_query($conn,"DELETE FROM comment WHERE comment_id='$did'");
}
}
$data=mysqli_fetch_array ($sql);

print_r($data);
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?sent_id=$postid";?>" method="post" accept-charset="utf=8">

Comment: <input type="text" name="comm" ></br></br>
<?php echo $cerr?>
<input type="submit" name="Post Comment">
</form>
<?php
$pql=mysqli_query($conn,"SELECT * FROM comment  WHERE post_id='$postid' ORDER BY c_time DESC");


while($ok=mysqli_fetch_array($pql)){
	$ci=$ok['comment_id'];

 echo "<a href='mydetails.php?del_id=$ci&sent_id=$postid'>Delete</a>";


print_r($ok);

}
?>

