<html>
<head>
<title>Vocational Assessements Links</title>
	<?php
		require("../includes/admin.inc"); 
	?>
	<style type="text/css">
	<!--
		BODY { font-family: sans-serif; }
		H1, H2, H3, H4, H5, H6 { font-family: sans-serif; margin: 0; padding: 0;}
		TD { font-family: sans-serif; }
		TH { font-family: sans-serif; }
		OL { font-family: sans-serif; }
		P { font-family: sans-serif; }
		LI { font-family: sans-serif; }
		ADDRESS { font-family: sans-serif; font-style: normal; 	font-size: 10pt; }
		.link { border: teal medium solid; width: 500px ; }
		.date { font-size: .8em; margin: 0; padding: 0; }
	-->
	</style>
</head>

<body text="#000000" bgcolor="#FFFFFF" link="#0000EF" vlink="#55188A" alink="#FF0000" >
  <div style="background-color: navy; color: white; font-family: Arial, sans-serif; height: 100;">
   <img alt="" src="../images/sidebar_logo.gif" width="123" height="95" border="0" align="RIGHT"> 
   <hr>
  </div>
<h2>Links</h2>
<h3>Add A Link</h3>
<form action="<?PHP echo $_SERVER['PHP_SELF'] ?>" method="post">
<table width="500">
  <tr>
    <th align="left">Title:</th>
    <td><input type="TEXT" name="title" size="50"></td>
  </tr>
  <tr>
    <th align="left">Description:</td>
    <td><input type="TEXT" name="description" size="50"></td>
  </tr>
  <tr>
    <th align="left">Url:</th>
    <td><input type="TEXT" name="url" size="50"></td>
  </tr>
  <tr>
  	<td colspan="2"><input type="SUBMIT" value="Add URL" name="add"></td>
  </tr>
</table>
</form>

	<?php
  	// Contains DB Connect info.  Variables used below are declared in this file.
  	include("../p2952x783E4/connect.php");
  	//connect to db server
  	$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
  	if (!empty($dbconn)) {	
     	// select the database
     	$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Could not connect to Database " . $strDatabase);
                     
     	if ($dbinst) {
				$update_flag = 0;
				$add_flag = 0;
				if(array_key_exists('update',$_POST)) {
	        $stmt = "update links set title='" . mysqli_real_escape_string($dbconn,$_POST['title']) .
									"', description='" . mysqli_real_escape_string($dbconn,$_POST['description']) .
									"', url='" . mysqli_real_escape_string($dbconn,$_POST['url']) .
									"', last_updated=NOW() where sid = '" . $_POST['sid'] . "'";
										
  	      mysqli_query($dbconn,$stmt);
					$result = mysqli_affected_rows($dbconn);
					if ($result < 1) {
						print("An error occurred while attempting to update the link in the database.  Please hit the Back button and try again. If the problem persists, please " .
									"contact the <a href='mailto:webmaster@vocationalassessments.com'>Website Administrator</a>\n");
					}	else {
							print("<h4 style='color: green;'>Link Updated</h4>\n");
							$update_flag = $_POST['sid'];
					}
				} // if update

				if(array_key_exists('delete',$_POST)) {
					$stmt = "delete from links where sid = '" . $_POST['sid'] . "'";
					mysqli_query($dbconn,$stmt);
					$result = mysqli_affected_rows($dbconn);
					if ($result < 1) { 
						print("An error occurred while attempting to delete the link from the database.  Please hit the Back button and try again. If the problem persists, please " .
									"contact the <a href='mailto:webmaster@vocationalassessments.com'>Website Administrator</a>\n");
					 	exit();
					} else {
						print("<h4 style='color: red;'>Link Deleted</h4>\n");
					}
				} // End if Delete
		
				if(array_key_exists('add',$_POST)) { 
					$stmt = "insert into links values(null, '" .
									mysqli_real_escape_string($dbconn,$_POST['title']) . "', '" .
									mysqli_real_escape_string($dbconn,$_POST['description']) . "', '" .
									mysqli_real_escape_string($dbconn,$_POST['url']) . "', NOW())";
					mysqli_query($dbconn,$stmt);
					$result = mysqli_affected_rows($dbconn);
					if ($result < 1) { 
						print("An error occurred while attempting to insert the new link into the database.  Please hit the Back button and try again. If the problem persists, please " .
									"contact the <a href='mailto:webmaster@vocationalassessments.com'>Website Administrator</a>\n");
					 	exit();
	 				} else {
      			print("<h4>Link Added</h4>\n");
      			$add_flag = mysqli_insert_id($dbconn);
			    }
			  } // if add

				$stmt = "select * from links order by title";
				$res = mysqli_query($dbconn,$stmt);
				if (!$res) {
					print("An error occurred while attempting to retrieve links from the database.  Please hit the back button to try the operation again.  If the problem " .
								"persists, please contact the <a href='mailto:webmaster@vocationalassessments.com</a>.\n");
					exit();
				} else { 
	?>
  <hr size="1" width="500" align="left">
  [ <a href="./index.php">Return to Main Admin Page</a> ]
  <hr size="1" width="500" align="left">
  <h3>Update, Delete Links</h3>
  <p class="date">The description is optional but will be displayed below the title in smaller, indented text if it is entered.</p>

	<?php
					while ($dbrow = mysqli_fetch_array($res)) {
						print("<div class=\"link\">\n");
						if($update_flag == $dbrow['sid']) {
							print("<h5 style='background-color: silver; width: 500px;'>Link Below Was Updated</h5>\n");
						}
						if ($add_flag == $dbrow['sid']) {
							print("<h5 style='background-color: silver; width: 500px;'>Link Below Was Added</h5>\n");
						}
	?>
  <form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method="post">
  <input type="HIDDEN" name="sid" value="<?PHP echo $dbrow['sid']; ?>" />
  <table width="500">
    <tr>
      <th align="left">Title:</th>
      <td><input type="TEXT" name="title" size="50" value="<?PHP echo $dbrow['title']; ?>" /></td>
    </tr>
    <tr>
      <th align="left">Description:</td>
      <td><input type="TEXT" name="description" size="50" value="<?PHP echo $dbrow['description']; ?>" /></td>
    </tr>
    <tr>
      <th align="left">URL:</th>
      <td><input type="TEXT" name="url" size="50" value="<?PHP echo $dbrow['url'];?>" /></td>
    </tr>
    <tr>
  		<td colspan="2">
  			<input type="SUBMIT" value="Update" name="update" style="color: yellow; background-color: black; font-weight: bold; ">
        <input type="SUBMIT" value="Delete" name="delete" style="color: maroon; "><br>
  			<span class="date">Last Updated: <?PHP echo $dbrow['last_updated']; ?></span>
   		</td>
    </tr>
  </table>
  </form>  

	<?php				
					} // End while ...
				} // End if (!$res ... else ...
	?>
  
  <?php
    	} // End if ($dbinst..
  	} // End if (!empty($dbconn...
  	// close db connection
  	mysqli_close($dbconn);

	?>
</div>
<hr size="1" width="500" align="left">
[ <a href="./index.php">Return to Main Admin Page</a> ]
<hr size="1" width="500" align="left">

<div align="left">
<address>
<!-- <div align="left"> -->
 	<?php include("../includes/nav_sub.inc"); ?>
	<?php include("../includes/address.inc"); ?>
<!-- </div> -->
</address>
</div>
</body> </html>
