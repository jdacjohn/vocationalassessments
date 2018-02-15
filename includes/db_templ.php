	<?php
  	// Contains DB Connect info.  Variables used below are declared in this file.
  	include("./p2952x783E4/connect.php");
  	//connect to db server
  	$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
  	if (!empty($dbconn)) {	
     	// select the database
     	$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Could not connect to Database " . $strDatabase);
                     
     	if ($dbinst) {		
        $stmt = "select * from reports order by title";
        $res = mysqli_query($dbconn,$stmt);
        while ($dbrow = mysqli_fetch_array($res)) {
					print("...\n");
      	}
				mysqli_free_result($res);
    	} // End if ($dbinst..
  	} // End if (!empty($dbconn...
  	// close db connection
  	mysqli_close($dbconn);
	?>

