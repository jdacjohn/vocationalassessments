<html>
<head>
<title>Vocational Assessments Add Report</title>
	<!-- metatags if needed -->
	<?php 
		include('../includes/metak.inc');
  	include('../includes/metad.inc');
	?>
	<style type="text/css">
	<!--
		BODY { font-family: sans-serif; }
		H1, H2, H3, H4, H5, H6 { font-family: sans-serif;}
		TD { font-family: sans-serif; }
		TH { font-family: sans-serif; }
		OL { font-family: sans-serif; }
		P { font-family: sans-serif; }
		LI { font-family: sans-serif; }
		ADDRESS { font-family: sans-serif; 	font-style: normal; 	font-size: 10pt; }
	-->
	</style>
	<?php require("../includes/admin.inc"); ?>
</head>

<body text="#000000" bgcolor="#FFFFFF" link="#0000EF" vlink="#55188A" alink="#FF0000" >
<div style="background-color: navy; color: white; font-family: Arial, sans-serif; height: 100;">
	<img alt="" src="../images/sidebar_logo.gif" width="123" height="95" border="0" align="RIGHT"> 
  <hr>
</div>
<h2> Add Report</h2>
<?PHP
if (array_key_exists('add',$_POST)) {
	if($_POST['add'] == 1) {
		// first lets see about getting the file up and adam.
		// No file selected
		if (!$_FILES['pdf']) {
	  	echo("<p align=\"center\">Did you select a file to upload?<br>\n");
  		echo("Please use your back button try again.</p>\n");
  		exit();
		} else {
			$uploaddir = "../reports/";
			$report = basename($_FILES['pdf']['name']);
			$uploadfile = $uploaddir . $report;
			$filesize = filesize($_FILES['pdf']['tmp_name']);
     	move_uploaded_file($_FILES['pdf']['tmp_name'],$uploadfile);
  		echo "<h3>PDF Report Successfully Uploaded.</h3>\n";
			// file has been uploaded, now to insert the information into the database
			// Contains DB Connect info.  Variables used below are declared in this file.
			include("../p2952x783E4/connect.php");
			//connect to db server
			$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
			if (!empty($dbconn)) {	
				// select the database
				$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Could not connect to Database " . $strDatabase);
											 
				if ($dbinst) {		
					// Let's get our post var vals
					$title = trim(mysqli_real_escape_string($_POST['title']));
					$memo = trim(mysqli_real_escape_string($_POST['memo']));
					$stmt = "insert into reports values(null,'$title','$memo','$report',null,$filesize)";
					mysqli_query($dbconn,$stmt);
					$result = mysqli_affected_rows($dbconn);
					if ($result < 0) {
						print("An error occurred while attempting to insert the report information into the database.  If this error persists, please contact the " .
									"<a href='mailto:webmaster@vocationalassessments.com'>Website Administrator</a>.<br />\n");
					}
				} // End if ($dbinst..
			} // End if (!empty($dbconn...
			// close db connection
			mysqli_close($dbconn);
		} // End if ($_POST['pdf...
	} // End if ($_POST['add']...

} // end if (isset...
?>

[ <a href="./index.php">Return to Admin Home</a> ][ <a href="./list_reports.php">List Reports</a> ]
<?php print("<form enctype='multipart/form-data' action='" . $_SERVER['PHP_SELF'] . "' method='post'>\n"); ?>
	<p align="left">
		Report Title:<br>
		<input type='text' name='title' size='50' maxlength='60'>
	</p>
	<p align="left">
		Discussion Memo:<br>
		<textarea name='memo' rows='15' cols='50'></textarea>
	</p>
	<p align="left">
		PDF file:<br>
		<input name='pdf' type='file' size='40'>
	</p>

	<input type='hidden' name='add' value='1'>
	<input type='submit' value='Add'>
</form>


<table summary="Purpose of Table">
	<tr>
		<td>
			<form action='index.php' method='post'>
				<input type='SUBMIT' value='Return Main Admin Page'>
			</form>
		</td>    
	</tr>
</table>

<hr width="50%" align="center" title="Copyright, Contact and Page Information Section">
<div align="left">
 	<?php include("../includes/nav_sub.inc"); ?>
	<?php include("../includes/address.inc"); ?>
</div>
</body>
</html>