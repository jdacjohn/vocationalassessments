<html>
<head>
<title>Vocational Assessments Edit Locations</title>
	<?php
		require("../includes/admin.inc"); 
	?>
	<style type="text/css">
	<!--
		BODY { font-family: sans-serif; }
		H1, H2, H3, H4, H5, H6 { font-family: sans-serif; margin: 0; }
		TD { font-family: sans-serif; }
		TH { font-family: sans-serif; }
		OL { font-family: sans-serif; }
		P { font-family: sans-serif; }
		LI { font-family: sans-serif; }
		ADDRESS { font-family: sans-serif;  font-style: normal; font-size: 10pt; }
		form { margin: 0; }
	-->
	</style>
</head>

<body text="#000000" bgcolor="#FFFFFF" link="#0000EF" vlink="#55188A" alink="#FF0000" >
  <div style="background-color: navy; color: white; font-family: Arial, sans-serif; height: 100;">
   <img alt="" src="../images/sidebar_logo.gif" width="123" height="95" border="0" align="RIGHT"> 
   <hr>
  </div>
<h2>Edit Locations</h2>

<?php
  	// Contains DB Connect info.  Variables used below are declared in this file.
  	include("../p2952x783E4/connect.php");
  	//connect to db server
  	$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
  	if (!empty($dbconn)) {	
     	// select the database
     	$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Could not connect to Database " . $strDatabase);
                     
     	if ($dbinst) {		

        $stmt = "select * from locations order by location";
        $res = mysqli_query($dbconn,$stmt);
				if (!$res) {
					print("No locations could be retrieved from the database.\n");
					exit();
				} else {
						print("<table cellpadding='3' cellspacing='0' border='1'>\n");
						print("<tr bgcolor='silver'>\n");
						print("<th>Location</th>\n");
						print("<th>Edit Text</th>\n");
						print("<th>Edit Map</th>\n");
						print("<th>Delete Location</th>\n");
						print("</tr>\n");
						
        		while ($dbrow = mysqli_fetch_array($res)) {
							print("<tr> \n");
							print("<th align='left'>" . $dbrow['location'] . "</th>\n");

							print("<td>\n");
							print("<form action='edit_location_text.php' method='post'>\n");
							print("<input type='submit' value='Edit Location Text' />\n");
							print("<input type='hidden' name='sid' value='" . $dbrow['id'] . "' />\n");
							print("</form>\n");
							print("</td>\n");

							print("<td>\n");
							print("<form action='edit_location_map.php' method='post'>\n");
							print("<input type='submit' value='Edit Location Map' />\n");
							print("<input type='hidden' name='sid' value='" . $dbrow['id'] . "' />\n");
							print("</form>\n");
							print("</td>\n");

							print("<td>\n");
							print("<form action='delete_location.php' method='post'>\n");
							print("<input type='submit' value='Delete Location' />\n");
							print("<input type='hidden' name='sid' value='" . $dbrow['id'] . "' />\n");
							print("<input type='hidden' name='map_img' value='" . $dbrow['map_img'] . "' />\n");
							print("</form>\n");

							print("</td>\n");
							print("</tr>\n");
      			} // End while ($dbrow ...
						print("</table>\n");
						mysqli_free_result($res);
					} // End if (!$res ... else ...
    	} // End if ($dbinst..
  	} // End if (!empty($dbconn...
  	// close db connection
  	mysqli_close($dbconn);
	?>

<table>
<tr>
<td>
	<form action="./index.php" method="post">
  	<input type="SUBMIT" value="Return Main Admin Page">
	</form>
</td>    
</tr>
</table>

<div align="left">
<hr width="500"  align="left" />
<address>
<!-- <div align="left"> -->
 	<?php include("../includes/nav_sub.inc"); ?>
<hr width="500"  align="left" />
	<?php include("../includes/address.inc"); ?>
<!-- </div> -->
</address>
</div>
</body> </html>
