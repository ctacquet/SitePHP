<?php
	// We need to use sessions, so you should always start sessions using the below code.
	session_start();
	// If the user is not logged in redirect to the login page...
	if (!isset($_SESSION['loggedin'])) {
		header('Location: /');
		exit();
	}
	require 'php/bdd.php';
	// We don't have the password or email info stored in sessions so instead we can get the results from the database.
	$stmt = $con->prepare('SELECT password, email, activation_code FROM accounts WHERE id = ?');
	// In this case we can use the account ID to get the account info.
	$stmt->bind_param('s', $_SESSION['id']);
	$stmt->execute();
	$stmt->bind_result($password, $email, $activated);
	$stmt->fetch();
	$stmt->close();

	//$passwordlength = strlen($password);
	$pass = '';
	for($i=0;$i<10;$i++){
		$pass = $pass . '*';
	}
	if($activated != 'activated'){
		//$activated = 'Please click on this link to activate your account :<br><a href="http://localhost/website/php/activate.php?email='. $email .'&code=' . $activated . '">http://localhost/website/php/activate.php?email='. $email .'&code=' . $activated . '</a> ';
		$activated = 'Please check your email to activate your account';
	} else {
		$activated = 'Account ' . $activated;
	}
?>

<?php include "functions.php" ?>
<?=template_header();?>
    <body>    
        <div class="content">
		    <h3>Profile Page</h3>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
                        <td><i class="fas fa-user"></i></td>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
                        <td><i class="fas fa-lock"></i></td>
						<td>Password:</td>
						<td><?=$pass?></td>
					</tr>
					<tr>
                        <td><i class="fas fa-envelope"></i></td>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
					<tr>
                        <td><i class="fas fa-shield-alt"></i></td>
						<td>Status:</td>
						<td><?=$activated?></td>
					</tr>
				</table>
			</div>
		</div>
    </body>
    <script src="js/modal.js"></script>
</html>
