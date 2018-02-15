<!DOCTYPE HTML PUBLIC "-//SoftQuad Software//DTD HoTMetaL PRO 6.0::19990601::extensions to HTML 4.0//EN" "hmpro6.dtd">
<html>
 <head>
  <title>Links - Vocational Assessments</title>
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
    <td width="123" align="LEFT" valign="top">
     <table cellpadding="0" cellspacing="0" border="0" style="margin-top: 0.5em;">
      <tr><td><img alt="" src="./images/sidebar_1.gif" width="123" height="11"></td></tr>
      <tr><td><img alt="" src="./images/sidebar_logo.gif" width="123" height="95" border="0" usemap="#map1"></td></tr>
      <tr><td><img alt="" src="./images/sidebar_program.gif" width="123" height="28" border="0" usemap="#map2"></td></tr>
      <tr><td><img alt="" src="./images/sidebar_staff.gif" width="123" height="28" border="0" usemap="#map3"></td></tr>
      <tr><td><img alt="" src="./images/sidebar_links.gif" width="123" height="26" border="0" usemap="#map4"></td></tr>
      <tr><td><img alt="" src="./images/sidebar_services.gif" width="123" height="28" border="0" usemap="#map5"></td></tr>
      <tr><td><img alt="" src="./images/sidebar_home.gif" width="123" height="27" border="0" usemap="#map6"></td></tr>
      <tr><td><img alt="" src="./images/sidebar_7.gif" width="123" height="184"></td></tr>
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
        <h2>Links</h2>
       </td>
      </tr>

      <tr>
       <td valign="TOP" width="487">
        <div class="paddit">
	<dl>
	<?php
  	// Contains DB Connect info.  Variables used below are declared in this file.
  	include("./p2952x783E4/connect.php");
  	//connect to db server
  	$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
  	if (!empty($dbconn)) {	
     	// select the database
     	$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Coud not connect to Database " . $strDatabase);
                     
     	if ($dbinst) {		
        $stmt = "select * from links order by title";
        $res = mysqli_query($dbconn,$stmt);
        while ($dbrow = mysqli_fetch_array($res)) {
					print("<dt>" . $dbrow['title']);
					if ($dbrow['description']) {
						print("<br /><span class='desc'>". $dbrow['description'] . "</span>");
					} 
 					print("</dt>\n");
				 	print("<dd><a title='External Link to " . $dbrow['title'] . "' href='http://" . $dbrow['url'] . "'>" . $dbrow['url'] . "</a></dd>\n");
      	}
				mysqli_free_result($res);
    	}
  	}                                        
  	// close db connection
  	mysqli_close($dbconn);
	?>
	</dl>
	</div>
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
    <td width="123" align="LEFT"><?php include("./includes/sidebottom.inc");?></td>
    <td valign="TOP">
    	<?php include("./includes/nav.inc"); ?>
			<?php include("./includes/address.inc"); ?>
    </td>
   </tr>
  </table>
 </body>
</html>

