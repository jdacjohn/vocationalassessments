<html>
 <head>
  <meta name="generator" content="HTML Tidy, see www.w3.org">
  <title>Edit Client Verify</title>
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

 <body>
  <div style="background-color: navy; color: white; font-family: Arial, sans-serif; height: 100;">
   <img alt="" src="../images/sidebar_logo.gif" width="123" height="95" border="0" align="RIGHT"> 
   <hr>
  </div>
<h2>Edit Client Verify</h2>

<!-- Insert Content Here -->
	<?php
		// Get the post vars from the edit form
		$client_name = trim(utf8_decode($_POST['client_name']));
		$counselor = trim(utf8_decode($_POST['counselor']));
		$disability = addslashes(trim(utf8_decode($_POST['disability'])));
		$phone = trim(utf8_decode($_POST['phone']));
		$notes = addslashes(trim(utf8_decode($_POST['notes'])));  	
		$po_number = trim(utf8_decode($_POST['po_number']));
		$standby = 'N';
		$standby_approved = 'N';
		if ($_POST['standby']) {
			$standby = $_POST['standby'];
			$standby_approved = $_POST['standby_approved'];
		}
		$clid = $_POST['clid'];
		$cmid = $_POST['date_id'];
		// Contains DB Connect info.  Variables used below are declared in this file.
  	include("../p2952x783E4/connect.php");
  	//connect to db server
  	$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
  	if (!empty($dbconn)) {	
     	// select the database
     	$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Coud not connect to Database " . $strDatabase);
                     
     	if ($dbinst) {		
        $stmt = "update clients set client_name = '$client_name',	counselor = '$counselor',	disability = '$disability',	phone = '$phone',									notes = '$notes',	po_number = '$po_number', standby = '$standby', standby_approved = '$standby_approved' where cmid = $cmid and clid = $clid";
        $res = mysqli_query($dbconn,$stmt);
				if (!res) {
					print("An error occurred while attempting to update the client.  Please hit the back button and try the update again.  If the problem persists, contact the <a href='mailto:webmaster@vocationalassessments.com'>Website Administrator</a><br />\n");
				} else {
					$stmt = "select * from clients where cmid = $cmid and clid = $clid";
					$res = mysqli_query($dbconn,$stmt);
					if (!res) {
						print("A DB error occurred.  Please hit the back button and try the operation again.  If the problem persists, contact the <a href='mailto:webmaster@vocationalassessments.com'>Website Administrator</a>.<br />\n");
					} else {
						$dbrow = mysqli_fetch_array($res);
						print("<table summary='Client List' width='570' border='1'>\n");
						print("<tr align='left'><th>Client:</th><td>" . $dbrow['client_name'] . "</td></tr>\n");
						print("<tr align='left'><th>Counselor:</th><td>" . $dbrow['counselor'] . "</td></tr>\n");
						print("<tr align='left'><th>Disability:</th><td>" . stripslashes($dbrow['disability']) . "</td></tr>\n");
						print("<tr align='left'><th>Phone:</th><td>" . $dbrow['phone'] . "</td></tr>\n");
						print("<tr align='left'><th>Purchase Order:</th><td>" . $dbrow['po_number'] . "</td></tr>\n");
						print("<tr align='left'><td colspan='2' width='100%'><b>Notes:</b><br>" . stripslashes($dbrow['notes']) . "</td></tr>\n");
						print("</table>\n");
						mysqli_free_result($res);
					}
				}
						
    	} // End if ($dbinst..
  	} // End if (!empty($dbconn...
  	// close db connection
  	mysqli_close($dbconn);
	?>
<!-- Navigation, buttons -->
<hr>
<form action="./index.php" method="post">
	<input type="submit" value="Return Main Page">
</form>

<div align="left">
 	<?php include("../includes/nav_sub.inc"); ?>
	<?php include("../includes/address.inc"); ?>
</div>
 </body>
</html>

