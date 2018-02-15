<html>
 <head>
  <title>Vocational Assessments Add Client</title>
	<?php require("../includes/admin.inc"); ?>
 </head>

 <body>
  <div style="background-color: navy; color: white; font-family: Arial, sans-serif; height: 100;">
   <img alt="" src="../images/sidebar_logo.gif" width="123" height="95" border="0" align="RIGHT"> 
   <hr>
  </div>

	<?php
  	// Contains DB Connect info.  Variables used below are declared in this file.
  	include("../p2952x783E4/connect.php");
		$loc_id = $_POST['loc_id'];
		$standby = $_POST['standby'];
		$standby_approved = $_POST['standby_approved'];
  	//connect to db server
  	$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
  	if (!empty($dbconn)) {	
     	// select the database
     	$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Coud not connect to Database " . $strDatabase);
                     
     	if ($dbinst) {
				// Trim user-input vars
				$client = trim(utf8_decode($_POST['client_name']));
				$counselor = trim(utf8_decode($_POST['counselor']));
				$disability = addslashes(trim(utf8_decode($_POST['disability'])));
				$phone = trim(utf8_decode($_POST['phone']));
				$po_number = trim(utf8_decode($_POST['po_number']));
				$notes = addslashes(trim(utf8_decode($_POST['notes'])));
				//print("Loc Id = " . $loc_id . "<br />");
				
        $stmt = "insert into clients values(null,'$loc_id', '$client', '$counselor', '$disability', '$phone', '$po_number', '$notes', '$standby', '$standby_approved')";
				// performs the insert
        $res = mysqli_query($dbconn,$stmt);
				if ($res == True) {
					// Insert was successful.  Get the last insert id and pull the data back out so we can throw it back up on the page.
					$clid = mysqli_insert_id($dbconn);
					$stmt2 = "select * from clients where clid = $clid";
					$res2 = mysqli_query($dbconn,$stmt2);
					$dbrow = mysqli_fetch_array($res2);
					print("The following client information was entered into the VIP Database:<br />\n");
					print("<table summary='Client List' width='570' border='1'>\n");
					// Client
					print("<tr align='left'>\n");
					print("<th>Client:</th>\n");
					print("<td>" . $dbrow['client_name'] . "</td></tr>\n");
					// Counselor
					print("<tr align='left'>\n");
					print("<th>Counselor:</th>\n");
					print("<td>" . $dbrow['counselor'] . "</td></tr>\n");
					// Disability
					print("<tr align='left'>\n");
					print("<th>Disability:</th>\n");
					print("<td>" . $dbrow['disability'] . "</td></tr>\n");
					// Phone
					print("<tr align='left'>\n");
					print("<th>Phone:</th>\n");
					print("<td>" . $dbrow['phone'] . "</td></tr>\n");
					// PO Num
					print("<tr align='left'>\n");
					print("<th>Purchase Order #:</th>\n");
					print("<td>" . $dbrow['po_number'] . "</td></tr>\n");
					if ($standby == 'Y') {
						// Stand-By
						print("<tr align='left'>\n");
						print("<th>Stand-By:</th>\n");
						print("<td>" . $dbrow['standby'] . "</td></tr>\n");
						// Stand-By Approved
						print("<tr align='left'>\n");
						print("<th>Stand-By Approved:</th>\n");
						print("<td>" . $dbrow['standby_approved'] . "</td></tr>\n");
					}	
					// Notes
					print("<tr align='left'>\n");
					print("<td colspan='2' width='100%'><b>Notes:</b><br />" . $dbrow['notes'] . "</td></tr>\n");
					print("</table>\n");
					mysqli_free_result($res2);
					print("[ <a href='./referral.php?clid=" . $clid . "'>Input Referral Form</a> ]\n");
					print("[ <a href='./index.php'>Return to Admin Home</a> ]\n");
				} else {
					print("Client could not be added to the database.  Please click the button below to return to the main admin page and try again.");
				}
				
    	}
  	}                                        
  	// close db connection
  	mysqli_close($dbconn);
	?>

<!-- Navigation, buttons -->
<div align="left">
 	<?php include("../includes/nav_sub.inc"); ?>
	<?php include("../includes/address.inc"); ?>
</div>
 </body>
</html>

