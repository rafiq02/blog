<?php require_once 'header.php';?>
<?php

 $postid=$_REQUEST["sent_id"];
 echo "<pre>";
 $sql=mysqli_query($conn,"SELECT * FROM post WHERE post_id='$postid'");

$data=mysqli_fetch_all ($sql, MYSQLI_ASSOC);

 print_r($data);


$posterr="";
$comment='';
$uid=$pid='';
if($_SERVER["REQUEST_METHOD"]=="POST"){
        if (empty($_POST["comment"])) {
     $posterr = "Comment field is empty";
   } else {
     $comment = inputs($_POST["comment"]);
     
     $uid=$_SESSION['id'];
     $cmt=mysqli_query($conn, "INSERT INTO `comment` ( `post_id`, `user_id`, `content`) VALUES ( '$postid', '$uid', '$comment');");

   }
   
    
   
}

function inputs($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);

   return $data;
}
?>

<?php echo $posterr;?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?sent_id=$postid";?>" method="post" accept-charset="utf=8">
  <textarea cols="50"  name="comment" rows="5"></textarea>
  <input type="submit" name="post" value="post">
  <input type="hidden" name="hid" value="<?php echo $p?>">
  </form>


<?php
$com=mysqli_query($conn,"SELECT * FROM comment WHERE post_id='$postid' ORDER BY c_time DESC ");



while($row = mysqli_fetch_array($com)){
  echo $row['content']. " - ". $row['user_id'];
  echo "<br />";
}
?>

<?php require_once 'footer.php'?>