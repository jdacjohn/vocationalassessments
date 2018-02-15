<html lang="en">
<head>
<meta name="generator" content="GNU Emacs 20.4.1 html-helper-mode.el (X11; I; Linux 2.2.12-20 i586)">
<title>Edit Date</title>
	<!-- metatags if needed -->
	<?php 
		include('../includes/metak.inc');
  	include('../includes/metad.inc');
	?>

<style type="text/css">
<!--
BODY { font-family: sans-serif; }
H1, H2, H3, H4, H5, H6 { font-family: sans-serif; }
h2, h3, form { margin: 0; }
h3 { background-color: silver; }
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
<table summary="Purpose of Table">
<tr>
<td>

&#160;
</td>
<td>
<form action="./index.php" method="post">
    <input type="SUBMIT" value="Return to Admin Home">
</form>

</td>
</tr>

</table>    

<h2>Edit Dates</h2>
	<?php
  	// Contains DB Connect info.  Variables used below are declared in this file.
  	include("../p2952x783E4/connect.php");
  	//connect to db server
  	$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
  	if (!empty($dbconn)) {	
     	// select the database
     	$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Coud not connect to Database " . $strDatabase);
                     
     	if ($dbinst) {	
				// Check if a new date is being added
				if ($_POST['new_date']) {
					$newDate = trim($_POST['new_date']);
					$loc_id = $_POST['loc_id'];
        	$stmt = "insert into loc_dates values(null, '$loc_id', '$newDate')";
        	mysqli_query($dbconn,$stmt);
					$res = mysqli_affected_rows($dbconn);
					// do NOT need mysqli_free_result on inserts, updates, etc.  Only on queries that fetch data.
					if ($res < 1) {
						print("An error occurred adding the new meeting date to the database. Please click the back button and try the operation again. If the problem persists, please contact the <a href='mailto:webmaster@vocationalassessments.com'>Website Administrator</a>.<br />\n");
					} 
				} // End if Post New Date...
				$stmt2 = "select * from locations order by location";
				$res2 = mysqli_query($dbconn,$stmt2);
				while ($dbrow = mysqli_fetch_array($res2)) {
					print("<h3>" . $dbrow['location'] . " - Loc Id: " . $dbrow['id'] . "</h3>\n");
					print("<br>\n");
					print("<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>\n");
					print("<input type='hidden' name='loc_id' value='" . $dbrow['id'] . "' />\n");
					print("<input type='TEXT' name='new_date' size='50' />\n");
					print("<input type='SUBMIT' value='Add New Date' />\n");
					print("</form>\n");
					$loc_id = $dbrow['id'];
					$stmt3 = "select * from loc_dates where loc_id = $loc_id";
					$res3 = mysqli_query($dbconn,$stmt3);
					while ($dbrow2 = mysqli_fetch_array($res3)) {
						print("<p>". $dbrow2['meet_date'] . "</p>\n");
						print("<form action='edit_date.php' method='post'>\n");
						print("<input type='hidden' name='loc_date_id' value='" . $dbrow2['cmid'] . "' />\n");
						print("<input type='hidden' name='loc_id' value='" . $dbrow['id'] . "' />\n");
						print("<input type='submit' value='Edit This Date'>\n");
						print("</form>\n");
						print("<form action='delete_date.php' method='post'>\n");
						print("<input type='hidden' name='loc_date_id' value='" . $dbrow2['cmid'] . "' />\n");
						print("<input type='hidden' name='loc_id' value='" . $dbrow['id'] . "' />\n");
						print("<input type='submit' value='Delete This Date'>\n");
						print("</form>\n");
						
					} // End inner While
					mysqli_free_result($res3);
					print("<hr>\n");
				} // End While	
				mysqli_free_result($res2);
    	} // End if ($dbinst..
  	
		} // End if (!empty($dbconn...
  	// close db connection
  	mysqli_close($dbconn);
	?>

<table summary="Purpose of Table">
<tr>
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



