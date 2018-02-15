<html>
<head>
	<title>Vocational Assessments List Reports</title>
	<!-- metatags if needed -->
	<?php 
		include('../includes/metak.inc');
  	include('../includes/metad.inc');
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
	<?php require("../includes/admin.inc"); ?>
</head>

<body text="#000000" bgcolor="#FFFFFF" link="#0000EF" vlink="#55188A" alink="#FF0000" >
	<div style="background-color: navy; color: white; font-family: Arial, sans-serif; height: 100;">
	<img alt="" src="../images/sidebar_logo.gif" width="123" height="95" border="0" align="RIGHT"> 
  <hr>
	</div>
	<h2>List Reports</h2>
	<div>[ <a href="./index.php">Return to Admin Home</a> ] [ <a href="./add_report.php">Add A Report</a> ] [ <a href="list_reports.php">Refresh List</a> ]</div>
	<?php
  	include("../p2952x783E4/connect.php");
		$id_flag = 0;
		if (array_key_exists('action',$_POST)) {
			$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
			if (!empty($dbconn)) {	
				// select the database
				$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Coud not connect to Database " . $strDatabase);
				if ($dbinst) {	
					$sid = $_POST['sid'];
					// User submitted an update request
					if($_POST['action'] == 'update') {
						$stmt = "update reports set title = '" .
										mysqli_real_escape_string($dbconn,$_POST['title']) .
										"', memo = '" .
										mysqli_real_escape_string($dbconn,$_POST['memo']) .
										"', report_date = NOW() where sid = $sid";
						//print("SQL = " . $stmt . "<br />\n");
						mysqli_query($dbconn,$stmt);
						$res = mysqli_affected_rows($dbconn);
						if ($res > 0) {
							print("<h4>The report was successfully updated.</h4>\n");
							print("<p>Updated reports are highlighted in <span style='color:#0000ff;'>Blue</span></p>\n");
							$id_flag = $sid;
						} else {
							print("An error occurred while attempting to update the database.  Please click the back button and try the operation again.  If the " .
										"problem persists, please contact the <a href='mailto:webmaster@vocationalassessments.com'>Website Administrator</a>.\n");
							exit();
						} // End if ($res > 0 ...
					} // End if ($_POST['action'] == 'Update' ....
					
					// Delete the report from the filesystem and the database.
					if($_POST['action'] == 'delete') {
						$stmt = "delete from reports where sid = '$sid'";
						mysqli_query($dbconn,$stmt);
						$result = mysqli_affected_rows($dbconn); 
						if ($result > 0) {
							print("Report " . $sid . " Was Deleted From The Database.<br />\n");
							$file_res = unlink("../reports/" . $_POST['pdf_file']);
							if(!$file_res) {
								print("<h4>A Filesystem Error occurred while attempting to delete report " . $sid . "</h4>\n");
								print("<p>If the problem persists, please report the error to the <a href='mailto:webmaster@vocationalassessments.com'>Website Administrator</a>.</p>\n");
							} else {
								print("Report File Successfully Deleted from Server.<br />\n");
							} // End if (!$file_res ...
						} else { 
							print("An error occurred while attempting to delete the selected report from the database.  Please click the back button and try the operation again.  If the " .
										"problem persists, please contact the <a href='mailto:webmaster@vocationalassessments.com'>Website Administrator</a>.\n");
							exit();
						} // End if (!result ...
					}   // End if ($_POST['action' == 'Delete' ...
					
				} // End if ($dbinst...
				// close db connection
				mysqli_close($dbconn);
			} // End if (!empty($dbconn ...
			
		} // End if (array_key_exists...
  	
  	// No action submitted. List the existing reports.
  	$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
  	if (!empty($dbconn)) {	
     	// select the database
     	$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Coud not connect to Database " . $strDatabase);
                     
     	if ($dbinst) {		
        $stmt = "select * from reports order by title";
        $res = mysqli_query($dbconn,$stmt);
				print("<div><strong>The system found " . mysqli_num_rows($res) . " reports.</strong></div>\n");
        while ($dbrow = mysqli_fetch_array($res)) {
					print("<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>\n");
					print("<div style='width: 500px; border: black medium outset; padding: 1em;'>\n");
					print("<p align='left'>\n");
					if($id_flag == $dbrow['sid']) {
						print("<span style='color:#0000FF;'>");
					}
					print("Report " . $dbrow['sid']);
					if($id_flag == $dbrow['sid']) {
						print("</span>");
					}
					print(" Last Updated on " . $dbrow['report_date'] . "<br>\n");
					print("</p>\n");
					print("<p>Report Title:<br />\n");
					print("<input type='text' name='title' size='50' value=\"" . $dbrow['title'] . "\" />\n");
					print("</p>\n");
					print("<p align='left'>\n");
					print("Discussion Memo:\n");
					print("<textarea name='memo' rows='15' cols='50'>" . $dbrow['memo'] . "</textarea>\n");
					print("</p>\n");
					print("<p align='left'>\n");
					print("<a href='../reports/" . $dbrow['report_pdf'] . "' target='report_window'>Sample Report " . $dbrow['sid'] . " in PDF Format</a><br>\n");
					print("<span style='color: #808080;'>File Size: " . number_format($dbrow['report_size']) . " Bytes</span><br />\n");
					print("Opens New Window</p></div>\n");
					print("<input type='hidden' name='sid' value='" . $dbrow['sid'] . "' />\n");
					print("<input type='hidden' name='pdf_file' value='" . $dbrow['report_pdf'] . "' />\n");
					print("<table>\n<tr>\n");
					print("<td><input type='submit' value='update' name='action'></td>\n");
					print("<td><input type='submit' value='delete' name='action'></td>\n");
					print("</tr></table>\n");
					print("<hr align='left' width='500'>\n");
					print("</form>\n");
      	} // End while ($dbrow ...
				mysqli_free_result($res);
    	} // End if ($dbinst..
  	} // End if (!empty($dbconn...
  	// close db connection
  	mysqli_close($dbconn);

	?>
<div>[ <a href="./index.php">Return to Admin Home</a> ] [ <a href="./add_report.php">Add A Report</a> ] [ <a href="./list_reports.php">Refresh List</a> ]</div>
<div align="center">
<hr width="50%" align="center" title="Copyright, Contact and Page Information Section">
<div align="left">
 	<?php include("../includes/nav_sub.inc"); ?>
	<?php include("../includes/address.inc"); ?>
</div>
</div>
</body> </html>
