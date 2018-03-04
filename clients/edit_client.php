<html>
 <head>
  <title>Vocational Assessments Edit Client</title>
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

	<h2>Edit Client</h2>
	<!-- Insert Content Here -->
	<?php
  	// Contains DB Connect info.  Variables used below are declared in this file.
  	include("../p2952x783E4/connect.php");
		// Get the Post Vars
		$cmid = $_POST['date_id'];
		$clid = $_POST['clid'];
  	//connect to db server
  	$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
  	if (!empty($dbconn)) {
     	// select the database
     	$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Coud not connect to Database " . $strDatabase);

     	if ($dbinst) {
        $stmt = "select * from clients where clid = $clid and cmid = $cmid";
        $res = mysqli_query($dbconn,$stmt);
				if (!res) {
					print("An error has occurred.  Please click the Back button and try the operation again.  If the problem persists, please contact the " .
						"<a href='mailto:webmaster@vocationalassessments.com'>Website Administrator</a><br />\n");
				} else {
					$dbrow = mysqli_fetch_array($res);
					print("<form action='edit_client_v.php' method='post'>\n");
					print("<input type='hidden' name='date_id' value='" . $cmid . "' />\n");
					print("<input type='hidden' name='clid' value='" . $clid . "' />\n");
					print("Client:<br>\n");
					print("<input type='text' name='client_name' size='50' value='" . $dbrow['client_name'] . "' /><br>\n");
					print("Counselor:<br>\n");
					print("<input type='text' name='counselor' size='50' value='" . $dbrow['counselor'] . "' /><br>\n");
					print("Disability:<br>\n");
					print("<input type='text' name='disability' size='50' value='" . $dbrow['disability'] . "' /><br>\n");
					print("Phone:<br>\n");
					print("<input type='text' name='phone' size='50' value='" . $dbrow['phone'] . "' /><br>\n");
					print("Purchase Order #:<br>\n");
					print("<input type='text' name='po_number' size='50' value='" . $dbrow['po_number'] . "' /><br>\n");
					if ($dbrow['standby'] == 'Y') {
						// Stand-By
						print("Stand-By:<br />\n");
						print("Yes <input type='radio' name='standby' value='Y' checked />&nbsp;&nbsp;No <input type='radio' name='standby' value='N' /><br />\n");
						// Stand-By Approved
						print("Stand-By Approved:<br />\n");
						print("Yes <input type='radio' name='standby_approved' value='Y'");
						if ($dbrow['standby_approved'] == 'Y') {
							print(" checked ");
						}
						print("/>&nbsp;&nbsp;No <input type='radio' name='standby_approved' value='N'");
						if ($dbrow['standby_approved'] == 'N') {
							print(" checked ");
						}
						print("/><br />\n");
					}
					print("Memo:<br>\n");
					print("<textarea name='notes' rows='5' cols='50'>" . stripslashes($dbrow['notes']) . "</textarea><br>\n");
					print("<input type='submit' value='Submit Edit'><input type='reset' value='Reset'>\n");
					print("</form>\n");
				}
				mysqli_free_result($res);
    	}
  	}
  	// close db connection
  	mysqli_close($dbconn);
	?>

<!-- Navigation, buttons -->
<hr>
<form action="./index.php" method="post">
	<input type="SUBMIT" value="Return Main Page">
</form>

<div align="left">
 	<?php include("../includes/nav_sub.inc"); ?>
	<?php include("../includes/address.inc"); ?>
</div>
 </body>
</html>
