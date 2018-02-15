	<?php
  	// Contains DB Connect info.  Variables used below are declared in this file.
  	include("../p2952x783E4/connect.php");
		$loc_id = $_POST['loc_id'];
		$standby = $_POST['standby'];
		$standby_approved = $_POST['standby_approved'];
  	//connect to db server
  	$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
  	if (!empty($dbconn)) {	
     	// select the database
     	$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Coud not connect to Database " . $strDatabase);
                     
     	if ($dbinst) {
				// Trim user-input vars
				$client = trim(utf8_decode($_POST['client_name']));
				$counselor = trim(utf8_decode($_POST['counselor']));
				$disability = addslashes(trim(utf8_decode($_POST['disability'])));
				$phone = trim(utf8_decode($_POST['phone']));
				$po_number = trim(utf8_decode($_POST['po_number']));
				$notes = addslashes(trim(utf8_decode($_POST['notes'])));
				//print("Loc Id = " . $loc_id . "<br />");
				
        $stmt = "insert into clients values(null,'$loc_id', '$client', '$counselor', '$disability', '$phone', '$po_number', '$notes', '$standby', '$standby_approved')";
				// performs the insert
        $res = mysqli_query($dbconn,$stmt);
				if ($res) {
					mysqli_close($dbconn);
					header("Location: list_clients.php?loc_dates_id=" . $loc_id);
				} else {
					print("Client could not be added to the database.  Please click the button below to return to the main admin page and try again.");
					mysqli_close($dbconn);
				}
				
    	}
  	}                                        
	?>
