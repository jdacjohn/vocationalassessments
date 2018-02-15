<?PHP
	session_start();
	if (!$_SESSION['user']) {
		$url = $_SERVER['REQUEST_URI'];
		//print("No User Indicated>br />\n");
		header("Location: ./login.php?uri=" . $url);
		exit;
	} else {
		//print("Debug: " . time() . "<br />\n");
		if ((time() - $_SESSION['last_req']) < (60 * 20)) {
			$_SESSION['last_req'] = time();
			$admin = $_SESSION['user_role'];
		} else {
			// Session has expired
			session_destroy();
			header("Location: ./login.php?uri=" . $_SERVER['REQUEST_URI'] . "&exp=1");
		}
	}
?>
