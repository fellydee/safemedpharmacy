<?php

$body_class = "";

if ( session_status() != PHP_SESSION_NONE && $_SESSION['username'] ) {
	if ( strcmp($login_type, 'Super Admin') === 0 ) {
		$is_admin = true;
		$body_class = 'super-admin';
	} elseif( strcmp($login_type, 'Owner') === 0 ) {
		$is_admin = true;
		// $body_class = 'super-admin owner';
		$body_class = 'owner';
	} else {
		$body_class = 'not-super-admin';
	}
}

?>

<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<link href="css/universal-styles.css" rel="stylesheet">