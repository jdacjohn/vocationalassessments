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
    [ <?php print("<a href='./show_referral2.php?clid=" . $_POST['clid'] . "&locDateId=" . $_POST['locDateId'] . "'>Printer-Friendly</a>\n"); ?> ]
   </div>
	<table width="640" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width='20' id='rf-tl'>&nbsp;</td>
			<td width='600' id='rf-top'>&nbsp;</td>
			<td width='20' id='rf-tr'>&nbsp;</td>
		</tr>
    <tr>
    	<td width='20' class='rf-left'>&nbsp;</td>
      <td width='600' class='rf-bg' align='center'><refh1>VIP Services</refh1></td>
      <td width='20' class='rf-right'>&nbsp;</td>
   	</tr>
		<tr>
    	<td width='20' class='rf-left'>&nbsp;</td>
      <td width='600' class='rf-bg' align='center'><refAddress>P.O. Box 818</refAddress></td>
      <td width='20' class='rf-right'>&nbsp;</td>
   	</tr>
		<tr>
    	<td width='20' class='rf-left'>&nbsp;</td>
      <td width='600' class='rf-bg' align='center'><refAddress>Clyde, Texas 79510-0818</refAddress></td>
      <td width='20' class='rf-right'>&nbsp;</td>
   	</tr>
		<tr>
    	<td width='20' class='rf-left'>&nbsp;</td>
      <td width='600' class='rf-bg' align='center'><refAddress>(325) 893-3361&nbsp;&nbsp;&nbsp;(940) 368-9032</refAddress></td>
      <td width='20' class='rf-right'>&nbsp;</td>
   	</tr>
		<tr>
    	<td width='20' class='rf-left'>&nbsp;</td>
      <td width='600' class='rf-bg' align='center'><refAddress>Vendor ID: 17525221655000</refAddress><br />&nbsp;</td>
      <td width='20' class='rf-right'>&nbsp;</td>
   	</tr>
    <tr>
    	<td width='20' class='rf-left'>&nbsp;</td>
      <td width='600' class='rf-bg' align='center'><refh2>Referral Form for TRC</refh2></td>
      <td width='20' class='rf-right'>&nbsp;</td>
   	</tr>
    <tr>
    	<td width='20' class='rf-left'>&nbsp;</td>
      <td width='600' class='rf-bg' align='center'><refh2>Vocational Evaluation Program</refh2></td>
      <td width='20' class='rf-right'>&nbsp;</td>
   	</tr>
  	<tr>
    	<td width='20' class='rf-left'>&nbsp;</td>
      <td width='600' class='rf-bg' align='left'>
			<?php
        // Contains DB Connect info.  Variables used below are declared in this file.
        include("../p2952x783E4/connect.php");
        //connect to db server
        $dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
        if (!empty($dbconn)) {	
          // select the database
          $dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Could not connect to Database " . $strDatabase);
                         
          if ($dbinst) {		
            $stmt = "select * from referrals where client_id = " . $_POST['clid'];
            $res = mysqli_query($dbconn,$stmt);
			if ($res) {
				$dbrow = mysqli_fetch_array($res);
			} else {
				header("Location: ./show_ref_error.php?errmsg=1");
			}
            mysqli_free_result($res);
          } // End if ($dbinst..
        } // End if (!empty($dbconn...
        // close db connection
        mysqli_close($dbconn);
      ?>

      	<table width='600' cellspacing='0' cellpadding='0' style='border: 1px solid #C0C0C0;'>
        	<tr>
          	<td>
            	<table width='600' cellspacing='0' cellpadding='2' border='0'>
								<tr>
                	<td class='rf-label' width='600' colspan='15' align='left' style='border-bottom: 1px solid #c0c0c0;'>General Information</td>
                </tr> 
                <tr>
                	<td class='rf-show-label' colspan='3' width='120' align='left' style='border-bottom: 1px solid #c0c0c0;'>Date:&nbsp;<span class='rf-show-value'><?php print(substr($dbrow['refer_date'],0,10)); ?></span></td>
                  <td width='40' style='border-bottom: 1px solid #c0c0c0;'>&nbsp;</td>
									<?php
                    // Contains DB Connect info.  Variables used below are declared in this file.
                    include("../p2952x783E4/connect.php");
                    //connect to db server
                    $dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
                    if (!empty($dbconn)) {	
                      // select the database
                      $dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Could not connect to Database " . $strDatabase);
                                     
                      if ($dbinst) {		
                        $stmt2 = "select location from locations where id = " . $dbrow['location'];
                        $res2 = mysqli_query($dbconn,$stmt2);
						if ($res2) {
							$dbrow2 = mysqli_fetch_array($res2);
						} else {
							header("location: ./show_ref_error.php?errmsg=2");
						}
                        mysqli_free_result($res2);
                      } // End if ($dbinst..
                    } // End if (!empty($dbconn...
                    // close db connection
                    mysqli_close($dbconn);
                  ?>
                  <td class='rf-show-label' colspan='11' width='440' align='right' style='border-bottom: 1px solid #c0c0c0;'>Location of Testing:&nbsp;<span class='rf-show-value'><?php print($dbrow2['location']); ?></span></td>
                </tr>
                <tr>
                	<td class='rf-show-label' width='40' align='left'>Name</td>
                	<td class='rf-show-label' width='40' align='right'>Last:&nbsp;</td>
                  <td class='rf-show-value' colspan='3' width='120' align='left'><?php print($dbrow['lname']); ?></td>
                	<td class='rf-show-label' width='40' align='right'>First:&nbsp;</td>
                  <td class='rf-show-value' colspan='3' width='120' align='left'><?php print($dbrow['fname']); ?></td>
                	<td class='rf-show-label' width='40' align='right'>M.I.:&nbsp;</td>
                  <td class='rf-show-value' colspan='2' width='80' align='left'><?php print($dbrow['mi']); ?></td>
                  <td colspan='3' width='120'>&nbsp;</td>
                </tr>
                <tr>
                	<td class='rf-show-label' width='40' align='left' style='border-bottom: 1px solid #c0c0c0;'>Address:</td>
                	<td class='rf-show-label' width='40' align='right' style='border-bottom: 1px solid #c0c0c0;'>Street:&nbsp;</td>
                  <td class='rf-show-value' colspan='3' width='120' align='left' style='border-bottom: 1px solid #c0c0c0;'><?php print($dbrow['street']); ?></td>
                	<td class='rf-show-label' width='40' align='right' style='border-bottom: 1px solid #c0c0c0;'>City:&nbsp;</td>
                  <td class='rf-show-value' colspan='3' width='120' align='left' style='border-bottom: 1px solid #c0c0c0;'><?php print($dbrow['city']); ?></td>
                	<td class='rf-show-label' width='40' align='right' style='border-bottom: 1px solid #c0c0c0;'>State:&nbsp;</td>
                  <td class='rf-show-value' colspan='2' width='80' align='left' style='border-bottom: 1px solid #c0c0c0;'><?php print($dbrow['state']); ?></td>
                  <td class='rf-show-label' width='40' align='right' style='border-bottom: 1px solid #c0c0c0;'>Zip:&nbsp;</td>
                  <td class='rf-show-value' colspan='2' width='80' align='left' style='border-bottom: 1px solid #c0c0c0;'><?php print($dbrow['zipcode']); ?></td>
                </tr>
                <tr>
                  <td class='rf-show-label' colspan='4' width='160' align='left' style='border-bottom: 1px solid #c0c0c0;'>Living Independently:</td>
                	<td class='rf-show-value' width='40' align='left' style='border-bottom: 1px solid #c0c0c0;'><?php print($dbrow['independent']); ?></td>
                  <td class='rf-show-label' colspan='3' width='120' align='right' style='border-bottom: 1px solid #c0c0c0;'>Gender:&nbsp;</td>
                	<td class='rf-show-value' width='40' align='left' style='border-bottom: 1px solid #c0c0c0;'><?php if ($dbrow['sex'] == 'm') { print("Male"); } else { print("Female"); } ?></td>
                  <td colspan='6' width='200' align='left' style='border-bottom: 1px solid #c0c0c0;'>&nbsp;</td>
                </tr>
                <tr>
                	<td class='rf-show-label' width='200' colspan='5' align='left'>Telephone:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='rf-show-value'><?php print($dbrow['telephone']); ?></span></td>
                	<td class='rf-show-label' width='80' colspan='2' align='left'>&nbsp;</td>
                  <td class='rf-show-label' colspan='8' width='320' align='left'>Language Pref:&nbsp;<span class='rf-show-value'><?php print($dbrow['language']); ?></span></td>
                </tr>
                <tr>
                	<td class='rf-show-label' width='200' colspan='5' align='left' style='border-bottom: 1px solid #c0c0c0;'>Age:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='rf-show-value'><?php print($dbrow['age']); ?></span></td>
                	<td class='rf-show-label' width='80' colspan='2' align='left' style='border-bottom: 1px solid #c0c0c0;'>&nbsp;</td>
                  <td class='rf-show-label' colspan='8' width='320' align='left' style='border-bottom: 1px solid #c0c0c0;'>Transportation:&nbsp;<span class='rf-show-value'><?php print($dbrow['transportation']); ?></span></td>
                </tr>
								<tr>
                	<td class='rf-label' width='600' colspan='15' align='left' style='border-bottom: 1px solid #c0c0c0;'>Education</td>
                </tr> 
								<tr>
                	<td class='rf-show-label' width='200' colspan='5' align='left' style='border-bottom: 1px solid #c0c0c0;'>Highest Grade:&nbsp;<span class='rf-show-value'><?php print($dbrow['education']); ?></span></td>
                	<td class='rf-show-label' width='80' colspan='2' align='left' style='border-bottom: 1px solid #c0c0c0;'>&nbsp;</td>
                  <td class='rf-show-label' colspan='8' width='320' align='left' style='border-bottom: 1px solid #c0c0c0;'>Special Training:&nbsp;<span class='rf-show-value'><?php print($dbrow['special_training']); ?></span></td>
                </tr>
								<tr>
                	<td class='rf-label' width='600' colspan='15' align='left' style='border-bottom: 1px solid #c0c0c0;'>Disabilities</td>
                </tr>
                <tr>
                	<td class='rf-show-label' width='120' colspan='3' align='right' style='border-bottom: 1px solid #c0c0c0;'>Primary:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />Secondary:&nbsp;&nbsp;</td>
									<td class='rf-show-value' width='480' colspan='12' align='left' style='border-bottom: 1px solid #c0c0c0;'><?php print($dbrow['pdisability']); ?><br /><?php print($dbrow['sdisability']); ?></td>
                </tr>
								<tr>
                	<td class='rf-label' width='600' colspan='15' align='left' style='border-bottom: 1px solid #c0c0c0;'>Comments</td>
                </tr>
								<tr>
                	<td class='rf-show-label' width='600' colspan='15' align='left' style='border-bottom: 1px solid #c0c0c0;'>(Comments or information pertinent in assisting in determining this referral for appropriate services:)<br />
                  	<span class='rf-show-value'><?php print($dbrow['comments']); ?></span><br />&nbsp;
                  </td>
                </tr>
								<tr>
                	<td class='rf-label' width='600' colspan='15' align='left' style='border-bottom: 1px solid #c0c0c0;'>Attachments</td>
                </tr>
								<tr>
                	<td class='rf-show-label' width='240' colspan='6' align='left' style='border-bottom: 1px solid #c0c0c0;'>Please send any appropriate documents:<br />
                  	<input type='checkbox' disabled name='ref_attach_iwrp' <?php if ($dbrow['iwrp'] == 'yes') { print("checked"); } ?>>&nbsp;IWRP (If Done)<br />
                    <input type='checkbox' disabled name='ref_attach_prog_rpts' <?php if ($dbrow['prog_rpts'] == 'yes') { print("checked"); } ?>>&nbsp;Progress Reports (Other Agency)<br />
                    <input type='checkbox' disabled name='ref_attach_contact_rpts' <?php if ($dbrow['contact_rpts'] == 'yes') { print("checked"); } ?>>&nbsp;Copies of Relevant Contact Reports
                  </td>
                	<td class='rf-show-label' width='120' colspan='3' align='left' style='border-bottom: 1px solid #c0c0c0;'><br />
                  	<input type='checkbox' disabled name='ref_attach_med_rpts' <?php if ($dbrow['med_rpts'] == 'yes') { print("checked"); } ?>>&nbsp;Medical Reports<br />
                    <input type='checkbox' disabled name='ref_attach_trans' <?php if ($dbrow['transcripts'] == 'yes') { print("checked"); } ?>>&nbsp;Transcripts<br />
                    <input type='checkbox' disabled name='ref_attach_soc_eval' <?php if ($dbrow['soc_eval'] == 'yes') { print("checked"); } ?>>&nbsp;Social Evaluation
                  </td>
                	<td class='rf-show-label' width='240' colspan='6' align='left' style='border-bottom: 1px solid #c0c0c0;'><br />
                  	<input type='checkbox' disabled name='ref_attach_psych_eval' <?php if ($dbrow['psych_eval'] == 'yes') { print("checked"); } ?>>&nbsp;Psychological Evaluation<br />
                    <input type='checkbox' disabled name='ref_attach_inf_release' <?php if ($dbrow['inf_release'] == 'yes') { print("checked"); } ?>>&nbsp;Release of Information<br />
                    <input type='checkbox' disabled name='ref_attach_other_chk' <?php if ($dbrow['attach_other'] == 'yes') { print("checked"); } ?>>&nbsp;Other:&nbsp;<span class='rf-show-value'><?php print($dbrow['attach_other_desc']); ?></span>
                  </td>
                </tr>
                <tr>
                	<td class='rf-show-label' width='600' colspan='15' align='left'>Please be sure all appropriate vocational, <b>psychological, social, medical and
                  special diagnosis reports</b> are on this referral and submitted with this form. <span style='text-decoration:underline'>Include initial contact
                  form and appropriate CCRs.</span><br />&nbsp;</td>
                </tr>
                <tr>
                	<td class='rf-show-label' width='240' colspan='6' align='left'>Referred By:&nbsp;&nbsp;<span class='rf-show-value'><?php print($dbrow['ref_by']); ?></span></td>
                  <td class='rf-show-label' colspan='3' width='120' align='right'>Organization:&nbsp;&nbsp;</td>
									<td class='rf-show-value' colspan='6' width='240' align='left'><span class='rf-show-value'><?php print($dbrow['organization']); ?></span></td>
                </tr>
                <tr>
                	<td class='rf-show-label' width='120' colspan='3' align='right' style='border-bottom: 1px solid #c0c0c0;'>&nbsp;</td>
                  <td class='rf-show-label' width='240' colspan='6' align='right' style='border-bottom: 1px solid #c0c0c0;'>Date Scheduled to Start Evaluation:&nbsp;&nbsp;</td>
                  <td class='rf-show-value' width='240' colspan='6' align='left' style='border-bottom: 1px solid #c0c0c0;'><?php print($dbrow['eval_start_date']); ?></td>
                </tr>
                <tr>
                	<td class='rf-show-label' width='600' colspan='15' align='left' style='border-bottom: 1px solid #c0c0c0;'>It has been our experience that each individual is referred for a vocational
                  evaluation for a unique set of reasons. Your completion of this form will help determine the specific reasons for the referral of this
                  person.<br />&nbsp;</td>
                </tr>
								<tr>
                	<td class='rf-label' width='600' colspan='15' align='left' style='border-bottom: 1px solid #c0c0c0;'>Questions Concerning This Client</td>
                </tr>
                <tr>
									<td class='rf-show-label' width='600' colspan='15' align='left' style='border-bottom: 1px solid #c0c0c0;'>
                    <input type='checkbox' disabled name='ref_q1' <?php if ($dbrow['ref_q1'] == 'yes') { print("checked"); } ?>>&nbsp;1. Could this person fulfill a vocational role and at which level?<br /> 
                    <input type='checkbox' disabled name='ref_q2' <?php if ($dbrow['ref_q2'] == 'yes') { print("checked"); } ?>>&nbsp;2. Do you recommend a formal skill-training program?<br />
                    <input type='checkbox' disabled name='ref_q3' <?php if ($dbrow['ref_q3'] == 'yes') { print("checked"); } ?>>&nbsp;3. What jobs are available in the local area that this person can perform?<br />
                    <input type='checkbox' disabled name='ref_q4' <?php if ($dbrow['ref_q4'] == 'yes') { print("checked"); } ?>>&nbsp;4. Would this person's job interest(s) be feasible goal(s)? Why?<br />
                    <input type='checkbox' disabled name='ref_q5' <?php if ($dbrow['ref_q5'] == 'yes') { print("checked"); } ?>>&nbsp;5. What disability-related limitaions make it difficult for this person to work?<br />
                    <input type='checkbox' disabled name='ref_q6' <?php if ($dbrow['ref_q6'] == 'yes') { print("checked"); } ?>>&nbsp;6. Do there seem to be any medical or physical limitations, not previously reported, which appear to limit vocational functioning?<br />
                    <input type='checkbox' disabled name='ref_q7' <?php if ($dbrow['ref_q7'] == 'yes') { print("checked"); } ?>>&nbsp;7. What general accommodations will enhance this person's ability to work?<br />
                    <input type='checkbox' disabled name='ref_q8' <?php if ($dbrow['ref_q8'] == 'yes') { print("checked"); } ?>>&nbsp;8. What behaviors may make it difficult for this person to keep a job?<br />
                    <input type='checkbox' disabled name='ref_q9' <?php if ($dbrow['ref_q9'] == 'yes') { print("checked"); } ?>>&nbsp;9. What seems to be reasons for this person to appear unmotivated toward work/rehabilitation?<br />&nbsp;<br />
                    <b>Transferrable Skills Analysis</b><br />
                    <input type='checkbox' disabled name='ref_tsa' <?php if ($dbrow['ref_tsa'] == 'yes') { print("checked"); } ?>>&nbsp;What are the transferrable job skills which are useable in the current job market? (Additional Charges Apply)<br />&nbsp;<br />
                    <b>Other Specific Referral Questions:</b><br />&nbsp;<br />
                    <span class='rf-show-value'><?php print($dbrow['ref_oth_qs']); ?></span><br />&nbsp;<br />
                    
									</td>
                </tr>
                <tr>
                	<td class='rf-input' width='600' colspan='15' align='center' style='border-bottom: 1px solid #c0c0c0;'>
                  	<b>PLEASE ANSWER ALL THE FOLLOWING QUESTIONS.</b>
                  </td>
                </tr>
                <tr>
                	<td class='rf-show-label' width='600' colspan='15' align='left' style='border-bottom: 1px solid #c0c0c0;'>
                  	1. What job interests have you discussed with this person?<br />&nbsp;<br />
                    &nbsp;&nbsp;&nbsp;&nbsp;<span class='rf-show-value'><?php print($dbrow['ref_mand_q1']); ?></span><br />&nbsp;<br />
                  </td>
                </tr>
                <tr>
                	<td class='rf-show-label' width='600' colspan='15' align='left' style='border-bottom: 1px solid #c0c0c0;'>
                  	2. Are work opportunities limited in this area? If this person wishes to remain in the geographical area, what opportunities are available?<br />&nbsp;<br />
										&nbsp;&nbsp;&nbsp;&nbsp;<span class='rf-show-value'><?php print($dbrow['ref_mand_q2']); ?></span><br />&nbsp;<br />
                  </td>
                </tr>
               <tr>
                	<td class='rf-show-label' width='600' colspan='15' align='left' style='border-bottom: 1px solid #c0c0c0;'>
                  	3. State any other specific reasons you have for referring this client for vocational evaluation.<br />&nbsp;<br />
                    &nbsp;&nbsp;&nbsp;&nbsp;<span class='rf-show-value'><?php print($dbrow['ref_mand_q3']); ?></span><br />&nbsp;<br />
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



