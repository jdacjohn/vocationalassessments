<html>
 <head>
  <title>Vocational Assessments Client List</title>
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
<div>[ <a href="./index.php">Return to Admin Home</a> ]</div>

<!-- Insert Content Here -->
<?php
	// Contains DB Connect info.  Variables used below are declared in this file.
  include("../p2952x783E4/connect.php");
	if (isset($_GET['loc_dates_id'])) {
		$loc_dates_id = $_GET['loc_dates_id'];
	}
	if (!isset($loc_dates_id)) {
		// Arg came via post and not get
		$loc_dates_id = $_POST['loc_dates_id'];
		//print("Loc Date Id = " . $loc_dates_id . " via POST<br />");
	} else {
		//print("Loc Date Id = " . $loc_dates_id . " via GET<br />");
	}
  	//connect to db server
  	$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
  	if (!empty($dbconn)) {	
     	// select the database
     	$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Coud not connect to Database " . $strDatabase);
                     
     	if ($dbinst) {		
        $stmt = "select * from clients where cmid = $loc_dates_id and standby = 'N' order by clid";
        $res = mysqli_query($dbconn,$stmt);
				$num = mysqli_num_rows($res);
				if (!$num) { 
					$num = 0;
				}
				print("<h2>There are " . $num . " client(s) for this date.</h2><br />\n");
        while ($dbrow = mysqli_fetch_array($res)) {
			print("<table summary='Client List' width='570' border='1'>\n");
			// Client
			print("<tr align='left'>\n");
			print("<th width='20%'>Client:</th>\n");
			print("<td width='80%'>" . $dbrow['client_name'] . "</td>\n");    
			print("</tr>\n");
			// Counselor
			print("<tr align='left'>\n");
			print("<th>Counselor:</th>\n");
			print("<td>" . $dbrow['counselor'] . "</td>\n");
			print("</tr>\n");
			// Disability
			print("<tr align='left'>\n");
			print("<th>Disability:</th>\n");
			print("<td>" . $dbrow['disability'] . "</td>\n");
			print("</tr>\n");
			// Phone
			print("<tr align='left'>\n");
			print("<th>Phone:</th>\n");
			print("<td>" . $dbrow['phone'] . "</td>\n");
			print("</tr>\n");
			// PO Number
			print("<tr align='left'>\n");
			print("<th>Purchase Order #:</th>\n");
			print("<td>" . $dbrow['po_number'] . "</td>\n");
			print("</tr>\n");
			// Notes
			print("<tr align='left'>\n");
			print("<td colspan='2'><b>Notes:</b><br />" . $dbrow['notes'] . "</td>\n");
			print("</tr>\n");
					
			// End of Client list 
			// Restricted Functions 
			print("<tr>\n");
			print("<td colspan='2'>\n");
			print("<table>\n");
			print("<tr><td>\n");
			// Edit Client - Admin and Rich Only
			if (($admin == '1') || ($admin == '4')) {
				print("<form action='edit_client.php' method='post'>");
				print("<input type='hidden' name='date_id' value='$loc_dates_id'>\n");
				print("<input type='hidden' name='clid' value='" . $dbrow['clid'] . "'>\n");
				print("<input type='submit' value='Edit Client'>\n");
				print("</form>\n");
			} else {
				print("&nbsp;");
			}
			print("</td>\n");
			print("<td>\n");
			// Delete Client - Admin only
			if ($admin == '1') {
				print("<form action='delete_client.php' method='post'>");
				print("<input type='hidden' name='date_id' value='$loc_dates_id'>\n");
				print("<input type='hidden' name='clid' value='" . $dbrow['clid'] . "'>\n");
				print("<input type='submit' value='Delete Client'>\n");
				print("</form>\n");
			} else {
				print("&nbsp;");
			}
			print("</td>\n");
			print("<td>\n");
			// Input Referral Form - Admin, Liaison, Counsel
			if (($admin == '1') || ($admin == '2') || ($admin == '3') || ($admin == '4')) {
				print("<form action='referral.php' method='post'>");
				print("<input type='hidden' name='clid' value='" . $dbrow['clid'] . "'>\n");
				print("<input type='hidden' name='locDateId' value='" . $loc_dates_id . "'>\n");
				print("<input type='submit' value='Input Referral Form'>\n");
				print("</form>\n");
			} else {
				print("&nbsp;");
			}
			print("</td>\n");
			// Don't show the next button unless a referral is in the system for the client AND admin = 1
			print("<td>\n");
			$stmt2 = "select count(*) from referrals where client_id = " . $dbrow['clid'];
			$res2 = mysqli_query($dbconn,$stmt2);
			if ($res2 && ($admin == '1' || $admin == '4')) {
				$dbrow2 = mysqli_fetch_array($res2);
				if ($dbrow2['count(*)'] > 0) {													
					print("<form action='show_referral.php' method='post'>");
					print("<input type='hidden' name='clid' value='" . $dbrow['clid'] . "'>\n");
					print("<input type='hidden' name='locDateId' value='" . $loc_dates_id . "'>\n");
					print("<input type='submit' value='VIP Review Referral Form'>\n");
					print("</form>\n");
				} else {
					print("&nbsp;");
				}
				mysqli_free_result($res2);
			} // End if($res2)
						
			print("</td>\n");
			print("</tr>\n");
			print("</table>\n");
			print("</td>\n");
			print("</tr>\n");
			print("</table>\n");
					
      	} // End while $dbrow...
			mysqli_free_result($res);
	
		// The following code allows the user to add clients.
		// If there are more than 8 clients the meet date is full. Use Stand-by
		if ($num >= 8 ) { 
  			print("<h2>Date Full: <br>Add Standby</h2>\n");
		} else {
			print("<h3>Client Add</h3>\n");
			print("<form action='add_client.php' method='post'>\n");
			print("<input type='hidden' name='loc_id' value='" . $loc_dates_id . "' />\n");
			print("<input type='hidden' name='standby' value='N' />\n");
			print("<input type='hidden' name='standby_approved' value='N' />\n");
			print("Client:<br>\n");
			print("<input type='text' name='client_name' size='50'><br>\n");
			print("Counselor:<br>\n");
			print("<input type='text' name='counselor' size='50'><br>\n");
			print("Disability:<br>\n");
			print("<input type='TEXT' name='disability' size='50'><br>\n");
			print("Phone:<br>\n");
			print("<input type='TEXT' name='phone' size='50'><br>\n");
			print("Purchase Order #:<br>\n");
			print("<input type='TEXT' name='po_number' size='50'><br>\n");
			print("Memo:<br>\n");
			print("<textarea name='notes' rows='5' cols='50'></textarea><br>\n");
			print("<input type='submit' value='Add Client'><input type='reset' value='Clear'>\n");
			print("</form>\n");
		}
				
		// Standby Section	
		print("<h2>Standby</h2>\n");
        $stmt2 = "select * from clients where cmid = $loc_dates_id and standby = 'Y' order by clid";
        $res2 = mysqli_query($dbconn,$stmt2);
		$num_on_standby = mysqli_num_rows($res2);
		if (!$num_on_standby) { 
			$num_on_standby = 0;
		}
		print("<h3>There are " . $num_on_standby . " clients on standby</h3>\n");
		// Print out the standby client info
		while ($dbrow2 = mysqli_fetch_array($res2)) {
			print("<table summary='Stand-By List' width='570' border='1'>\n");
			// Approved for Stand-by
			print("<tr align='left'>\n");
			print("<th width='20%'>Approved:</th>\n");
			print("<td width='80%'>");
			if ($dbrow2['standby_approved'] == 'Y') {
				print("Yes</td>\n");
			} else {
				print("No</td>\n");
			}					
			print("</tr>\n");
			// Client
			print("<tr align='left'>\n");
			print("<th width='20%'>Client:</th>\n");
			print("<td width='80%'>" . $dbrow2['client_name'] . "</td>\n");    
			print("</tr>\n");
			// Counselor
			print("<tr align='left'>\n");
			print("<th>Counselor:</th>\n");
			print("<td>" . $dbrow2['counselor'] . "</td>\n");
			print("</tr>\n");
			// Disability
			print("<tr align='left'>\n");
			print("<th>Disability:</th>\n");
			print("<td>" . $dbrow2['disability'] . "</td>\n");
			print("</tr>\n");
			// Phone
			print("<tr align='left'>\n");
			print("<th>Phone:</th>\n");
			print("<td>" . $dbrow2['phone'] . "</td>\n");
			print("</tr>\n");
			// PO Number
			print("<tr align='left'>\n");
			print("<th>Purchase Order #:</th>\n");
			print("<td>" . $dbrow2['po_number'] . "</td>\n");
			print("</tr>\n");
			// Notes
			print("<tr align='left'>\n");
			print("<td colspan='2'><b>Notes:</b><br />" . $dbrow2['notes'] . "</td>\n");
			print("</tr>\n");
			// Approved/Not Approved
			print("<tr align='left'>\n");
			print("<td colspan='2'>");
			if ($dbrow2['standby_approved'] == 'Y') {
				print("Approved</td>\n");
			} else {
				print("Not Approved</td>\n");
			}					
			print("</tr>\n");
			// Include Admin functions if appropriate					
			if ($admin == '1') {
				print("<tr>\n");
				print("<td colspan='2'>\n");
				print("<table summary='Stand-By Admin'>\n");
				print("<tr>\n");
				print("<td>\n");
				print("<form action='edit_client.php' method='post'>\n");
        		print("<input type='HIDDEN' name='date_id' value='" . $loc_dates_id . "' />\n");
				print("<input type='HIDDEN' name='clid' value='" . $dbrow2['clid'] . "' />\n");    
    			print("<input type='submit' value='Edit/Approve Standby'>\n");
				print("</form>\n");
				print("</td>\n");
				print("<td>\n");
				print("<form action='delete_client.php' method='post'>\n");
        		print("<input type='HIDDEN' name='date_id' value='" . $loc_dates_id . "' />\n");
				print("<input type='HIDDEN' name='clid' value='" . $dbrow2['clid'] . "' />\n");    
    			print("<input type='SUBMIT' value='Delete Standby'>\n");
				print("</form>\n");
				print("</td></tr>\n");
			} // End if Admin == 1
					
			print("</table>\n");
					
		} // End while ($dbrow2...
		mysqli_free_result($res2);
		////////////////////////////////////
		// this section if to add standby ///
		// if there are less than 4 standby ///
		// the loc_id comes from the id of loc_dates //
		// hence, loc_dates.id becomes loc_dates_id //
		// the form below adds a standby
		// the date id is the foreign key to the loc_dates table
		// each entry has it's own id, plus the id that ties it
		// to the loc_dates table
		if ($num_on_standby >= 4 ) {
			print("<h3>Standby Full</h3>\n");
		} else { 
			print("<h3>Add Standby</h3>\n");
			print("<p style='width: 500px; border: maroon medium outset; padding: .5em; '><strong>Note:</strong> Only Add a standby if the client list is full.<br>\n");
			print("If a standby is added you must call (325) 893-3361 to get this standby approved. An approved standby will show up as approved on this page.</p>\n");
			print("<form action='add_client.php' method='post'>\n");
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
			print("<input type='submit' value='Add Standby'><input type='reset' value='Clear'>\n");
			print("</form>\n");
		} // End if num_on_standby...else...
				
    	} // End if ($dbinst)...

  	} // End if (!empty(dbconn)...
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

