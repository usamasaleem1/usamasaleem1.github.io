<?php session_start(); ?>
<?php include('dbcon.php'); ?>

<?php
	if (isset($_POST['submit']))
		{
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);
			
			$query 		= mysqli_query($conn, "SELECT * FROM register WHERE password='$password' and email='$email'");
			$row		= mysqli_fetch_array($query);
			$num_row 	= mysqli_num_rows($query);
			
			if ($num_row > 0) 
				{		
					$_SESSION['loggedin'] = true;	
					$_SESSION['email']=$row['email'];
					if ($password == "admin" && $email == "admin"){
						$_SESSION['permission'] = 'admin';
						header('location:backstore.php');
					} else {
						$_SESSION['permission'] = 'user';
						header('location:home.html');
					}
					
				}
			else
				{
					$_SESSION['loggedin'] = false;
					header('location:signinpageError.php');
				}
		}

		function verifyAdmin() {
			if($_SESSION['permission'] != 'admin')
			{
			header('location:home.html');
			}
		}
  ?>