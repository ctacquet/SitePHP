<?php
    require 'bdd.php';
    // Now we check if the data was submitted, isset() function will check if the data exists.
    if (!isset($_POST['usernameReg'], $_POST['passwordReg'], $_POST['emailReg'])) {
        // Could not get the data that should have been sent.
        die ('Please complete the registration form!');
    }
    // Make sure the submitted registration values are not empty.
    if (empty($_POST['usernameReg']) || empty($_POST['passwordReg']) || empty($_POST['emailReg'])) {
        // One or more values are empty.
        die ('Please complete the registration form');
    }
    if (!filter_var($_POST['emailReg'], FILTER_VALIDATE_EMAIL)) {
        die ('Email is not valid!');
    }
    if (preg_match('/[A-Za-z0-9]+/', $_POST['usernameReg']) == 0) {
        die ('Username is not valid!');
    }
    if (strlen($_POST['passwordReg']) < 8) {
        die ('Password must be at least 8 characters long');
    }
    // We need to check if the account with that username exists.
    if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
        $stmt->bind_param('s', $_POST['usernameReg']);
        $stmt->execute();
        $stmt->store_result();
        // Store the result so we can check if the account exists in the database.
        if ($stmt->num_rows > 0) {
            // Username already exists
            echo 'Username exists, please choose another!';
        } else {
            // Username doesnt exists, insert new account
            if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email, activation_code) VALUES (?, ?, ?, ?)')) {
                // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
                $password = password_hash($_POST['passwordReg'], PASSWORD_DEFAULT);
                $uniqid = uniqid();
                $stmt->bind_param('ssss', $_POST['usernameReg'], $password, $_POST['emailReg'], $uniqid);
                $stmt->execute();
                $from    = 'shareyourmusic.mail@gmail.com';
                $subject = 'Account Activation Required';
                $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
                $activate_link = 'http://185.216.25.235/php/activate.php?email=' . $_POST['emailReg'] . '&code=' . $uniqid;
                $message = '<p>Please click the following link to activate your account: <a href="' . $activate_link . '">' . $activate_link . '</a></p>';
                if(mail($_POST['emailReg'], $subject, $message, $headers)) echo 'Please check your email to activate your account.';
                else echo 'An error has occur when trying to send you an email.';
            } else {
                // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
                echo 'Could not prepare statement!';
            }
        }
        $stmt->close();
    } else {
        // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
        echo 'Could not prepare statement!';
    }
    $con->close();
?>
