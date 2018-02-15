<html lang="en">
<head>
	<title>Vocational Assessments Delete Client</title>
	<!-- metatags if needed -->
	<?php 
		include('../includes/metak.inc');
  	include('../includes/metad.inc');
	?>
	<style type="text/css">
	<!--
	BODY { font-family: sans-serif; }
	H1, H2, H3, H4, H5, H6 { font-family: sans-serif; }
	TD { font-family: sans-serif; }
	TH { font-family: sans-serif; }
	OL { font-family: sans-serif; }
	P { font-family: sans-serif; }
	LI { font-family: sans-serif; }
	ADDRESS { font-family: sans-serif; font-style: normal; font-size: 10pt; }
	-->
	</style>
	<?php require("../includes/admin.inc"); ?>
</head>

<body text="#000000" bgcolor="#FFFFFF" link="#0000EF" vlink="#55188A" alink="#FF0000" >
<div style="background-color: navy; color: white; font-family: Arial, sans-serif; height: 100;">
 <img alt="" src="../images/sidebar_logo.gif" width="123" height="95" border="0" align="RIGHT"> 
 <hr>
</div>
<div align="left">
	<?php
  	// Contains DB Connect info.  Variables used below are declared in this file.
  	include("../p2952x783E4/connect.php");
		$cmid = $_POST['date_id'];
		$clid = $_POST['clid'];		
  	//connect to db server
  	$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
  	if (!empty($dbconn)) {	
     	// select the database
     	$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Could not connect to Database " . $strDatabase);
                     
     	if ($dbinst) {
        $stmt = "delete from clients where clid = $clid and cmid = $cmid";
        $res = mysqli_query($dbconn,$stmt);
				if (!$res) {
					print("An error occurred while deleting the client\n");
				} else {
					print("<h2>Client Deleted</h2><br />\n");
				}
				// Delete any referrals
				$stmt = "delete from referrals where client_id = $clid";
				mysqli_query($dbconn,$stmt);
    	} // End if ($dbinst...
  	} // End if (!empty($dbconn....
  	// close db connection
  	mysqli_close($dbconn);
		print("<form action='list_clients.php' method='post'>\n");
		print("<input type='HIDDEN' name='loc_dates_id' value='" . $cmid . "' />\n");
		print("<input type='SUBMIT' value='List Clients'>\n");
		print("</form>\n");
	?>

	<form action="./index.php" method="post">
		<input type="SUBMIT" value="Return Main Page">
	</form>

</div>
<div align="left">
 	<?php include("../includes/nav_sub.inc"); ?>
	<?php include("../includes/address.inc"); ?>
</div>
</body>
</html>
