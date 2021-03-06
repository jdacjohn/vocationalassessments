<?php
	// Store all referral form data to the database.
	// Get out POST vars
	$success = 0;
	session_start();
	$referDate = trim($_POST['ref_date']);
	$refLoc = $_POST['ref_loc'];
	$refLName = trim($_POST['ref_lname']);
	$refFName = trim($_POST['ref_fname']);
	$refMI = trim($_POST['ref_mi']);
	$refStreet = trim($_POST['ref_street']);
	$refCity = trim($_POST['ref_city']);
	$refState = trim($_POST['ref_state']);
	$refZip = trim($_POST['ref_zip']);
	$refIndependent = $_POST['ref_independent'];
	$refGender = $_POST['ref_gender'];
	$refEdu = $_POST['ref_edu'];
	$refSpecTrn = $_POST['ref_spectrn'];
	$refPhone = trim($_POST['ref_phone']);
	$refPrefLang = $_POST['ref_pref_lang'];
	$refAge = trim($_POST['ref_age']);
	$refTrans = $_POST['ref_trans'];
	$refPDis = trim($_POST['ref_pdis']);
	$refSDis = trim($_POST['ref_sdis']);
	$refComments = trim($_POST['ref_comments']);
	// Checkboxes
	$attaches = 'no';
	if (isset($_POST['ref_attach_iwrp'])) {
		$refIWRP = 'yes';
		$attaches = 'yes';
	} else {
		$refIWRP = 'no';
	}
	if (isset($_POST['ref_attach_prog_rpts'])) {
		$refProgReports = 'yes';
		$attaches = 'yes';
	} else {
		$refProgReports = 'no';
	}
	if (isset($_POST['ref_attach_contact_rpts'])) {
		$refContactReports = 'yes';
		$attaches = 'yes';
	} else {
		$refContactReports = 'no';
	}
	if (isset($_POST['ref_attach_med_rpts'])) {
		$refMedReports = 'yes';
		$attaches = 'yes';
	} else {
		$refMedReports = 'no';
	}
	if (isset($_POST['ref_attach_trans'])) {
		$refTranscripts = 'yes';
		$attaches = 'yes';
	} else {
		$refTranscripts = 'no';
	}
	if (isset($_POST['ref_attach_soc_eval'])) {
		$refSocEval = 'yes';
		$attaches = 'yes';
	} else {
		$refSocEval = 'no';
	}
	if (isset($_POST['ref_attach_psych_eval'])) {
		$refPsychEval = 'yes';
		$attaches = 'yes';
	} else {
		$refPsychEval = 'no';
	}
	if (isset($_POST['ref_attach_inf_release'])) {
		$refInfRelease = 'yes';
		$attaches = 'yes';
	} else {
		$refInfRelease = 'no';
	}
	if (isset($_POST['ref_attach_other_chk'])) {
		$refOther = 'yes';
		$attaches = 'yes';
		$refOtherDesc = trim($_POST['ref_attach_other']);
	} else {
		$refOther = 'no';
		$refOtherDesc = '';
	}

	$refBy = trim($_POST['ref_referred_by']);
	$refOrg = trim($_POST['ref_organization']);
	$refStartDate = trim($_POST['ref_start_date']);
	
	// More Check Boxes
	$questions = 'no';
	if (isset($_POST['ref_q1'])) {
		$refQ1 = 'yes';
		$questions = 'yes';
	} else {
		$refQ1 = 'no';
	}
	if (isset($_POST['ref_q2'])) {
		$refQ2 = 'yes';
		$questions = 'yes';
	} else {
		$refQ2 = 'no';
	}
	if (isset($_POST['ref_q3'])) {
		$refQ3 = 'yes';
		$questions = 'yes';
	} else {
		$refQ3 = 'no';
	}
	if (isset($_POST['ref_q4'])) {
		$refQ4 = 'yes';
		$questions = 'yes';
	} else {
		$refQ4 = 'no';
	}
	if (isset($_POST['ref_q5'])) {
		$refQ5 = 'yes';
		$questions = 'yes';
	} else {
		$refQ5 = 'no';
	}
	if (isset($_POST['ref_q6'])) {
		$refQ6 = 'yes';
		$questions = 'yes';
	} else {
		$refQ6 = 'no';
	}
	if (isset($_POST['ref_q7'])) {
		$refQ7 = 'yes';
		$questions = 'yes';
	} else {
		$refQ7 = 'no';
	}
	if (isset($_POST['ref_q8'])) {
		$refQ8 = 'yes';
		$questions = 'yes';
	} else {
		$refQ8 = 'no';
	}
	if (isset($_POST['ref_q9'])) {
		$refQ9 = 'yes';
		$questions = 'yes';
	} else {
		$refQ9 = 'no';
	}
	if (isset($_POST['ref_tsa'])) {
		$refTSA = 'yes';
		$questions = 'yes';
	} else {
		$refTSA = 'no';
	}

	$refOtherQs = trim($_POST['ref_oth_qs']);
	if ($refOtherQs) {
		$questions = 'yes';
	}
		
	$refMandQ1 = trim($_POST['ref_mand_q1']);
	$refMandQ2 = trim($_POST['ref_mand_q2']);
	$refMandQ3 = trim($_POST['ref_mand_q3']);
	$client_id = $_POST['client_id'];
	
	// unset SESSION vars from any previous submit attempts
		// Write user input data to the SESSION
		if (isset($_SESSION['referDate'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refLoc'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refLName'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refFName'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refMI'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refStreet'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refCity'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refState'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refZip'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refIndependent'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refGender'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refEdu'])) { unset($_SESSION['referDate']);; }
		if (isset($_SESSION['refSpecTrn'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refPhone'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refPrefLang'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refAge'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refTrans'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refPDis'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refSDis'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refComments'])) { unset($_SESSION['referDate']); }
		// Checkboxes
		if (isset($_SESSION['refIWRP'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refProgReports'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refContactReports'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refMedReports'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refTranscripts'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refSocEval'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refPsychEval'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refInfRelease'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refOther'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refOtherDesc'])) { unset($_SESSION['referDate']); }
		// More text fields
		if (isset($_SESSION['refBy'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refOrg'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refStartDate'])) { unset($_SESSION['referDate']); }
		// More Checkboxes
		if (isset($_SESSION['refQ1'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refQ2'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refQ3'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refQ4'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refQ5'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refQ6'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refQ7'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refQ8'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refQ9'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refTSA'])) { unset($_SESSION['referDate']); }
		// Final Input fields
		if (isset($_SESSION['refOtherQs'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refMandQ1'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refMandQ2'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['refMandQ3'])) { unset($_SESSION['referDate']); }
		if (isset($_SESSION['attaches'])) { unset($_SESSION['attaches']); }
		if (isset($_SESSION['questions'])) { unset($_SESSION['questions']); }
	
	// Clear any SESSION bad input flags from previous attempts...
		if (isset($_SESSION['badReferDate'])) { unset($_SESSION['badReferDate']); }
		if (isset($_SESSION['badRefLoc'])) { unset($_SESSION['badRefLoc']); }
		if (isset($_SESSION['badRefLName'])) { unset($_SESSION['badRefLName']); }
		if (isset($_SESSION['badRefFName'])) { unset($_SESSION['badRefFName']); }
		if (isset($_SESSION['badRefStreet'])) { unset($_SESSION['badRefStreet']); }
		if (isset($_SESSION['badRefCity'])) { unset($_SESSION['badRefCity']); }
		if (isset($_SESSION['badRefState'])) { unset($_SESSION['badRefState']); }
		if (isset($_SESSION['badRefZip'])) { unset($_SESSION['badRefZip']); }
		if (isset($_SESSION['badRefEdu'])) { unset($_SESSION['badRefEdu']); }
		if (isset($_SESSION['badRefPhone'])) { unset($_SESSION['badRefPhone']); }
		if (isset($_SESSION['badRefPrefLang'])) { unset($_SESSION['badRefPrefLang']); }
		if (isset($_SESSION['badRefTrans'])) { unset($_SESSION['badRefTrans']); }
		if (isset($_SESSION['badRefPDis'])) { unset($_SESSION['badRefPDis']); }
		if (isset($_SESSION['badRefBy'])) { unset($_SESSION['badRefBy']); }
		if (isset($_SESSION['badRefOrg'])) { unset($_SESSION['badRefOrg']); }
		if (isset($_SESSION['badRefStartDate'])) { unset($_SESSION['badRefStartDate']); }
		if (isset($_SESSION['badRefMandQ1'])) { unset($_SESSION['badRefMandQ1']); }
		if (isset($_SESSION['badRefMandQ2'])) { unset($_SESSION['badRefMandQ2']); }
		if (isset($_SESSION['badRefMandQ3'])) { unset($_SESSION['badRefMandQ3']); }
	
	//  Don't do anything but go back to the login page if either userid or password is missing
	if (!$referDate || !$refLoc || ($refLoc == '') || !$refLName || !$refFName || !$refStreet || !$refCity || !$refState || !$refZip || !$refEdu || !$refPhone ||
			!$refPrefLang || !$refTrans || !$refPDis || !$refBy || !$refOrg || !$refStartDate || !$refMandQ1 || !$refMandQ2 || !$refMandQ3) {
		// Save user input data to the SESSION so they don't have to re-enter everything because of 1 error!
		if (!$referDate) {
			$_SESSION['badReferDate'] = 1;
		}
		if (!$refLoc) {
			$_SESSION['badRefLoc'] = 1;
		}
		if (!$refLName) {
			$_SESSION['badRefLName'] = 1;
		}
		if (!$refFName) {
			$_SESSION['badRefFName'] = 1;
		}
		if (!$refStreet) {
			$_SESSION['badRefStreet'] = 1;
		}
		if (!$refCity) {
			$_SESSION['badRefCity'] = 1;
		}
		if (!$refState) {
			$_SESSION['badRefState'] = 1;
		}
		if (!$refZip) {
			$_SESSION['badRefZip'] = 1;
		}
		if (!$refEdu) {
			$_SESSION['badRefEdu'] = 1;
		}
		if (!$refPhone) {
			$_SESSION['badRefPhone'] = 1;
		}
		if (!$refPrefLang) {
			$_SESSION['badRefPrefLang'] = 1;
		}
		if (!$refTrans) {
			$_SESSION['badRefTrans'] = 1;
		}
		if (!$refPDis) {
			$_SESSION['badRefPDis'] = 1;
		}
		if (!$refBy) {
			$_SESSION['badRefBy'] = 1;
		}
		if (!$refOrg) {
			$_SESSION['badRefOrg'] = 1;
		}
		if (!$refStartDate) {
			$_SESSION['badRefStartDate'] = 1;
		}
		if (!$refMandQ1) {
			$_SESSION['badRefMandQ1'] = 1;
		}
		if (!$refMandQ2) {
			$_SESSION['badRefMandQ2'] = 1;
		}
		if (!$refMandQ3) {
			$_SESSION['badRefMandQ3'] = 1;
		}
		// Write user input data to the SESSION
		$_SESSION['referDate'] = $referDate;
		$_SESSION['refLoc'] = $refLoc;
		$_SESSION['refLName'] = $refLName;
		$_SESSION['refFName'] = $refFName;
		$_SESSION['refMI'] = $refMI;
		$_SESSION['refStreet'] = $refStreet;
		$_SESSION['refCity'] = $refCity;
		$_SESSION['refState'] = $refState;
		$_SESSION['refZip'] = $refZip;
		$_SESSION['refIndependent'] = $refIndependent;
		$_SESSION['refGender'] = $refGender;
		$_SESSION['refEdu'] = $refEdu;
		$_SESSION['refSpecTrn'] = $refSpecTrn;
		$_SESSION['refPhone'] = $refPhone;
		$_SESSION['refPrefLang'] = $refPrefLang;
		$_SESSION['refAge'] = $refAge;
		$_SESSION['refTrans'] = $refTrans;
		$_SESSION['refPDis'] = $refPDis;
		$_SESSION['refSDis'] = $refSDis;
		$_SESSION['refComments'] = $refComments;
		// Checkboxes
		$_SESSION['refIWRP'] = $refIWRP;
		$_SESSION['refProgReports'] = $refProgReports;
		$_SESSION['refContactReports'] = $refContactReports;
		$_SESSION['refMedReports'] = $refMedReports;
		$_SESSION['refTranscripts'] = $refTranscripts;
		$_SESSION['refSocEval'] = $refSocEval;
		$_SESSION['refPsychEval'] = $refPsychEval;
		$_SESSION['refInfRelease'] = $refInfRelease;
		$_SESSION['refOther'] = $refOther;
		$_SESSION['refOtherDesc'] = $refOtherDesc;
		// More text fields
		$_SESSION['refBy'] = $refBy;
		$_SESSION['refOrg'] = $refOrg;
		$_SESSION['refStartDate'] = $refStartDate;
		// More Checkboxes
		$_SESSION['refQ1'] = $refQ1;
		$_SESSION['refQ2'] = $refQ2;
		$_SESSION['refQ3'] = $refQ3;
		$_SESSION['refQ4'] = $refQ4;
		$_SESSION['refQ5'] = $refQ5;
		$_SESSION['refQ6'] = $refQ6;
		$_SESSION['refQ7'] = $refQ7;
		$_SESSION['refQ8'] = $refQ8;
		$_SESSION['refQ9'] = $refQ9;
		$_SESSION['refTSA'] = $refTSA;
		// Final Input fields
		$_SESSION['refOtherQs'] = $refOtherQs;
		$_SESSION['refMandQ1'] = $refMandQ1;
		$_SESSION['refMandQ2'] = $refMandQ2;
		$_SESSION['refMandQ3'] = $refMandQ3;
		$_SESSION['attaches'] = $attaches;
		$_SESSION['questions'] = $questions;
		
		header("Location: ./referral.php?&mi=1&clid=" . $client_id);
	//print("Last Name = " . $refLName . "<br />");
	} else {
		print("Got past the wtf<br />\n");
		include("../p2952x783E4/connect.php");
 		//connect to db server
 		$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
 		if (!empty($dbconn)) {	
   		// Get a DB Instance
   		$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Coud not connect to Database " . $strDatabase);
      //print("User = " . mysqli_real_escape_string($dbconn,$user) . "<br />\n");               
   		if ($dbinst) {		
      	$stmt = "insert into referrals values(null, " .
								"$client_id, '" .
								mysqli_real_escape_string($dbconn,$referDate) .
								"', $refLoc, '" .
								mysqli_real_escape_string($dbconn,$refLName) .
								"', '" . mysqli_real_escape_string($dbconn,$refFName) .
								"', '" . mysqli_real_escape_string($dbconn,$refMI) .
								"', '" . mysqli_real_escape_string($dbconn,$refStreet) .
								"', '" . mysqli_real_escape_string($dbconn,$refCity) .
								"', '" . mysqli_real_escape_string($dbconn,$refState) .
								"', '" . mysqli_real_escape_string($dbconn,$refZip) .
								"', '$refIndependent', $refAge, '$refGender', '$refEdu', '$refSpecTrn', '" .
								mysqli_real_escape_string($dbconn,$refPhone) . "', '$refPrefLang', " .
								"'$refTrans', '" . mysqli_real_escape_string($dbconn,$refPDis) . "', '" .
								mysqli_real_escape_string($dbconn,$refSDis) . "', '" . mysqli_real_escape_string($dbconn,$refComments) . "', '$refIWRP', '$refProgReports'," .
								"'$refContactReports', '$refMedReports', '$refTranscripts', '$refSocEval', '$refPsychEval'," .
								"'$refInfRelease', '$refOther', '" . mysqli_real_escape_string($dbconn,$refOtherDesc) . 
								"', '$refQ1', '$refQ2', '$refQ3', '$refQ4', '$refQ5', '$refQ6', '$refQ7', '$refQ8', '$refQ9', '$refTSA', '" .
								mysqli_real_escape_string($dbconn,$refOtherQs) . "', '" .
								mysqli_real_escape_string($dbconn,$refBy) . "', '" . mysqli_real_escape_string($dbconn,$refOrg) . "', '" .
								mysqli_real_escape_string($dbconn,$refStartDate) . "', '" .
								mysqli_real_escape_string($dbconn,$refMandQ1) . "', '" .
								mysqli_real_escape_string($dbconn,$refMandQ2) . "', '" .
								mysqli_real_escape_string($dbconn,$refMandQ3) .
								"')";
      	$res = mysqli_query($dbconn,$stmt);
		//if (!$res) {
		//	print("something isn't working with the database<br />\n");
		//} else {
		//	print("We should be having some results!<br />\n");
		//}
		$success = mysqli_num_rows($res);
		//print("Success = " . $success . "<br />\n");
   		} // End if ($dbinst..
 		} // End if (!empty($dbconn...
 		// close db connection
 		mysqli_close($dbconn);
		//print($success);
		header("Location: ./ref_sub_success.php");
	} // End If (!user || !password) else
?>
