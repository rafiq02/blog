<h2>Welcome to what</h2>
<header>
	This is the header
<a href="home.php">Home</a>

<a href="registration.php">Registration</a>
<?php session_start();
if($_SESSION!=NULL) {
 ?>
 <a href="userpage.php">My Posts</a>
<a href="logout.php">Logout</a>
<?php } else { ?>
<a href="sign_in.php">Sign in</a>
<?php } ?>
<?php require_once 'db_con.php'; ?>

</header>