<html>
<head>
<title>Vocational Assessments Add Map Verify</title>
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
<h2>Add Map Verify</h2>

	<?php
		// Get our post vars
		$loc_id = $_POST['loc_id'];
		$uploaddir = "../maps/";
		$map = basename($_FILES['map']['name']);
		$uploadfile = $uploaddir . $map;
		if ($map == "") { 
			// no file selected
  		print("<p align=\"center\">Did you select a file to upload?<br>\n");
  		print("Please use your back button try again.</p>\n");
  		exit();
		} else {
  		// get information about file uploaded
  		$image_info = getimagesize($_FILES['map']['tmp_name']);
  		$width = $image_info[0];
  		$height = $image_info[1];
			//print("Image Width = " . $width . "<br />\n");
			//print("Image Height = " . $height . "<br />\n");
			//print("Image file name = " . $map . "<br />\n");
			//print("Image Type = " . $image_info[2] . "<br />\n");

  		if (($image_info[2] == 1) || ($image_info[2] == 2)) {
      	move_uploaded_file($_FILES['map']['tmp_name'],$uploadfile);
      	print("<h3>Map Successfully Uploaded</h3>\n");
      	print("<img src='" . $uploadfile . "' width='" . $width . "' height='" . $height . "' />\n");
    	} else { 
				// if not 1 or 2, then error
      	print("<p align=\"center\">The file is not a GIF or JPG file<br>\n");
      	print("Please use your back button and try again.\n");
      	print("</p>\n");
      	exit();
    	}

			// update the database with the map image info
			// Contains DB Connect info.  Variables used below are declared in this file.
 			include("../p2952x783E4/connect.php");
 			//connect to db server
 			$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
 			if (!empty($dbconn)) {	
   			// select the database
   			$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Coud not connect to Database " . $strDatabase);
                     
   			if ($dbinst) {		
       		$stmt = "update locations set map_img = '$map', map_width = '$width', map_height = '$height' where id = $loc_id";
       		mysqli_query($dbconn,$stmt);
					$rows = mysqli_affected_rows($dbconn);
					if ($rows <= 0) {
						print("An Error occurred while uploading the map.  Please hit your back button and try the operation again.  If the problem persists, please contact the <a href='mailto:webmaster@vocationalassessments.com'>Website Administrator</a>.<br />\n");
					} 
					
   			} // End if ($dbinst..
 			} // End if (!empty($dbconn...
 			// close db connection
 			mysqli_close($dbconn);
		} 
	?>


<table summary="Purpose of Table">
<tr>
<td>
<form action="./index.php" method="post">
    <input type="SUBMIT" value="Return Main Admin Page">
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
