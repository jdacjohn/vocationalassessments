<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
 <head>
  <meta name="generator" content="HTML Tidy, see www.w3.org">
  <title>Vocational Assessments Admin Page</title>
	<?php
		require("../includes/admin.inc"); 
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
	form { margin: 0; }
	ADDRESS { font-family: sans-serif; 
		font-style: normal; 
		font-size: 10pt; }
	dl, dt, dl { margin: 0; }
	-->
	</style>

 </head>

 <body>
  <div style="background-color: navy; color: white; font-family: Arial, sans-serif; height: 100;">
   <img alt="" src="../images/sidebar_logo.gif" width="123" height="95" border="0" align="RIGHT"> 
   <hr>
  </div>

<!-- Insert Content Here -->
<?PHP
	//print("<br />Admin Code:" . $admin . "<br />");
	include "../p2952x783E4/connect.php";
  	//connect to db server
  	$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
  	if (!empty($dbconn)) {	
     	// select the database
     	$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Coud not connect to Database " . $strDatabase);
                     
     	if ($dbinst) {		
        $stmt = "select * from locations order by location";
        $res = mysqli_query($dbconn,$stmt);
				print("<dl>\n");
				// Main loop - Get all locations
        while ($dbrow_locs = mysqli_fetch_array($res)) {
  				print("<dt><b>" . $dbrow_locs['location'] . "</b>\n</dt>\n");
  				// inner loop to get clients and determin if full
  				$loc_id = $dbrow_locs['id'];
					//print("Current Location id is: " . $loc_id);
					$stmt2 = "select * from loc_dates where loc_id = $loc_id";
					$res2 = mysqli_query($dbconn,$stmt2);
					// 1st Inner loop -get the dates for each locaion
					while ($dbrow_loc_dates = mysqli_fetch_array($res2)) {
           	print("<dd>\n");
						print($dbrow_loc_dates['meet_date']);
	   				if(($admin == "1") || ($admin == "2") || ($admin == '4')) {
							print(" - [ <a href='list_clients.php?loc_dates_id=" . $dbrow_loc_dates['cmid'] . "'>List</a> ] \n");
       			}
	   				if (($admin == "1") || ($admin == "2") || ($admin == "3") || ($admin == "4")) {
							print(" - [ <a href='./add_clients.php?loc_dates_id=" . $dbrow_loc_dates['cmid'] . "'>Add to List</a> ]\n");
	     			}
						$client_date_id = $dbrow_loc_dates['cmid'];
						// Get the numbers of clients and stand-by clients
						$stmt3 = "select * from clients where cmid = $client_date_id and standby = 'N'";
						$res3 = mysqli_query($dbconn,$stmt3);
						$clients = mysqli_num_rows($res3);
       			if ($clients >= 8) {
       				print(" [ <b>FULL</b> ]\n");
	       		}
	       		print(" [ Clients: " . $clients . " ] ");
						mysqli_free_result($res3);
						$stmt3 = "select * from clients where cmid = $client_date_id and standby = 'Y'";
						$res3 = mysqli_query($dbconn,$stmt3);
						$clients = mysqli_num_rows($res3);
	       		print(" [ Standby: " . $clients . " ] ");
						mysqli_free_result($res3);
	       		// end loop for clients and standby
         		print("</dd>\n");
	 				} // End while $dbrow_loc_dates...
					mysqli_free_result($res2);
    		} // End while $dbrow_locs
				mysqli_free_result($res);
			} // End if $dbinst
   	} // End if !empty(Dbconn)
		// Close the DB Conn
  	mysqli_close($dbconn);
// End Version upgrade JDA
	       
?>
</dl>
<hr>
<form action='logout.php' method='post'><input type='submit' value='Log Out' style="color:#CC0000" /></form>
<!-- Insert Content Here -->
<!-- Admin Function -->
<?PHP
// if admin equal certain value then show this else not //
if ($admin == '1')
{
?>
<hr>
<h3 style="margin: 0;">Admin Functions</h3>
<table summary="Purpose of Table" width="500" cellpadding="3" cellspacing="0" border="1">
<tr>
<td>
<form action="add_location.php" method="post">
<input type="SUBMIT" value="Add New Location">
</form>
</td>
<td>
<form action="edit_dates.php" method="post">
    <input type="SUBMIT" value="Edit Dates">
</form>

</td>
<td>
<form action="edit_location.php" method="post">
    <input type="SUBMIT" value="Edit Locations">
</form>

</td>    
</tr>
<tr>
<td>
<form action="links.php" method="post">
  <input type="SUBMIT" value="Edit Links">
</form>

</td>
  <td colspan="2">
<form action="list_ref.html" method="post">
  <input type="SUBMIT" value="List Referrals" disabled>
</form>

</td>

</tr>
<tr>
<td>
<form action="add_report.php" method="post">
  <input type="SUBMIT" value="Add PDF Report">
</form>
</td>        
<td colspan="2">
<form action="list_reports.php" method="post">
  <input type="SUBMIT" value="Edit Reports">
</form>
</td>
</tr>

</table>
<?PHP
}
?>


<!-- Navigation, buttons -->
<div align="left">
 	<?php include("../includes/nav_sub.inc"); ?>
	<?php include("../includes/address.inc"); ?>
</div>
 </body>
</html>

