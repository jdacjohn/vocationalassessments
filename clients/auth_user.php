<?php
	// Get out POST vars
	$success = 0;
	$user = trim($_POST['uname']);
	$password = trim($_POST['pword']);
	$target_url = $_POST['target_url'];
	//print("User = " . $user . "<br />\n");
	//print("PW = " . $password . "<br />\n");
	//  Don't do anything but go back to the login page if either userid or password is missing
	if (!$user || !$password) {
		header("Location: ./login.php?uri=" . $target_url . "&mi=2");
	} else {
		//print("Got past the wtf<br />\n");
		include("../p2952x783E4/connect.php");
 		//connect to db server
 		$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
 		if (!empty($dbconn)) {	
   		// Get a DB Instance
   		$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Coud not connect to Database " . $strDatabase);
   		if ($dbinst) {		
      	$stmt = "select * from auth_users where username = '" .
								mysqli_real_escape_string($dbconn,$user) .
								"' and userpass = password('" .
								mysqli_real_escape_string($dbconn,$password) .
								"')";
      	$res = mysqli_query($dbconn,$stmt);
				//if (!$res) {
				//	print("something isn't working with the database<br />\n");
				//} else {
				//	print("We should be having some results!<br />\n");
				//}
				$success = mysqli_num_rows($res);
				//print("Success = " . $success . "<br />\n");
				if ($success > 0) {
					//print("Success > 0?<br />\n");
					session_start();
					$dbrow = mysqli_fetch_array($res);
					$_SESSION['user'] = $user;
					$_SESSION['user_role'] = $dbrow['user_role'];
					$_SESSION['last_req'] = time();
					$stmt2 = "update auth_users set last_login = NOW() where username = '$user' and userpass = password('$password')";
					mysqli_query($dbconn,$stmt2);
					$res2 = mysqli_affected_rows($dbconn);
					if ($res2 < 1) {
						print("An error occurred updating the DB.  If the problem persists, contact the Website Administrator.");
					}
				}
				mysqli_free_result($res);
   		} // End if ($dbinst..
 		} // End if (!empty($dbconn...
 		// close db connection
 		mysqli_close($dbconn);
		//print($success);
		if ($success > 0) {
			header("Location: " . $target_url);
		} else {
			header("Location: ./login.php?uri=" . $target_url . "&mi=1");
		}
	} // End If (!user || !password) else
?>
