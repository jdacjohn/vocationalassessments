<html>
<head>
<title>Vocational Assessments Add Location Verify</title>
	<!-- metatags if needed -->
	<?php 
		include('../includes/metak.inc');
  	include('../includes/metad.inc');
	?>

	<style type="text/css">
	<!--
	BODY { font-family: sans-serif; }
	H1, H2, H3, H4, H5, H6 { font-family: sans-serif; }
	h2 { margin-bottom: 0; }
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

<body text="#000000" bgcolor="#FFFFFF" link="#0000EF" vlink="#55188A" alink="#FF0000" >
<h2>Add Location Verify</h2>

	<?php
  	// Get out post variables out nice and cleanly
		$location = trim($_POST['location']);
		$address = addslashes(trim($_POST['address']));
		$phone = trim($_POST['phone_number']);
		$driving_inst = addslashes(trim($_POST['driving_inst']));
		$memo = addslashes(trim($_POST['memo']));
		// Contains DB Connect info.  Variables used below are declared in this file.
		
  	include("../p2952x783E4/connect.php");
  	//connect to db server
  	$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
  	if (!empty($dbconn)) {	
     	// select the database
     	$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Coud not connect to Database " . $strDatabase);
                     
     	if ($dbinst) {	
				
        $stmt = "insert into locations values(null, '$location', '$address', '$phone', '$driving_inst', null, null, null, '$memo')";
        mysqli_query($dbconn,$stmt);
				$rows = mysqli_affected_rows($dbconn);
				if ($rows < 1) {
					print("An error occurred while attempting to insert the new location into the database. Please hit the back button and attempt the operation again. If the problem persists, please contact the <a href='mailto:webmaster@vocationalassessments.com'>Website Administrator</a>.\n");
				} else {
					// Insert was successfull
					$loc_id = mysqli_insert_id($dbconn);
					//print("Last insert id on Locations Table: " . $loc_id . "<br />\n");
					// echo out what has been added to database
						print("<h3>\n");
						print("1) This Location Has  Been Added to database\n");
						print("</h3>\n");
						print("<div style=\"border: navy medium solid; padding: .5em; \">\n");
						print("<p>\n");
						print("<big>$location</big><br>\n");
						print("</p>\n");
						print("<p><b>Address:</b><br>\n");
						print(str_replace("\n", "<br>\n", $address));
						print("</p>\n");
						print("<p>\n");
						print("<b>Phone Number:</b><br>\n");
						print("$phone\n");
						print("</p>\n");
						print("<p>\n");
						print("<b>Driving Instructions:</b><br>\n");
						print(str_replace("\n", "<br>\n", $driving_inst));
						print("</p>\n");
						print("<b>Memo Field:</b><br>\n");
						print(str_replace("\n", "<br>\n", $memo));
						print("</p>\n");
						print("</div>\n");
					
				}
    	} // End if ($dbinst..
  	} // End if (!empty($dbconn...
  	// close db connection
  	mysqli_close($dbconn);
	?>

<!-- Use this for updating map as well, as well as the other pages code -->
<h3>2) Add Map</h3>
<FORM ENCTYPE="multipart/form-data" ACTION="add_map_v.php" METHOD='POST'>
<input type="hidden" name="loc_id" value="<?php print($loc_id); ?>">
<table summary="Upload of Map" border="1" cellspacing="0" cellpadding="3" width="500">
<tr>
<td>
Location Map Upload (<em>GIF or JPG format only</em>)<br>
<input name="map" type="file" size="40"> 
</td>
</tr>
<tr>
<td>
The maximum size in Kilobytes of each file should be kept as
    low as possible. The width of each map should be kept below
    600 pixels if at all possible. 
</td>
    
</tr>
<tr>
<td>
<input type="SUBMIT" value="Upload Map">
</td>
</tr>


</table>
</form>
<table summary="Purpose of Table">
<tr>
<td>
&#160;
</td>
<td>
<form action="./index.php" method="post">
    <input type="SUBMIT" value="Return Main Admin Page">
</form>

</td>    
</tr>

</table>

<hr width="50%" align="center" title="Copyright, Contact and Page Information Section">
<div align="left">
 	<?php include("../includes/nav_sub.inc"); ?>
	<?php include("../includes/address.inc"); ?>
</div>
</body> </html>
