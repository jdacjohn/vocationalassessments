<html>
<head>
<title>Vocational Assessments Edit Location Text</title>
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
<h2>Edit Location Text</h2>
	<?php
  	include("../p2952x783E4/connect.php");
  	//connect to db server
  	$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
  	if (!empty($dbconn)) {	
     	// select the database
     	$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Could not connect to Database " . $strDatabase);
                     
     	if ($dbinst) {		
				
				// Process an update request
				if (array_key_exists('update',$_POST)) {
					$stmt = "update locations set location='" . mysqli_real_escape_string($dbconn,$_POST['location']) .
									"', address='" . mysqli_real_escape_string($dbconn,$_POST['address']) .
									"', phone_number='" . mysqli_real_escape_string($dbconn,$_POST['phone_number']) .
									"', driving_inst='" . mysqli_real_escape_string($dbconn,$_POST['driving_inst']) .
									"', memo='" . mysqli_real_escape_string($dbconn,$_POST['memo']) . "'" .
									" where id=" . $_POST['sid'];
					mysqli_query($dbconn,$stmt);
					$rows = mysqli_affected_rows($dbconn);
					if ($rows > 0) {
						print("<h4>Location Information Successfully Updated.</h4><br />\n");
					} else {
						print("A problem was encountered while attempting to update the location information to the database.  Please click the Back button to try this " .
									"operation again.  If the problem persists, please contact the <a href='mailto:webmaster@vocationalassessments.com'>Website Administrator</a>\n");
						exit();
					} // End if ($rows > 0 ...
					
				} // End if Update
				
				// Display Location Information
				$q = "select * from locations where id = " . $_POST['sid'];
				$res = mysqli_query($dbconn,$q);
				if (!$res) {
					print("A problem was encountered while attempting to retrieve location information from the database.  Please click the Back button to try this " .
								"operation again.  If the problem persists, please contact the <a href='mailto:webmaster@vocationalassessments.com'>Website Administrator</a>\n");
					exit();
				} // End if (!$res) ...
				$dbrow = mysqli_fetch_array($res);
				print("<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>\n");
				print("<input type='hidden' name='update' value='1'>\n");
				print("<input type='hidden' name='sid' value='" . $dbrow['id'] . "' />\n");
				print("<p align='left'>Location:<br>\n");
				print("<input type='text' name='location' size='50' value='" . $dbrow['location'] . "' />\n");
				print("</p>\n");
				print("<p align='left'>Address:<br>\n");
				print("<textarea name='address' rows='4' cols='40'>" . $dbrow['address'] . "</textarea>\n");
				print("</p>\n");
				print("<p align='left'>Phone Number:<br>\n");
				print("<input type='text' name='phone_number' size='50' value='" . $dbrow['phone_number'] . "' />\n");
				print("</p>\n");
				print("<p align='left'>Driving Instructions:<br>\n");
				print("<textarea name='driving_inst' rows='5' cols='50'>" . $dbrow['driving_inst'] . "</textarea>\n");
				print("</p>\n");
				print("<p align='left'>Memo Field:<br>\n");
				print("<textarea name='memo' rows='15' cols='50'>" . $dbrow['memo'] . "</textarea>\n");
				print("</p>\n");
				print("<input type='submit' value='Update Location Information'>\n");
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
          <input type='submit' value="Return to Edit Locations">
        </form>
      </td>
      <td>
        <form action="./index.php" method="post">
          <input type='submit' value="Return Main Admin Page">
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
