<html>
<head>
<title>Vocational Assessments Delete Location</title>
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
		ADDRESS { font-family: sans-serif; font-style: normal; font-size: 10pt; }
		.cs { border: maroon medium solid; width: 500px; }
		-->
	</style>
</head>
<body text="#000000" bgcolor="#FFFFFF" link="#0000EF" vlink="#55188A" alink="#FF0000" >
  <div style="background-color: navy; color: white; font-family: Arial, sans-serif; height: 100;">
   <img alt="" src="../images/sidebar_logo.gif" width="123" height="95" border="0" align="RIGHT"> 
   <hr>
  </div>
<h2 style="color: red;">Location/Client/Standby/Map Deletions</h2>
	<?php
  	// Contains DB Connect info.  Variables used below are declared in this file.
  	include("../p2952x783E4/connect.php");
  	//connect to db server
  	$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
  	if (!empty($dbconn)) {	
     	// select the database
     	$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Could not connect to Database " . $strDatabase);
                     
     	if ($dbinst) {		
        
				// Get all the meeting date ids to delete the clients
				$q = "select cmid, loc_id from loc_dates where loc_id = " . $_POST['sid'];
        		$res = mysqli_query($dbconn,$q);
				if (!$res) {
					print("An error occurred while attempting to retrieve the location meeting date information from the database.  Please hit the Back button " .
								"and try the operation again. If the problem persists, please contact the <a href='mailto:webmaster@vocationalassessments.com'>Website " .
								"Administrator</a>\n");
					exit();
				}
        while ($dbrow = mysqli_fetch_array($res)) {
					print("<div class='cs'>\n");
					print("<p>\n");
					print("Location ID: " . $_POST['sid'] . "<br />\n"); 
					print(" - Location Dates Meeting ID: " . $dbrow['cmid'] . "<br />\n");
					print(" - Location Dates Location ID: " . $dbrow['loc_id'] . "<br />\n");
					print("</p>\n");
					$cmid = $dbrow['cmid'];
	  			// Delete all Clients for the Meeting Date
					$q2 = "delete from clients where cmid = $cmid";
					mysqli_query($dbconn,$q2);
					$rows = mysqli_affected_rows($dbconn);
					// 0 is Okay here for instances where no clients were set up for the meeting date
					if ($rows < 0) {
						print("An error occurred while attempting to delete the clients for Meeting ID: $cmid.  Please hit the Back button to try this operation " .
									"again.  If the problem persists, please contact the <a href='mailto:webmaster@vocationalassessments.com'>Website Administrator</a>\n");
						exit();
					} else {
						print("All Clients for Meeting ID: $cmid DELETED.");
					}
					print("<br>&nbsp;\n");
					print("</div>\n");
					print("<br>&nbsp;\n");
      	} // End while ($dbrow ...
				mysqli_free_result($res);

				// Now delete the actual meeting dates.
				$q = "delete from loc_dates where loc_id = " . $_POST['sid'];
				mysqli_query($dbconn,$q);
				$rows = mysqli_affected_rows($dbconn);
				print("<div class='cs'>\n");
				// 0 is okay in this case because there may be no dates associated with this location
				if ($rows < 0) {
					print("An error occurred while attempting to delete the meeting dates for Location " . $_POST['sid'] . ". Please hit the Back button " .
								"to try the operation again.  If the problem persists, please contact the <a href='mailto:webmaster@vocationalassessments.com>'" .
								"Website Administrator</a>.\n");
					exit();
				} else {
					print("All Meeting Dates for Location " . $_POST['sid'] . " DELETED.<br />\n");
				}
				print("</div>\n<br />&nbsp;\n");				
				// Delete the Location - First get the MAP file name so we can unlink it.
				$q = "select map_img from locations where id = " . $_POST['sid'];
				$res = mysqli_query($dbconn,$q);
				$map_img = "";
				if ($res) {
					$dbrow = mysqli_fetch_array($res);
					$map_img = $dbrow['map_img'];
					mysqli_free_result($res);
				}
				$q = "delete from locations where id = " . $_POST['sid'];
				mysqli_query($dbconn,$q);
				$rows = mysqli_affected_rows($dbconn);
				print("<div class='cs'>\n");
				// 0 is NOT okay in this instance.
				if ($rows <= 0) {
					print("An error occurred while attempting to delete Location " . $_POST['sid'] . " from the database. Please hit the Back button " .
								"and try the operation again. If the problem persists, please contact the <a href='mailto:webmaster@vocationalassessments.com'>" .
								"Website Administrator.</a>\n");
					exit();
				} else {
					print("Location " . $_POST['sid'] . " successfully DELETED.<br />&nbsp;<br />\n");
					// Delete the map image file if one was recorded for this location
					if ($map_img != "") {
						$delres = unlink("../maps/" . $map_img);
						if ($delres) {
							print("Map Image File for Location " . $_POST['sid'] . " DELETED.<br />&nbsp;<br />\n");
						}
					}
				} // End if ($rows <= 0) ...
				print("</div>\n");
					
			} // End if ($dbinst..
  	} // End if (!empty($dbconn...
  	// close db connection
  	mysqli_close($dbconn);
	?>


  <table>
  	<tr>
  		<td>
        <form action="./edit_location.php" method="post">
	        <input type="SUBMIT" value="Return to Edit Locations">
        </form>
		  </td>
  		<td>
  			<form action="./index.php" method="post">
      		<input type="SUBMIT" value="Return Main Admin Page">
  			</form>
 			</td>    
		</tr>
  </table>


  <div align="left">
  <hr width="70%" align="left" title="Copyright, Contact and Page Information Section">
  <address>
  <!-- <div align="left"> -->
    <?php include("../includes/nav_sub.inc"); ?>
  <hr width="70%"  align="left" />
    <?php include("../includes/address.inc"); ?>
  <!-- </div> -->
  </address>
  </div>
</body>
</html>

