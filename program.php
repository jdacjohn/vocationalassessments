<html>
 <head>
  <meta name="generator" content="HTML Tidy, see www.w3.org">
  <title>Program - Vocational Assessments</title>
  <link rel="STYLESHEET" href="./css/vip.css">
	<!-- metatags if needed -->
	<?php 
		include('./includes/metak.inc');
  	include('./includes/metad.inc');
	?>

 </head>

 <body>
  <table border="0" cellspacing="0" cellpadding="0" style="background-color: white;">
   <tr>
    <td width="123" align="LEFT" valign="TOP">
     <table cellpadding="0" cellspacing="0" border="0" style="margin-top: 0.5em;">
      <tr>
       <td><img alt="" src="./images/sidebar_1.gif" width="123" height="11"></td>
      </tr>

      <tr>
       <td><img alt="" src="./images/sidebar_logo.gif" width="123" height="95" border="0" usemap="#map1"></td>
      </tr>

      <tr>
       <td><img alt="" src="./images/sidebar_program.gif" width="123" height="28" border="0" usemap="#map2"></td>
      </tr>

      <tr>
       <td><img alt="" src="./images/sidebar_staff.gif" width="123" height="28" border="0" usemap="#map3"></td>
      </tr>

      <tr>
       <td><img alt="" src="./images/sidebar_links.gif" width="123" height="26" border="0" usemap="#map4"></td>
      </tr>

      <tr>
       <td><img alt="" src="./images/sidebar_services.gif" width="123" height="28" border="0" usemap="#map5"></td>
      </tr>

      <tr>
       <td><img alt="" src="./images/sidebar_home.gif" width="123" height="27" border="0" usemap="#map6"></td>
      </tr>

      <tr>
       <td><img alt="" src="./images/sidebar_7.gif" width="123" height="184"></td>
      </tr>
     </table>
     <map name="map1">
      <area shape="RECT" coords="0,0,123,95" href="index.php" alt="VIP Services">
     </map> <map name="map2">
      <area shape="RECT" coords="0,0,123,28" href="program.php" alt="Our Program">
     </map> <map name="map3">
      <area shape="RECT" coords="0,0,123,28" href="staff.php" alt="Staff">
     </map> <map name="map4">
      <area shape="RECT" coords="0,0,123,26" href="links.php" alt="Links">
     </map> <map name="map5">
      <area shape="RECT" coords="0,0,123,28" href="services.php" alt="Services">
     </map> <map name="map6">
      <area shape="RECT" coords="0,0,123,27" href="index.php" alt="Home Page">
     </map>
    </td>

    <td valign="TOP">
     <table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
       <td width="487">
        <table border="0" cellspacing="0" cellpadding="0" width="100%">
         <tr>
          <td align="CENTER"><br>
          <img src="./images/banner_vocational_assessments.gif" alt="Vocational Associates" width="157" height="39" border="0"></td>

          <td align="RIGHT" valign="BOTTOM">
           <table border="0" cellspacing="0" cellpadding="0">
            <tr>
             <td><a href="locations.php"><img src="./images/btn_top_locations.gif" alt="Locations" width="70" height="32" border="0"></a></td>

             <td><a href="contact.php"><img src="./images/btn_top_contact.gif" alt="Contact Us" width="70" height="32" border="0"></a></td>

             <td><a href="index.php"><img src="./images/btn_top_home.gif" alt="Home" width="70" height="32" border="0"></a></td>
            </tr>
           </table>
          </td>
         </tr>
        </table>
       </td>

       <td width="10">&nbsp;</td>
      </tr>

      <tr>
       <td colspan="2" class="silverbar">
        <h2>VIP Program</h2>
       </td>
      </tr>

      <tr>
       <td valign="TOP" width="487">
        <h3>What is Vocational Evaluation?</h3>
	<h4 class="abstract" style="margin-left: 1.5em;">Abstract</h4>
        <p class="paddit"><strong>Vocational Evaluation</strong> is a comprehensive process that systematically uses work activities, (either real or simulated), as the focal point for assessment of capabilities, vocational exploration and guidance. The purpose of vocational evaluation is to assist individuals in vocational development. Vocational evaluation incorporates medical, psychological, social, vocational, cultural, and economic data into the assessment process to determine realistic vocational areas.</p>

        <p class="paddit">Vocational Evaluation differs from Functional Capacity Evaluation in that, the evaluee is assessed on a wide range of intellectual, interests, and work samples, as well as performance based tests.</p>

        <div style="border: navy thin solid; width: 487ps;" class="paddit">
         <h3>Types of Assessment Services</h3>

         <h4><a href="services_basic.php">Basic Work-related Capacities</a></h4>

         <h4><a href="services_specific.php">Specific Work-related Assessments</a></h4>

         <h4><a href="program_how.php">How the Assessments Are Performed</a></h4>

         <!-- <h4><a href="program_report.php">The Vocational Evaluation Report</a></h4> -->
        </div><br>

	<h3>Sample Reports</h3>
	<br>

	<?php
  	// Contains DB Connect info.  Variables used below are declared in this file.
  	include("./p2952x783E4/connect.php");
  	//connect to db server
  	$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
  	if (!empty($dbconn)) {	
     	// select the database
     	$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Coud not connect to Database " . $strDatabase);
                     
     	if ($dbinst) {		
        $stmt = "select * from reports order by title";
        $res = mysqli_query($dbconn,$stmt);
        while ($dbrow = mysqli_fetch_array($res)) {
					print("<div style='width:500px; border: black medium outset; padding: 1em;'>\n");
         	print("<h3>" . $dbrow['title'] . "</h3>\n");
					print("<p align='left'>");
					print(str_replace("\n","<br />\n",$dbrow['memo']));
					print("</p>\n");
					print("<p align='left'>");
					print("<a href='./reports/" . $dbrow['report_pdf'] . "'>Sample Report " . $dbrow['id'] . " in PDF Format</a><br>\n");
					print("<span style='color: #808080'>File Size: ");					
					$file = $dbrow['report_pdf'];
					print(number_format(filesize("./reports/" . $file)));
					print(" Bytes</span><br />\n");
					print("</p>\n</div>\n");
      	}
				mysqli_free_result($res);
    	}
  	}                                        
  	// close db connection
  	mysqli_close($dbconn);
	?>


	
       </td>

       <td valign="TOP">
        <p class="sideaddr"><strong>VIP SERVICES<br>
         P.O. Box 818<br>
         Clyde, TX 79510</strong></p>
       </td>
      </tr>
     </table>
    </td>
   </tr>

   <tr>
    <td width="123" align="LEFT">
			<?php include("./includes/sidebottom.inc"); ?>
    </td>

    <td valign="TOP">
    	<?php include("./includes/nav.inc"); ?>
      <?php include("./includes/address.inc"); ?>
    </td>
   </tr>
  </table>
 </body>
</html>

