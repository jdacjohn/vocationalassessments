<html>
<head>
<meta name="generator" content="GNU Emacs 20.4.1 html-helper-mode.el (X11; I; Linux 2.2.12-20 i586)">
<title>Delete A Date</title>
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
<h2>Delete A Date</h2>
	<?php
		$delete = $_POST['delete'];
		$loc_id = $_POST['loc_id'];
		$cmid = $_POST['loc_date_id'];
  	// Contains DB Connect info.  Variables used below are declared in this file.
  	include("../p2952x783E4/connect.php");
  	//connect to db server
  	$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
  	if (!empty($dbconn)) {	
     	// select the database
     	$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Coud not connect to Database " . $strDatabase);
                     
     	if ($dbinst) {		
				
				if (!$delete) {
					$stmt = "select * from locations where id = $loc_id";
        	$res = mysqli_query($dbconn,$stmt);
					if (!$res) {
						print("An error has occurred while attempting to fetch location information from the database. Please click the Back button to try this operation again. If the problem persists, please contact the <a href='mailto:webmaster@vocationalassessments.com'>Website Administrator</a>.\n");
						exit();
					}
					$dbrow = mysqli_fetch_array($res);
					print("<p style='border: red thick solid; width: 400px;'><strong>Warning:</strong> Deleting a date removes all client and standby information, and after deletion cannot be retrieved. </p>\n");
					print("<h3>" . $dbrow['location'] . "</h3>\n");
					print("<p>\n");
					print(str_replace("\n", "<br>\n", $dbrow['address']));
					print("</p>\n");

					mysqli_free_result($res);
				} // End if Not Delete
				
				if ($delete == 1) {
					$stmt = "delete from clients where cmid = $cmid";
					$res = mysqli_query($dbconn,$stmt);
					if (!$res) {
						print("An error has occurred while attempting to delete the selected Meeting Date from the database. Please click the Back button to try this operation again. If the problem persists, please contact the <a href='mailto:webmaster@vocationalassessments.com'>Website Administrator</a>.\n");
						exit();
					} else {
						print("<h4>Deleted Meeting Dates and All Client and Stand-By data tied to Meeting Id: " . $cmid . "</h4><br />\n");
					}
					$stmt2 = "delete from loc_dates where cmid = $cmid";
					$res2 = mysqli_query($dbconn,$stmt2);
					if (!$res2) {
						print("An error has occurred while attempting to delete the selected Meeting Date from the database. Please click the Back button to try this operation again. If the problem persists, please contact the <a href='mailto:webmaster@vocationalassessments.com'>Website Administrator</a>.\n");
						exit();
					} else {
						print("<h4>Deleted Meeting Date Id: " . $cmid . "<h4><br />\n");
					}
    		} else {
					$stmt = "select * from loc_dates where cmid = $cmid";
					$res = mysqli_query($dbconn,$stmt);
					if (!$res) {
						print("An error has occurred while attempting to fetch the selected Meeting Date from the database. Please click the Back button to try this operation again. If the problem persists, please contact the <a href='mailto:webmaster@vocationalassessments.com'>Website Administrator</a>.\n");
						exit();
					} else {
						$dbrow = mysqli_fetch_array($res);
						print("<p><b>" . $dbrow['meet_date'] . "</b></p>\n");
						print("<form action='" . $PHP_SELF . "' method='post'>\n");
						print("<input type='HIDDEN' name='delete' value='1' />\n");
						print("<input type='HIDDEN' name='loc_date_id' value='" . $dbrow['cmid'] . "' />\n");
						print("<input type='HIDDEN' name='date_id' value='" . $dbrow['loc_id'] . "' />\n");
						print("<input type='SUBMIT' value='Delete This Date' />");
						print("</form>\n");
						mysqli_free_result($res);
					}
				}// End if Delete == 1
				
				
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


<div align="left">
<hr width="50%" align="left" title="Copyright, Contact and Page Information Section">
<div align="left">
 	<?php include("../includes/nav_sub.inc"); ?>
	<?php include("../includes/address.inc"); ?>
</div>
</div>
</body> </html>
