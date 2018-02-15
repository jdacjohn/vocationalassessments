<html>
 <head>
  <meta name="generator" content="HTML Tidy, see www.w3.org">
  <title>Locations - Vocational Assessments</title>
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
       <td><img alt="" src="./images/sidebar_7.gif" width="123" height="184" border="0"></td>
      </tr>
     </table>
     <map name="map1">
      <area shape="RECT" coords="0,0,123,95" href="./index.php" alt="VIP Services">
     </map> <map name="map2">
      <area shape="RECT" coords="0,0,123,28" href="./program.php" alt="Our Program">
     </map> <map name="map3">
      <area shape="RECT" coords="0,0,123,28" href="./staff.php" alt="Staff">
     </map> <map name="map4">
      <area shape="RECT" coords="0,0,123,26" href="./links.php" alt="Links">
     </map> <map name="map5">
      <area shape="RECT" coords="0,0,123,28" href="./services.php" alt="Services">
     </map> <map name="map6">
      <area shape="RECT" coords="0,0,123,27" href="./index.php" alt="Home Page">
     </map>
     <p><a href="./clients/index.php">VIP Team</a><br>
        Password Needed<br>
        To Access</p>
 

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
             <td><a href="./locations.php"><img src="./images/btn_top_locations.gif" alt="Locations" width="70" height="32" border="0"></a></td>

             <td><a href="./contact.php"><img src="./images/btn_top_contact.gif" alt="Contact Us" width="70" height="32" border="0"></a></td>

             <td><a href="./index.php"><img src="./images/btn_top_home.gif" alt="Home" width="70" height="32" border="0"></a></td>
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
        <h2>Locations</h2>
       </td>
      </tr>

      <tr>
       <td valign="TOP" width="487">
<!-- Insert Content Here -->
	<?php
  	// Contains DB Connect info.  Variables used below are declared in this file.
  	include("./p2952x783E4/connect.php");
  	//connect to db server
  	$dbconn=mysqli_connect("$strServer","$strUser","$strPwd") or die("Could not connect to " . $strServer . "  " . mysqli_error($dbconn));
  	if (!empty($dbconn)) {	
     	// select the database
     	$dbinst=mysqli_select_db($dbconn,"$strDatabase") or die("Coud not connect to Database " . $strDatabase);
                     
     	if ($dbinst) {		
        $stmt = "select * from locations order by location";
        $res = mysqli_query($dbconn,$stmt);
        while ($dbrow = mysqli_fetch_array($res)) {
					print("<div class='location'>\n");
					print("<dl>\n");			
					print( "<dt>\n");
					print("<a name='" . $dbrow['id'] . "'>");
					print($dbrow['location'] . "</a></dt>\n");
	        print("<dd>\n");
    			print("<dl><dt>Address:</dt>\n");
    			print("<dd>\n");
						
    			print(str_replace("\n", "<br />\n", $dbrow['address']) . "</dd>\n");
    			print("<dt>Phone Number:</dt>\n");
    			print("<dd>" . $dbrow['phone_number'] . "</dd>\n");
    			if ($dbrow['driving_inst']) {
						print("<dt>Driving Instructions:</dt>\n");
						print("<dd>" . str_replace("\n", "<br>\n", $dbrow['driving_inst']) . "</dd>\n");
      		}
			    print("<dt>Testing Dates</dt>\n");
			    print("<dd>\n");	
    			print("<ul>\n");

    			// sub query //
					$loc_id = $dbrow['id'];    
    			$stmt2 = "select meet_date from loc_dates where loc_id = $loc_id";
					$res2 = mysqli_query($dbconn,$stmt2);
					while ($dbrow2 = mysqli_fetch_array($res2)) {
						print("<li>" . $dbrow2['meet_date'] . "</li>\n");
		      }
					mysqli_free_result($res2);
					// End Subquery
					
    			print("</ul>\n");
    			print("</dd>\n");
    			if ($dbrow['map_img']) {
						print("<dt>\n[ <a href='./map_to_location.php?id=$loc_id'>Map To Location</a> ]\n</dt>\n");
      		} else {
						print("<dt>&#160;</dt>\n");
      		}

    			if($dbrow['memo']) {
						print("<dt>Miscellaneous Info</dt>\n");
						print("<dd>" . str_replace("\n", "<br>\n" , $dbrow['memo']) . "</dd>\n");
					}
					
    			print("</dl>\n");
					print("</dd>\n");
					print("</dl>\n");	    
					print("</div>\n");  
 					print("<br clear='all'>");  
      	}
				mysqli_free_result($res);
    	}
  	}                                        
  	// close db connection
  	mysqli_close($dbconn);
	?>
<!-- Insert Content Here -->	
       </td>

       <td valign="TOP">
        <p class="sideaddr"><b>VIP SERVICES<br>
         P.O. Box 818<br>
         Clyde, TX 79510</b></p>
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