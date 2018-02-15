<html>
 <head>
  <title>Vocational Assessments Add Clients</title>

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
	<?PHP require("../includes/admin.inc"); ?>
 </head>

 <body>
  <div style="background-color: navy; color: white; font-family: Arial, sans-serif; height: 100;">
   <img alt="" src="../images/sidebar_logo.gif" width="123" height="95" border="0" align="RIGHT"> 
   <hr>
  </div>
	<!-- Upgraded to PHP5 -->
	<?php
  	// Contains DB Connect info.  Variables used below are declared in this file.
  	include("../p2952x783E4/connect.php");
		$loc_dates_id = $_GET['loc_dates_id'];
  	//connect to db server
  	$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
  	if (!empty($dbconn)) {	
     	// select the database
     	$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Coud not connect to Database " . $strDatabase);
                     
     	if ($dbinst) {
				// Display the number of clients and allow addition of new clients if there's room.  Stand-bys will be handled below.		
        $stmt = "select * from clients where cmid = $loc_dates_id and standby = 'N'";
        $res = mysqli_query($dbconn,$stmt);
				$num_clients = mysqli_num_rows($res);
				if (!$num_clients) {
					$num_clients = 0;
				}
				print("<h2>There are " . $num_clients . " client(s) for this date.</h2>\n");
				//////////////////////////////////////
				// this section if to add clients ///
				// if there are less than 8 clients ///
				// the loc_id comes from the id of loc_dates //
				// hence, loc_dates.id becomes loc_dates_id //

				// the form below adds a clients
				// the date id is the foreign key to the loc_dates table
				// each entry has it's own id, plus the id that ties it
				// to the loc_dates table
				if ($num_clients >= 8) {
					print("<h2>Date Full: <br />Add Standby</h2>\n");
				} else {
					// Display the form to add another client
					print("<h3>Client Add</h3>\n");
					//print("Loc Dates Id = " . $_GET['loc_dates_id'] . "<br />");
					print("<form action='add_client2.php' method='post'>\n");
					print("<input type='HIDDEN' name='loc_id' value='" . $loc_dates_id . "' />\n");
					print("<input type='hidden' name='standby' value='N' />\n");
					print("<input type='hidden' name='standby_approved' value='N' />\n");
					print("Client:<br>\n");
					print("<input type='TEXT' name='client_name' size='50'><br>\n");
					print("Counselor:<br>\n");
					print("<input type='TEXT' name='counselor' size='50'><br>\n");
					print("Disability:<br>\n");
					print("<input type='TEXT' name='disability' size='50'><br>\n");
					print("Phone:<br>\n");
					print("<input type='TEXT' name='phone' size='50'><br>\n");
					print("Purchase Order #:<br>\n");
					print("<input type='text' name='po_number' size='50'><br>\n");
					print("Memo:<br>\n");
					print("<textarea name='notes' rows='5' cols='50'></textarea><br>\n");
					print("<input type='SUBMIT' value='Add Client'><input type='RESET' value='Clear'>\n");
					print("</form>\n");
					
				} // End if ($num_clients >= 8...
				mysqli_free_result($res);
				// Handle for Standbys if any now
				print("<h2>Standby</h2>\n");
        $stmt2 = "select * from clients where cmid = $loc_dates_id and standby = 'Y'";
        $res2 = mysqli_query($dbconn,$stmt2);
				$num_standby = mysqli_num_rows($res2);
				if (!$num_standby) {
					$num_standby = 0;
				}
				print("<h2>There are " . $num_standby . " client(s) on standby for this date.</h2>\n");
				//////////////////////////////////////
				// this section if to add standby ///
				// if there are less than 4 standby ///
				// the loc_id comes from the id of loc_dates //
				// hence, loc_dates.id becomes loc_dates_id //

				// the form below adds a standby
				// the date id is the foreign key to the loc_dates table
				// each entry has it's own id, plus the id that ties it
				// to the loc_dates table
				if ($num_standby >= 4 ) {
					print("<h3>Standby Full</h3>\n");
				} else { 
					print("<h3>Add Standby</h3>\n");
					print("<p style='width: 500px; border: maroon medium outset; padding: .5em;' ><strong>Note:</strong> Only Add a standby if Client List is full. <br>If a standby is added you must call (325) 893-3361 to get this standby approved. </p>\n");
					print("<form action='add_client2.php' method='post'>\n");
					print("<input type='HIDDEN' name='loc_id' value='" . $loc_dates_id . "' />\n");
					print("<input type='hidden' name='standby' value='Y' />\n");
					print("<input type='hidden' name='standby_approved' value='N' />\n");
					print("Client:<br>\n");
					print("<input type='TEXT' name='client_name' size='50'><br>\n");
					print("Counselor:<br>\n");
					print("<input type='TEXT' name='counselor' size='50'><br>\n");
					print("Disability:<br>\n");
					print("<input type='TEXT' name='disability' size='50'><br>\n");
					print("Phone:<br>\n");
					print("<input type='TEXT' name='phone' size='50'><br>\n");
					print("Purchase Order #:<br>\n");
					print("<input type='TEXT' name='po_number' size='50'><br>\n");
					print("Memo:<br>\n");
					print("<textarea name='notes' rows='5' cols='50'></textarea><br>\n");
					print("<input type='SUBMIT' value='Add Standby'><input type='RESET' value='Clear'>\n");
					print("</form>\n");
				
				} // End if ($num_standby >= 4
				mysqli_free_result($res2);

    	} // End if ($dbinst...

  	} // End if (!empty($dbconn...

  	// close db connection
  	mysqli_close($dbconn);
	?>

<hr>
<form action="./index.php" method="post">
<input type="SUBMIT" value="Return Main Page">
</form>

<!-- Navigation, buttons -->
<div align="left">
 	<?php include("../includes/nav_sub.inc"); ?>
	<?php include("../includes/address.inc"); ?>
</div>
 </body>
</html>

