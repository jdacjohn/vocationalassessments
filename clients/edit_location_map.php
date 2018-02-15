<html>
<head>
<title>Vocational Assessments Edit Location Map</title>
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
	ADDRESS { font-family: sans-serif; font-style: normal; font-size: 10pt; }
	-->
	</style>
</head>
<body text="#000000" bgcolor="#FFFFFF" link="#0000EF" vlink="#55188A" alink="#FF0000" >
  <div style="background-color: navy; color: white; font-family: Arial, sans-serif; height: 100;">
   <img alt="" src="../images/sidebar_logo.gif" width="123" height="95" border="0" align="RIGHT"> 
   <hr>
  </div>
<h2>Edit Location Map</h2>
	<?php
  	// Contains DB Connect info.  Variables used below are declared in this file.
  	include("../p2952x783E4/connect.php");
  	//connect to db server
  	$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
  	if (!empty($dbconn)) {	
     	// select the database
     	$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Could not connect to Database " . $strDatabase);
                     
     	if ($dbinst) {		

				if(array_key_exists('update',$_POST)) {
					$loc_id = $_POST['sid'];
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
						} // End if (($image_info ...

						// update the database with the map image info
						// Contains DB Connect info.  Variables used below are declared in this file.
						$stmt = "update locations set map_img = '$map', map_width = '$width', map_height = '$height' where id = $loc_id";
						mysqli_query($dbconn,$stmt);
						$rows = mysqli_affected_rows($dbconn);
						if ($rows <= 0) {
							print("An Error occurred while upating the map information in the database.  Please hit your back button and try the operation again.  If the problem persists, please contact the <a href='mailto:webmaster@vocationalassessments.com'>Website Administrator</a>.<br />\n");
						}
					} // End if ($map == "") ... else ... 
				} // End if (array_key_exists('update' ...
				$q = "select * from locations where id = " . $_POST['sid'];
				$res = mysqli_query($dbconn,$q);
				if (!$res) {
					print("An error occurred while attempting to retrieve Location information from the database.  Please hit the Back button to try this operation " .
								"again.  If the problem persists, please contact the <a href='mailto:webmaster@vocationalassessments.com'>Website Administrator</a>\n");
					exit();
				} // End if (!$es) ...
				
				$dbrow = mysqli_fetch_array($res);
				print("<h3>" . $dbrow['location'] . "</h3>\n");
				if (!array_key_exists('update',$_POST) && ($dbrow['map_img'] != "")) {
					print("<img src='../maps/" . $dbrow['map_img'] . "' border='0' width='" . $dbrow['map_width'] . "' height='" . $dbrow['map_height'] . "' />\n");
				}
				print("<h3>Update Map</h3>\n");
				print("<form enctype='multipart/form-data' action='" . $_SERVER['PHP_SELF'] . "' method='post'>\n");
				print("<input type='HIDDEN' name='update' value='1' />\n");
				print("<input type='HIDDEN' name='sid' value='" . $dbrow['id'] . "' />\n");
				print("<table border='1' cellspacing='0' cellpadding='3' width='500'>\n");
				print("<tr><td>Location Map Upload (<em>GIF or JPG format only</em>)<br>\n");
				print("<input name='map' type='file' size='40'>\n");
				print("</td></tr>\n");
				print("<tr><td>\n");
				print("The maximum size in Kilobytes of each file should be kept as low as possible. The width of each map should be kept below " .
							"600 pixels if at all possible.");
				print("</td></tr>\n");
				print("<tr><td>\n");
				print("<input type='SUBMIT' value='Upload Map'>\n");
				print("</td></tr>\n");
				print("</table>\n");
				print("</form>\n");
				mysqli_free_result($res);

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
