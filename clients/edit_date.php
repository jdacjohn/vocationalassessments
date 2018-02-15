<html>
<head>
<title>Vocational Assessments Edit A Date</title>
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
ADDRESS { font-family: sans-serif; 
	font-style: normal; 
	font-size: 10pt; }
-->
</style>
	<?php require("../includes/admin.inc"); ?>
</head>
<body text="#000000" bgcolor="#FFFFFF" link="#0000EF" vlink="#55188A" alink="#FF0000" >
  <div style="background-color: navy; color: white; font-family: Arial, sans-serif; height: 100;">
   <img alt="" src="../images/sidebar_logo.gif" width="123" height="95" border="0" align="RIGHT"> 
   <hr>
  </div>
<h2>Edit A Date</h2>
	<?php
  	// Contains DB Connect info.  Variables used below are declared in this file.
  	include("../p2952x783E4/connect.php");
  	//connect to db server
  	$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
  	if (!empty($dbconn)) {	
     	// select the database
     	$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Coud not connect to Database " . $strDatabase);
                     
     	if ($dbinst) {	
				$loc_id = $_POST['loc_id'];
				$update = $_POST['update'];	
				$dates = trim($_POST['dates']);
				$cmid = $_POST['loc_date_id'];
				print("Loc Id = " . $loc_id . "<br />\n");
				print("Update = " . $udpate . "<br />\n");
				print("dates = " . $dates . "<br />\n");
				print("Meeting Id = " . $cmid . "<br />\n");
        $stmt = "select * from locations where id = $loc_id";
        $res = mysqli_query($dbconn,$stmt);

				if (!$res) {
					print("An error occurred while attempting to fetch location information from the database.  Please hit the Back button to try the operation again. If the problem persists, please contact the <a href='mailto:webmaster@vocationalassessments.com'>Website Administrator</a>>br />\n");
					exit();
				} else {
					$dbrow = mysqli_fetch_array($res);
					print("<h3>" . $dbrow['location'] . "</h3>\n");
					print("<p>\n" . str_replace("\n", "<br>\n", $dbrow['address']) . "</p>\n");
					print("<hr>\n");
					mysqli_free_result($res);
					if ($update == 1) {
						$stmt2 = "update loc_dates set meet_date = '$dates' where cmid = $cmid";
						$res2 = mysqli_query($dbconn,$stmt2);
						if (!$res2) {
							print("An error occurred while attempting to update the meeting date.  Please hit the Back button to try the operation again. If the problem persists, please contact the <a href='mailto:webmaster@vocationalassessments.com'>Website Administrator</a><br />\n");
							exit();
						} else {
							print("The date for Meeting Id " . $cmid . " was successfully changed to " . $dates . ".<br />\n");
							mysqli_free_result($res2);
						}
					} else {
					print("Meeting Id used for form fetch = " . $cmid . "<br />\n");
						$stmt2 = "select * from loc_dates where cmid = $cmid";
						$res2 = mysqli_query($dbconn,$stmt2);
						if (!$res2) {
							print("An error occurred while attempting to update the meeting date.  Please hit the Back button to try the operation again. If the problem persists, please contact the <a href='mailto:webmaster@vocationalassessments.com'>Website Administrator</a><br />\n");
							exit();
						} else {
							$dbrow = mysqli_fetch_array($res2);
							print("<form action='" . $PHP_SELF . "' method='post'>\n");
							print("<input type='TEXT' name='dates' size='50' value='" . $dbrow['meet_date'] . "' />\n");
							print("<input type='HIDDEN' name='update' value='1' />\n");
							print("<input type='HIDDEN' name='loc_date_id' value='" . $cmid . "' />");
							print("<input type='HIDDEN' name='loc_id' value='" . $loc_id . "' />");
							print("<input type='SUBMIT' value='Update This Date' />\n");
							print("</form>\n");
							mysqli_free_result($res2);
						} // end if !$res2
					}// end if $update == 1
      	} // end if !$res
				
			} // End if ($dbinst..
  	} // End if (!empty($dbconn...
  	// close db connection
  	mysqli_close($dbconn);
	?>
<br>
<table summary="Purpose of Table">
<tr>
<td>
<form action="edit_dates.php" method="post">
<input type="SUBMIT" value="Return To Edit Dates">
</form>
</td>
<td>
<form action="./index.php" method="post">
    <input type="SUBMIT" value="Return to Admin Home">
</form>
</td>
</tr>
</table>    

<div align="center">
<hr width="50%" align="center" title="Copyright, Contact and Page Information Section">
<div align="left">
 	<?php include("../includes/nav_sub.inc"); ?>
	<?php include("../includes/address.inc"); ?>
</div>
</div>
</body> </html>
