<html>
<head>
<title>VIP Services Vocational Evaluation Referral Form</title>
  <link rel="STYLESHEET" href="../css/vip.css">
	<!-- metatags if needed -->
	<?php 
		include('../includes/metak.inc');
  	include('../includes/metad.inc');
	?>
	<?php require("../includes/admin.inc"); ?>
   <script type='text/javascript' src='../script/vacom.js'></script> 
</head>

<body text="#000000" bgcolor="#FFFFFF" link="#0000EF" vlink="#55188A" alink="#FF0000" onLoad="javascript:document.ref_form.ref_date.focus();" >
  <div style="background-color: navy; color: white; font-family: Arial, sans-serif; height: 100;">
   <img alt="" src="../images/sidebar_logo.gif" width="123" height="95" border="0" align="RIGHT"> 
   <hr>
  </div>
	<h2>&nbsp;VIP Services Vocational Evaluation Program On-line Referral Form</h2>
	<div class="top_nav">
  	[ <a href="./index.php">Return to Admin Home</a> ]
    [ <?php print("<a href='./list_clients.php?loc_dates_id=" . $_POST['locDateId'] . "'>Return to List Clients</a>\n"); ?> ]
   </div>
	<table width="640" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width='20' id='rf-tl'>&nbsp;</td>
			<td width='600' id='rf-top'>&nbsp;</td>
			<td width='20' id='rf-tr'>&nbsp;</td>
		</tr>
  	<tr>
    	<td width='20' class='rf-left'>&nbsp;</td>
      <td width='600' class='rf-bg' align='left'><b>NOTE:</b> All Referrals are for Three Day Assessments which include 15-20 Tests, Career Exploration,
      Job Matching, Detailed Interview, Questions Answered, and Staffing. $450.<br />&nbsp;</td>
      <td width='20' class='rf-right'>&nbsp;</td>
    </tr>
    <?php
			if (isset($_GET['mi'])) {
				print("<tr>\n");
				print("<td width='20' class='rf-left'>&nbsp;</td>\n");
				print("<td width='600' class='rf-bg' align='left'><span style='color:#ff0000'>An error was encountered while attempting to process this referral. Please " .
							 "ensure that you have completed ALL required fields and resubmit the form.  Missing fields, or those with invalid entries are shown below in " .
							 "<span style='color:#ff0000'><b>RED</b></span>. If the error continues, please contact the <a href='mailto:webmaster@vocationalassessments.com'>Website " .
							 "Administrator</a>.<br />&nbsp;</td>\n");
				print("<td width='20' class='rf-right'>&nbsp;</td>\n");
				print("</tr>\n");
			}
		?>
  	<tr>
    	<td width='20' class='rf-left'>&nbsp;</td>
      <td width='600' class='rf-bg' align='left'>
      	<table width='600' cellspacing='0' cellpadding='0' style='border: 1px solid #C0C0C0;'>
        	<tr>
          	<td>
            	<table width='600' cellspacing='0' cellpadding='2' border='0'>
              	<tr>
                	<td class='rf-bg' colspan='15' width='600' style='border-bottom: 1px solid #c0c0c0;'>Please fill in the fields contained in the form shown below.  Items that are
                  <span style='text-decoration:underline;'>underlined</span> are <span style='text-decoration:underline;'>required</span> items.<br />&nbsp;</td>
                </tr>
                <form name='ref_form' action='./ref_submit.php' method='post'>
                <?php
									if (isset($_REQUEST['clid'])) {
										$clid = $_REQUEST['clid'];
									} 
									print("<input type='hidden' name='client_id' value='" . $clid . "' />\n");
								?>
                <tr>
                	<td class='rf-label' colspan='3' width='120' align='left' style='border-bottom: 1px solid #c0c0c0;'><span style='text-decoration:underline'><?php if (isset($_SESSION['badReferDate'])) { print("<span style='color:#FF0000'>Date:</span>"); } else { print("Date:"); } ?></span>&nbsp;
                  <?php print("<input type='text' class='rf-input' name='ref_date' id='ref_date' value='" . date('Y-m-d') . "' maxlength='10' size='12' /></td>\n"); ?>
                  <?php
									//		foreach ($_REQUEST as $ind=>$value) {
									//			print("$ind:  $value<br />");
									//		}
									//		foreach ($_SESSION as $ind=>$value) {
									//			print("$ind:  $value<br />");
									//		}
									?>
                   <td width='40' style='border-bottom: 1px solid #c0c0c0;'>&nbsp;</td>
                  <td class='rf-label' colspan='11' width='440' align='right' style='border-bottom: 1px solid #c0c0c0;'><span style='text-decoration:underline'><?php if (isset($_SESSION['badRefLoc'])) { print("<span style='color:#ff0000'>Location of Testing:</span>"); } else { print("Location of Testing:"); } ?></span>&nbsp;
                  	<select class='rf-input' name='ref_loc' id='ref_loc'>
                    	<option value=''>-- Select One --</option>
											<?php
                        // Contains DB Connect info.  Variables used below are declared in this file.
                        include("../p2952x783E4/connect.php");
                        //connect to db server
                        $dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
                        if (!empty($dbconn)) {	
                          // select the database
                          $dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Could not connect to Database " . $strDatabase);
                                         
                          if ($dbinst) {		
                            $stmt = "select id,location from locations order by location";
                            $res = mysqli_query($dbconn,$stmt);
                            while ($dbrow = mysqli_fetch_array($res)) {
                              	print("<option value='" . $dbrow['id'] . "'");
								if (isset($_SESSION['refLoc']) && $_SESSION['refLoc'] == $dbrow['id']) {
									print(" selected >" . $dbrow['location'] . "</option>\n");
								} else {
									print(">" . $dbrow['location'] . "</option>\n");
								}
                            }
                            mysqli_free_result($res);
                          } // End if ($dbinst..
                        } // End if (!empty($dbconn...
                        // close db connection
                        mysqli_close($dbconn);
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                	<td width='40' class='rf-label' align='left'><span style='text-decoration:underline'>Name</span></td>
                	<td width='40' class='rf-label' align='right'><span style='text-decoration:underline'><?php if (isset($_SESSION['badRefLName'])) { print("<span style='color:#ff0000'>Last:</span>"); } else { print("Last:"); } ?></span>&nbsp;</td>
                  <td colspan='3' width='120' align='left'><input type='text' class='rf-input' name='ref_lname' size='25' maxlength='50' value="<?php if (isset($_SESSION['refLName'])) { print($_SESSION['refLName']); } ?>" /></td>
                	<td width='40' class='rf-label' align='right'><span style='text-decoration:underline'><?php if (isset($_SESSION['badRefFName'])) { print("<span style='color:#ff0000'>First:</span>"); } else { print("First:"); } ?></span>&nbsp;</td>
                  <td colspan='3' width='120' align='left'><input type='text' class='rf-input' name='ref_fname' size='25' maxlength='50' value="<?php if (isset($_SESSION['refFName'])) { print($_SESSION['refFName']); } ?>" /></td>
                	<td width='40' class='rf-label' align='right'>M.I.:&nbsp;</td>
                  <td colspan='2' width='80' align='left'><input type='text' class='rf-input' name='ref_mi' size='4' maxlength='1' value="<?php if (isset($_SESSION['refMI'])) { print($_SESSION['refMI']); } ?>" /></td>
                  <td colspan='3' width='120'>&nbsp;</td>
                </tr>
                <tr>
                	<td width='40' class='rf-label' align='left' style='border-bottom: 1px solid #c0c0c0;'><span style='text-decoration:underline'>Address</span></td>
                	<td width='40' class='rf-label' align='right' style='border-bottom: 1px solid #c0c0c0;'><span style='text-decoration:underline'><?php if (isset($_SESSION['badRefStreet'])) { print("<span style='color:#ff0000'>Street</span>"); } else { print("Street"); } ?></span>:&nbsp;</td>
                  <td colspan='3' width='120' align='left' style='border-bottom: 1px solid #c0c0c0;'><input type='text' class='rf-input' name='ref_street' size='25' maxlength='70' value="<?php if (isset($_SESSION['refStreet'])) { print($_SESSION['refStreet']); } ?>" /></td>
                	<td width='40' class='rf-label' align='right' style='border-bottom: 1px solid #c0c0c0;'><span style='text-decoration:underline'><?php if (isset($_SESSION['badRefCity'])) { print("<span style='color:#ff0000'>City</span>"); } else { print("City"); } ?></span>:&nbsp;</td>
                  <td colspan='3' width='120' align='left' style='border-bottom: 1px solid #c0c0c0;'><input type='text' class='rf-input' name='ref_city' size='25' maxlength='50' value="<?php if (isset($_SESSION['refCity'])) { print($_SESSION['refCity']); } ?>" /></td>
                	<td width='40' class='rf-label' align='right' style='border-bottom: 1px solid #c0c0c0;'><span style='text-decoration:underline'><?php if (isset($_SESSION['badRefState'])) { print("<span style='color:#ff0000'>State</span>"); } else { print("State"); } ?></span>:&nbsp;</td>
                  <td colspan='2' width='80' align='left' style='border-bottom: 1px solid #c0c0c0;'><input type='text' class='rf-input' name='ref_state' size='4' maxlength='2' value="<?php if (isset($_SESSION['refState'])) { print($_SESSION['refState']); } ?>" /></td>
                  <td width='40' class='rf-label' align='right' style='border-bottom: 1px solid #c0c0c0;'><span style='text-decoration:underline'><?php if (isset($_SESSION['badRefZip'])) { print("<span style='color:#ff0000'>Zip</span>"); } else { print("Zip"); } ?></span>:&nbsp;</td>
                  <td colspan='2' width='80' align='left' style='border-bottom: 1px solid #c0c0c0;'><input type='text' class='rf-input' name='ref_zip' size='10' maxlength='10' value="<?php if (isset($_SESSION['refZip'])) { print($_SESSION['refZip']); } ?>" /></td>
                </tr>
                <tr>
                  <td class='rf-label' colspan='4' width='160' align='left' style='border-bottom: 1px solid #c0c0c0;'>Living Independently:</td>
                	<td width='40' align='left' style='border-bottom: 1px solid #c0c0c0;'>
                  	<select name='ref_independent' class='rf-input'>
											<option value=''></option>
                    	<option value='YES' <?php if (isset($_SESSION['refIndependent']) && $_SESSION['refIndependent'] == 'YES') { print("selected"); } ?>>Yes</option>
                      <option value='NO' <?php if (isset($_SESSION['refIndependent']) && $_SESSION['refIndependent'] == 'NO') { print("selected"); } ?>>No</option>
                    </select>
                  </td>
                  <td class='rf-label' colspan='3' width='120' align='right' style='border-bottom: 1px solid #c0c0c0;'>Gender:&nbsp;</td>
                	<td width='40' align='left' style='border-bottom: 1px solid #c0c0c0;'>
                  	<select name='ref_gender' class='rf-input'>
											<option value=''></option>
                    	<option value='F' <?php if (isset($_SESSION['refGender']) && $_SESSION['refGender'] == 'F') { print("selected"); } ?>>Female</option>
                      <option value='M' <?php if (isset($_SESSION['refGender']) && $_SESSION['refGender'] == 'M') { print("selected"); } ?>>Male</option>
                    </select>
                  </td>
                  <td colspan='6' width='200' align='left' style='border-bottom: 1px solid #c0c0c0;'>&nbsp;</td>
                </tr>
								<tr>
                	<td class='rf-label' width='600' colspan='15' align='left' style='border-bottom: 1px solid #c0c0c0;'><a onClick="javascript:toggle('ref_edu_row','..');"><img src='<?php if (isset($_SESSION['refEdu'])) { print("../images/buttons/collapse.png"); } else { print("../images/buttons/expand.png"); } ?>' name='expand_ref_edu_row' id='expand_ref_edu_row' width='12' height='12' border='0' valign='bottom' /></a>&nbsp;&nbsp;Education</td>
                </tr> 
								<tr id='ref_edu_row' <?php if (!isset($_SESSION['refEdu'])) { print("style='display:none'"); } ?>>
                	<td width='200' colspan='5' class='rf-label' align='left' style='border-bottom: 1px solid #c0c0c0;'><span style='text-decoration:underline'><?php if (isset($_SESSION['badRefEdu'])) { print("<span style='color:#ff0000'>Highest Grade:</span>"); } else { print("Highest Grade:"); } ?></span>&nbsp;
										<select name='ref_edu' class='rf-input'>
											<option value=''></option>
											<option value='High School' <?php if (isset($_SESSION['refEdu']) && $_SESSION['refEdu'] == 'High School') { print("selected"); } ?>>High School Diploma</option>
											<option value='GED' <?php if (isset($_SESSION['refEdu']) && $_SESSION['refEdu'] == 'GED') { print("selected"); } ?>>GED</option>
											<option value='12th Grade' <?php if (isset($_SESSION['refEdu']) && $_SESSION['refEdu'] == '12th Grade') { print("selected"); } ?>>12th</option>
											<option value='11th Grade' <?php if (isset($_SESSION['refEdu']) && $_SESSION['refEdu'] == '11th Grade') { print("selected"); } ?>>11th</option>
											<option value='10th Grade' <?php if (isset($_SESSION['refEdu']) && $_SESSION['refEdu'] == '10th Grade') { print("selected"); } ?>>10th</option>
											<option value='9th Grade' <?php if (isset($_SESSION['refEdu']) && $_SESSION['refEdu'] == '9th Grade') { print("selected"); } ?>>9th</option>
											<option value='8th Grade' <?php if (isset($_SESSION['refEdu']) && $_SESSION['refEdu'] == '8th Grade') { print("selected"); } ?>>8th</option>
											<option value='7th Grade' <?php if (isset($_SESSION['refEdu']) && $_SESSION['refEdu'] == '7th Grade') { print("selected"); } ?>>7th</option>
											<option value='6th Grade' <?php if (isset($_SESSION['refEdu']) && $_SESSION['refEdu'] == '6th Grade') { print("selected"); } ?>>6th</option>
											<option value='5th Grade' <?php if (isset($_SESSION['refEdu']) && $_SESSION['refEdu'] == '5th Grade') { print("selected"); } ?>>5th</option>
											<option value='4th Grade' <?php if (isset($_SESSION['refEdu']) && $_SESSION['refEdu'] == '4th Grade') { print("selected"); } ?>>4th</option>
											<option value='3rd Grade' <?php if (isset($_SESSION['refEdu']) && $_SESSION['refEdu'] == '3rd Grade') { print("selected"); } ?>>3rd</option>
											<option value='2nd Grade' <?php if (isset($_SESSION['refEdu']) && $_SESSION['refEdu'] == '2nd Grade') { print("selected"); } ?>>2nd</option>
											<option value='1st Grade' <?php if (isset($_SESSION['refEdu']) && $_SESSION['refEdu'] == '1st Grade') { print("selected"); } ?>>1st</option>
										</select>
									</td>
                	<td width='80' colspan='2' class='rf-label' align='left' style='border-bottom: 1px solid #c0c0c0;'>&nbsp;</td>
                  <td class='rf-label' colspan='8' width='320' align='left' style='border-bottom: 1px solid #c0c0c0;'>Special Training:&nbsp;
										<select name='ref_spectrn' class='rf-input'>
											<option value=''></option>
											<option value='Advanced Graduate Degree' <?php if (isset($_SESSION['refSpecTrn']) && $_SESSION['refSpecTrn'] == 'Advanced Graduate Degree') { print("selected"); } ?>>Advanced Graduate Degree</option>
											<option value='Associates Degree' <?php if (isset($_SESSION['refSpecTrn']) && $_SESSION['refSpecTrn'] == 'Associates Degree') { print("selected"); } ?>>Associates Degree</option>
											<option value='Baccalaureate Degree' <?php if (isset($_SESSION['refSpecTrn']) && $_SESSION['refSpecTrn'] == 'Baccalaureate Degree') { print("selected"); } ?>>Baccalaureate Degree</option>
											<option value='Certificate Training' <?php if (isset($_SESSION['refSpecTrn']) && $_SESSION['refSpecTrn'] == 'Certificate Training') { print("selected"); } ?>>Certificate Training</option>
											<option value='College Training' <?php if (isset($_SESSION['refSpecTrn']) && $_SESSION['refSpecTrn'] == 'College Training') { print("selected"); } ?>>College Training</option>
											<option value='Graduate Degree' <?php if (isset($_SESSION['refSpecTrn']) && $_SESSION['refSpecTrn'] == 'Graduate Degree') { print("selected"); } ?>>Graduate Degree</option>
											<option value='Vocational Training' <?php if (isset($_SESSION['refSpecTrn']) && $_SESSION['refSpecTrn'] == 'Vocational Training') { print("selected"); } ?>>Vocational Training</option>
										</select>
									</td>
                </tr>
                <tr>
                	<td width='200' colspan='5' class='rf-label' align='left'><span style='text-decoration:underline'><?php if (isset($_SESSION['badRefPhone'])) { print("<span style='color:#ff0000'>Telephone:</span>"); } else { print("Telephone:"); } ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type='text' class='rf-input' name='ref_phone' size='18' maxlength='12' value="<?php if (isset($_SESSION['refPhone'])) { print($_SESSION['refPhone']); } ?>" />
									</td>
                	<td width='80' colspan='2' class='rf-label' align='left'>&nbsp;</td>
                  <td class='rf-label' colspan='8' width='320' align='left'><span style='text-decoration:underline'><?php if (isset($_SESSION['badRefPrefLang'])) { print("<span style='color:#ff0000'>Pref Language:</span>"); } else { print("Pref Language:"); } ?></span>&nbsp;
										<select name='ref_pref_lang' class='rf-input'>
											<option value=''></option>
											<option value='American Sign Language' <?php if (isset($_SESSION['refPrefLang']) && $_SESSION['refPrefLang'] == 'American Sign Language') { print("selected"); } ?>>American Sign Language</option>
											<option value='English' <?php if (isset($_SESSION['refPrefLang']) && $_SESSION['refPrefLang'] == 'English') { print("selected"); } ?>>English</option>
											<option value='English / Spanish' <?php if (isset($_SESSION['refPrefLang']) && $_SESSION['refPrefLang'] == 'English / Spanish') { print("selected"); } ?>>English / Spanish</option>
											<option value='Spanish' <?php if (isset($_SESSION['refPrefLang']) && $_SESSION['refPrefLang'] == 'Spanish') { print("selected"); } ?>>Spanish</option>
											<option value='Spanish / English' <?php if (isset($_SESSION['refPrefLang']) && $_SESSION['refPrefLang'] == 'Spanish / English') { print("selected"); } ?>>Spanish / English</option>
										</select>
									</td>
                </tr>
                <tr>
                	<td width='200' colspan='5' class='rf-label' align='left' style='border-bottom: 1px solid #c0c0c0;'><span style='text-decoration:underline'>Age:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type='text' class='rf-input' name='ref_age' size='18' maxlength='12' value="<?php if (isset($_SESSION['refAge'])) { print($_SESSION['refAge']); } ?>" />										
                  </td>
                	<td width='80' colspan='2' class='rf-label' align='left' style='border-bottom: 1px solid #c0c0c0;'>&nbsp;</td>
                  <td class='rf-label' colspan='8' width='320' align='left' style='border-bottom: 1px solid #c0c0c0;'><span style='text-decoration:underline'><?php if (isset($_SESSION['badRefTrans'])) { print("<span style='color:#ff0000'>Transportation:</span>"); } else { print("Transportation:"); } ?></span>&nbsp;
										<select name='ref_trans' class='rf-input'>
											<option value=''></option>
											<option value='Bicycle' <?php if (isset($_SESSION['refTrans']) && $_SESSION['refTrans'] == 'Bicycle') { print("selected"); } ?>>Bicycle</option>
											<option value='Family' <?php if (isset($_SESSION['refTrans']) && $_SESSION['refTrans'] == 'Family') { print("selected"); } ?>>Family</option>
											<option value='Friends' <?php if (isset($_SESSION['refTrans']) && $_SESSION['refTrans'] == 'Friends') { print("selected"); } ?>>Friends</option>
											<option value='None' <?php if (isset($_SESSION['refTrans']) && $_SESSION['refTrans'] == 'None') { print("selected"); } ?>>None</option>
											<option value='Personal Vehicle' <?php if (isset($_SESSION['refTrans']) && $_SESSION['refTrans'] == 'Personal Vehicle') { print("selected"); } ?>>Personal Vehicle</option>
											<option value='Public Transportation' <?php if (isset($_SESSION['refTrans']) && $_SESSION['refTrans'] == 'Public Transportation') { print("selected"); } ?>>Public Transportation</option>
											<option value='Walking' <?php if (isset($_SESSION['refTrans']) && $_SESSION['refTrans'] == 'Walking') { print("selected"); } ?>>Walking</option>
										</select>
									</td>
                </tr>
								<tr>
                	<td class='rf-label' width='600' colspan='15' align='left' style='border-bottom: 1px solid #c0c0c0;'><a onClick="javascript:toggle('ref_dis_row','..');"><img src='<?php if (isset($_SESSION['refPDis'])) { print("../images/buttons/collapse.png"); } else { print("../images/buttons/expand.png"); } ?>' name='expand_ref_dis_row' id='expand_ref_dis_row' width='12' height='12' border='0' valign='bottom' /></a>&nbsp;&nbsp;Disabilities</td>
                </tr>
                <tr id='ref_dis_row' <?php if (!isset($_SESSION['refPDis'])) { print("style='display:none'"); } ?>>
                	<td width='120' colspan='3' class='rf-label' align='right' style='border-bottom: 1px solid #c0c0c0;'><span style='text-decoration:underline'><?php if (isset($_SESSION['badRefPDis'])) { print("<span style='color:#ff0000'>Primary</span>"); } else { print("Primary"); } ?></span>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />Secondary:&nbsp;</td>
									<td width='480' colspan='12' class='rf-input' align='left' style='border-bottom: 1px solid #c0c0c0;'><input type='text' class='rf-input' name='ref_pdis' size='80' maxlength='80' value="<?php if (isset($_SESSION['refPDis'])) { print($_SESSION['refPDis']); } ?>" /><br />
										<input type='text' class='rf-input' name='ref_sdis' size='80' maxlength='80' value="<?php if (isset($_SESSION['refSDis'])) { print($_SESSION['refSDis']); } ?>" />
									</td>
                </tr>
								<tr>
                	<td class='rf-label' width='600' colspan='15' align='left' style='border-bottom: 1px solid #c0c0c0;'><a onClick="javascript:toggle('ref_comments_row','..');"><img src='<?php if (isset($_SESSION['refComments'])) { print("../images/buttons/collapse.png"); } else { print("../images/buttons/expand.png"); } ?>' name='expand_ref_comments_row' id='expand_ref_comments_row' width='12' height='12' border='0' valign='bottom' /></a>&nbsp;&nbsp;Comments</td>
                </tr>
								<tr id='ref_comments_row' <?php if (!isset($_SESSION['refComments'])) { print("style='display:none'"); } ?>>
                	<td class='rf-input' width='600' colspan='15' align='left' style='border-bottom: 1px solid #c0c0c0;'>Comments or information pertinent in assisting in determining this referral for appropriate services:<br />
                  	<textarea class='rf-input' name='ref_comments' cols='112' rows='2'><?php if (isset($_SESSION['refComments'])) { print($_SESSION['refComments']); } ?></textarea>
                  </td>
                </tr>
								<tr>
                	<td class='rf-label' width='600' colspan='15' align='left' style='border-bottom: 1px solid #c0c0c0;'><a onClick="javascript:toggle('ref_attach_row','..');"><img src='<?php if (isset($_SESSION['attaches']) && $_SESSION['attaches'] == 'yes') { print("../images/buttons/collapse.png"); } else { print("../images/buttons/expand.png"); } ?>' name='expand_ref_attach_row' id='expand_ref_attach_row' width='12' height='12' border='0' valign='bottom' /></a>&nbsp;&nbsp;Attachments</td>
                </tr>
								<tr id='ref_attach_row' <?php if ((isset($_SESSION['attaches']) && $_SESSION['attaches'] == 'no') || !isset($_SESSION['attaches'])) { print("style='display:none'"); } ?>>
                	<td class='rf-label' width='240' colspan='6' align='left' style='border-bottom: 1px solid #c0c0c0;'>Please send any appropriate documents:<br />
                  	<input type='checkbox' name='ref_attach_iwrp' <?php if (isset($_SESSION['refIWRP']) && $_SESSION['refIWRP'] == 'yes') { print("checked"); } ?>>&nbsp;IWRP (If Done)<br />
                    <input type='checkbox' name='ref_attach_prog_rpts' <?php if (isset($_SESSION['refProgReports']) && $_SESSION['refProgReports'] == 'yes') { print("checked"); } ?>>&nbsp;Progress Reports (Other Agency)<br />
                    <input type='checkbox' name='ref_attach_contact_rpts' <?php if (isset($_SESSION['refContactReports']) && $_SESSION['refContactReports'] == 'yes') { print("checked"); } ?>>&nbsp;Copies of Relevant Contact Reports
                  </td>
                	<td class='rf-label' width='120' colspan='3' align='left' style='border-bottom: 1px solid #c0c0c0;'><br />
                  	<input type='checkbox' name='ref_attach_med_rpts' <?php if (isset($_SESSION['refMedReports']) && $_SESSION['refMedReports'] == 'yes') { print("checked"); } ?>>&nbsp;Medical Reports<br />
                    <input type='checkbox' name='ref_attach_trans' <?php if (isset($_SESSION['refTranscripts']) && $_SESSION['refTranscripts'] == 'yes') { print("checked"); } ?>>&nbsp;Transcripts<br />
                    <input type='checkbox' name='ref_attach_soc_eval' <?php if (isset($_SESSION['refSocEval']) && $_SESSION['refSocEval'] == 'yes') { print("checked"); } ?>>&nbsp;Social Evaluation
                  </td>
                	<td class='rf-label' width='240' colspan='6' align='left' style='border-bottom: 1px solid #c0c0c0;'><br />
                  	<input type='checkbox' name='ref_attach_psych_eval' <?php if (isset($_SESSION['refPsychEval']) && $_SESSION['refPsychEval'] == 'yes') { print("checked"); } ?>>&nbsp;Psychological Evaluation<br />
                    <input type='checkbox' name='ref_attach_inf_release' <?php if (isset($_SESSION['refInfRelease']) && $_SESSION['refInfRelease'] == 'yes') { print("checked"); } ?>>&nbsp;Release of Information<br />
                    <input type='checkbox' name='ref_attach_other_chk' <?php if (isset($_SESSION['refOther']) && $_SESSION['refOther'] == 'yes') { print("checked"); } ?>>&nbsp;Other&nbsp;<input type='text' class='rf-input' name='ref_attach_other' value="<?php if (isset($_SESSION['refOtherDesc'])) { print($_SESSION['refOtherDesc']); } ?>" size='15' maxlength='35' />
                  </td>
                </tr>
                <tr>
                	<td class='rf-input' width='600' colspan='15' align='left'>Please be sure all appropriate vocational, <b>psychological, social, medical and
                  special diagnosis reports</b> are on this referral and submitted with this form. <span style='text-decoration:underline'>Include initial contact
                  form and appropriate CCRs.</span><br />&nbsp;</td>
                </tr>
                <tr>
                	<td width='240' colspan='6' class='rf-label' align='left'><span style='text-decoration:underline'><?php if (isset($_SESSION['badRefBy'])) { print("<span style='color:#ff0000'>Referred By:</span>"); } else { print("Referred By:"); } ?></span>&nbsp;&nbsp;										
                  	<input type='text' class='rf-input' name='ref_referred_by' size='35' maxlength='40' value="<?php if (isset($_SESSION['refBy'])) { print($_SESSION['refBy']); } ?>" />
									</td>
                  <td class='rf-label' colspan='3' width='120' align='right'><span style='text-decoration:underline'><?php if (isset($_SESSION['badRefOrg'])) { print("<span style='color:#ff0000'>Organization:</span>"); } else { print("Organization"); } ?></span>&nbsp;&nbsp;</td>
									<td class='rf-input' colspan='6' width='240' align='left'><input type='text' class='rf-input' name='ref_organization' size='30' maxlength='40' value="<?php if (isset($_SESSION['refOrg'])) { print($_SESSION['refOrg']); } ?>" /></td>
                </tr>
                <tr>
                	<td class='rf-label' width='120' colspan='3' align='right' style='border-bottom: 1px solid #c0c0c0;'>&nbsp;</td>
                  <td class='rf-label' width='240' colspan='6' align='right' style='border-bottom: 1px solid #c0c0c0;'><span style='text-decoration:underline'><?php if (isset($_SESSION['badRefStartDate'])) { print("<span style='color:#ff0000'>Date Scheduled to Start Evaluation:</span>"); } else { print("Date Scheduled to Start Evaluation:"); } ?></span>&nbsp;&nbsp;</td>
                  <td class='rf-input' width='240' colspan='6' align='left' style='border-bottom: 1px solid #c0c0c0;'><input type='text' class='rf-input' name='ref_start_date' size='30' maxlength='20' value="<?php if (isset($_SESSION['refStartDate'])) { print($_SESSION['refStartDate']); } ?>" /></td>
                </tr>
                <tr>
                	<td class='rf-input' width='600' colspan='15' align='left' style='border-bottom: 1px solid #c0c0c0;'>It has been our experience that each individual is referred for a vocational
                  evaluation for a unique set of reasons. Your completion of this form will help determine the specific reasons for the referral of this
                  person.<br />Please click on the + to the left of the Questions below to display these questions. <br />&nbsp;</td>
                </tr>
								<tr>
                	<td class='rf-label' width='600' colspan='15' align='left' style='border-bottom: 1px solid #c0c0c0;'><a onClick="javascript:toggle('ref_qs_row','..');"><img src='<?php if (isset($_SESSION['questions']) && $_SESSION['questions'] == 'yes') { print("../images/buttons/collapse.png"); } else { print("../images/buttons/expand.png"); } ?>' name='expand_ref_qs_row' id='expand_ref_qs_row' width='12' height='12' border='0' valign='bottom' /></a>&nbsp;&nbsp;Questions</td>
                </tr>
                <tr id='ref_qs_row' <?php if ((isset($_SESSION['questions']) && $_SESSION['questions'] == 'no') || !isset($_SESSION['questions'])) { print("style='display:none'"); } ?>>
									<td width='600' colspan='15' class='rf-input' align='left' style='border-bottom: 1px solid #c0c0c0;'>
										<b>CHECK ONLY THOSE QUESTIONS YOU MAY HAVE CONCERNING THIS CLIENT</b><br />
                    <input type='checkbox' name='ref_q1' <?php if (isset($_SESSION['refQ1']) && $_SESSION['refQ1'] == 'yes') { print("checked"); } ?>>&nbsp;1. Could this person fulfill a vocational role and at which level?<br /> 
                    <input type='checkbox' name='ref_q2' <?php if (isset($_SESSION['refQ2']) && $_SESSION['refQ2'] == 'yes') { print("checked"); } ?>>&nbsp;2. Do you recommend a formal skill-training program?<br />
                    <input type='checkbox' name='ref_q3' <?php if (isset($_SESSION['refQ3']) && $_SESSION['refQ3'] == 'yes') { print("checked"); } ?>>&nbsp;3. What jobs are available in the local area that this person can perform?<br />
                    <input type='checkbox' name='ref_q4' <?php if (isset($_SESSION['refQ4']) && $_SESSION['refQ4'] == 'yes') { print("checked"); } ?>>&nbsp;4. Would this person's job interest(s) be feasible goal(s)? Why?<br />
                    <input type='checkbox' name='ref_q5' <?php if (isset($_SESSION['refQ5']) && $_SESSION['refQ5'] == 'yes') { print("checked"); } ?>>&nbsp;5. What disability-related limitaions make it difficult for this person to work?<br />
                    <input type='checkbox' name='ref_q6' <?php if (isset($_SESSION['refQ6']) && $_SESSION['refQ6'] == 'yes') { print("checked"); } ?>>&nbsp;6. Do there seem to be any medical or physical limitations, not previously reported, which appear to limit vocational functioning?<br />
                    <input type='checkbox' name='ref_q7' <?php if (isset($_SESSION['refQ7']) && $_SESSION['refQ7'] == 'yes') { print("checked"); } ?>>&nbsp;7. What general accommodations will enhance this person's ability to work?<br />
                    <input type='checkbox' name='ref_q8' <?php if (isset($_SESSION['refQ8']) && $_SESSION['refQ8'] == 'yes') { print("checked"); } ?>>&nbsp;8. What behaviors may make it difficult for this person to keep a job?<br />
                    <input type='checkbox' name='ref_q9' <?php if (isset($_SESSION['refQ9']) && $_SESSION['refQ9'] == 'yes') { print("checked"); } ?>>&nbsp;9. What seems to be reasons for this person to appear unmotivated toward work/rehabilitation?<br />&nbsp;<br />
                    <b>Transferrable Skills Analysis</b><br />
                    <input type='checkbox' name='ref_tsa' <?php if (isset($_SESSION['refTSA']) && $_SESSION['refTSA'] == 'yes') { print("checked"); } ?>>&nbsp;What are the transferrable job skills which are useable in the current job market? (Additional Charges Apply)<br />&nbsp;<br />
                    <b>Other Specific Referral Questions:<br />
                    <textarea class='rf-input' name='ref_oth_qs' cols='110' rows='4'><?php if (isset($_SESSION['refOtherQs'])) { print($_SESSION['refOtherQs']); } ?></textarea><br />&nbsp;<br />
                    
									</td>
                </tr>
                <tr>
                	<td class='rf-input' width='600' colspan='15' align='center' style='border-bottom: 1px solid #c0c0c0;'>
                  	<b>PLEASE ANSWER ALL THE FOLLOWING QUESTIONS.</b>
                  </td>
                </tr>
                <tr>
                	<td class='rf-input' width='600' colspan='15' align='center' style='border-bottom: 1px solid #c0c0c0;'>
                  	<?php if (isset($_SESSION['badRefMandQ1'])) { print("<span style='color:#ff0000'>What job interests have you discussed with this person?</span>"); } else { print("What job interests have you discussed with this person?"); } ?><br />
                    <textarea class='rf-input' name='ref_mand_q1' cols='110' rows='4'><?php if (isset($_SESSION['refMandQ1'])) { print($_SESSION['refMandQ1']); } ?></textarea><br />&nbsp;<br />
                  </td>
                </tr>
                <tr>
                	<td class='rf-input' width='600' colspan='15' align='center' style='border-bottom: 1px solid #c0c0c0;'>
                  	<?php 
											if (isset($_SESSION['badRefMandQ2'])) { 
												print("<span style='color:#ff0000'>Are work opportunities limited in this area? If this person wishes to remain in the geographical area, what opportunities are available?</span>");
											} else {
												print("Are work opportunities limited in this area? If this person wishes to remain in the geographical area, what opportunities are available?");
											}
										?><br />
                    <textarea class='rf-input' name='ref_mand_q2' cols='110' rows='4'><?php if (isset($_SESSION['refMandQ2'])) { print($_SESSION['refMandQ2']); } ?></textarea><br />&nbsp;<br />
                  </td>
                </tr>
               <tr>
                	<td class='rf-input' width='600' colspan='15' align='center' style='border-bottom: 1px solid #c0c0c0;'>
                  	<?php 
											if (isset($_SESSION['badRefMandQ3'])) { 
												print("<span style='color:#ff0000'>State any other specific reasons you have for referring this client for vocational evaluation.</span>");
											} else {
												print("State any other specific reasons you have for referring this client for vocational evaluation.");
											}
										?><br />
                    <textarea class='rf-input' name='ref_mand_q3' cols='110' rows='4'></textarea><br />&nbsp;<br />
                  </td>
                </tr>
                <tr>
                	<td class='rf-input' width='600' colspan='15' align='center' style='border-bottom: 1px solid #c0c0c0;'>
										<input class='rf-input' type='submit' value='Submit' name='submit' />
                    <input class='rf-input' type='reset' value='Reset Form' name='reset' />
                  </td>
                </tr>
                <tr>
                	<td class='rf-input' width='600' colspan='15' align='center' style='border-bottom: 1px solid #c0c0c0;'>
                  	If you have any questions, please call <b>VIP Services</b> to clarify any information.
                  </td>
                </tr>
                <tr>
                	<td width='40'>&nbsp;</td>
                	<td width='40'>&nbsp;</td>
                	<td width='40'>&nbsp;</td>
                	<td width='40'>&nbsp;</td>
                	<td width='40'>&nbsp;</td>
                	<td width='40'>&nbsp;</td>
                	<td width='40'>&nbsp;</td>
                	<td width='40'>&nbsp;</td>
                	<td width='40'>&nbsp;</td>
                	<td width='40'>&nbsp;</td>
                	<td width='40'>&nbsp;</td>
                	<td width='40'>&nbsp;</td>
                	<td width='40'>&nbsp;</td>
                	<td width='40'>&nbsp;</td>
                	<td width='40'>&nbsp;</td>
                </tr>
                </form>  
              </table>
            </td>
          </tr>
        </table>
      </td>
      <td width='20' class='rf-right'>&nbsp;</td>
    </tr>
		<tr>
			<td width='20' id='rf-bl'>&nbsp;</td>
			<td width='600' id='rf-bot'>&nbsp;</td>
			<td width='20' id='rf-br'>&nbsp;</td>
		</tr>
  
  </table>
<div align="left">
<hr width="50%" align="left" title="Copyright, Contact and Page Information Section">
<div align="left">
 	<?php include("../includes/nav_sub.inc"); ?>
	<?php include("../includes/address.inc"); ?>
</div>
</div>
</body> </html>



