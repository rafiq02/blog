<?php require_once 'header.php'; ?>
<pre>
<?php
$mg='1';
if($_SESSION==NULL) {
	header("Location: sign_in.php?msg=$mg&msg2=$mg2");
 }

$sql=mysqli_query( $conn,"SELECT * FROM post");

$posts=mysqli_fetch_all ($sql, MYSQLI_ASSOC);



foreach ($posts as $var ) {
	$p=$var['post_id'];
	print_r($var);
	
	echo "<a href='posts.php?sent_id=$p'>Details</a>";
	
	
	
}
echo "</br></br></br></br>";

//remember about ' and  "
  //else {
//    header('Location: userpage.php');
// }

?>
<?php require_once 'footer.php';?>