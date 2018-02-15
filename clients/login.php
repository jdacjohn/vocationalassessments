<html>
<head>
<title>VIP Services Login</title>
  <link rel="STYLESHEET" href="../css/vip.css">
	<!-- metatags if needed -->
	<?php 
		include('../includes/metak.inc');
  	include('../includes/metad.inc');
	?>
	<style type="text/css">
	<!--
	BODY { font-family: sans-serif; }
	H1, H2, H3, H4, H5, H6 { font-family: sans-serif; }
	TD { font-family: sans-serif; }
	TH { font-family: sans-serif; }
	OL { font-family: sans-serif; }
	P { font-family: sans-serif; }
	LI { font-family: sans-serif; }
	form { margin: 0; }
	ADDRESS { font-family: sans-serif; 
		font-style: normal; 
		font-size: 10pt; }
	dl, dt, dl { margin: 0; }
	-->
	</style>
</head>

<body text="#000000" bgcolor="#FFFFFF" link="#0000EF" vlink="#55188A" alink="#FF0000" onLoad="javascript:document.loginForm.uname.focus();" >
  <div style="background-color: navy; color: white; font-family: Arial, sans-serif; height: 100;">
   <img alt="" src="../images/sidebar_logo.gif" width="123" height="95" border="0" align="RIGHT"> 
   <hr>
  </div>

<h2>&nbsp;VIP Services</h2>
			<table width="745" border="0">
				<tr>
        	<td colspan='3' align="left">You must login to access this area of the website.</td>
        </tr>
				<tr>
        	<td colspan='3' align="left">Please enter the username and password provided to you into the form below.  If you do not have a username and password, please contact the <a href='mailto:webmaster@vocationalassessments.com'>Website Administrator</a>.</td>
        </tr>
        <tr>        
					<td width="222" align="left" valign="top">&nbsp;</td>
					<!-- Center Column Content -->
					<td width="300" align="left" valign="top">
						<table width="300" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td width="20" id="lg-tl">&nbsp;</td>
								<td width="260" id="lg-top">&nbsp;</td>
								<td width="20" id="lg-tr">&nbsp;</td>
							</tr>
							<tr>
								<td width="20" class="lg-left">&nbsp;</td>
								<td width="260" class="lg-bg">Please enter your username and password.</td>
								<td width="20" class="lg-right">&nbsp;</td>
							</tr>
							<tr>
								<td width="20" class="lg-left">&nbsp;</td>
								<td width="260" class="lg-bg">&nbsp;</td>
								<td width="20" class="lg-right">&nbsp;</td>
							</tr>
              <form name="loginForm" action="./auth_user.php" method="POST">
              	<?php
									$url = $_GET['uri'];
									//print("IP Stuffed url = " . $url . "<br />");
									print("<input type='hidden' name='target_url' value='" . $url . "' />\n");
								?>
              <tr>
                <td width="20" class="lg-left">&nbsp;</td>
                <td width="260" class="lg-bg">
                  <table width="260" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                      <td align="left" width="80"class="lg-bg">User Name:</td>
                      <td align="left"><input type="text" class="lg-input" name="uname" maxlength="12" value=""  /></td>
                    </tr>
                  </table>
                </td>
                <td width="20" class="lg-right">&nbsp;</td>
              </tr>
              <tr>
                <td width="20" class="lg-left">&nbsp;</td>
                <td width="260" class="lg-bg">
                  <table width="260" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                      <td align="left" width="80"class="lg-bg">Password:</td>
                      <td align="left"><input type="password" class="lg-input" name="pword" maxlength="12" value=""  /></td>
                    </tr>
                  </table>
                </td>
                <td width="20" class="lg-right">&nbsp;</td>
              </tr>
              <tr>
                <td width="20" class="lg-left">&nbsp;</td>
                <td width="260" class="lg-bg">
                  <table width="260" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                      <td align="left" width="80">&nbsp;</td>
                      <td align="left"><input type="submit" class="lg-input" name="submit" value="Login"  /></td>
                    </tr>
                  </table>
                </td>
                <td width="20" class="lg-right">&nbsp;</td>
              </tr>
              </form>
							<?php
								if (isset($_GET['mi'])) {
									print("<tr>\n");
									print("<td width='20' class='lg-left'>&nbsp;</td>\n");
        					print("<td width='260' class='lg-bg'><span style='color:#FF0000'>Invalid user name or password.  Please try again.</span></td>\n");
									print("<td width='20' class='lg-right'>&nbsp;</td>\n");
        					print("</tr>\n");
								}
							?>
							<?php
								if (isset($_GET['exp'])) {
									print("<tr>\n");
									print("<td width='20' class='lg-left'>&nbsp;</td>\n");
        					print("<td width='260' class='lg-bg'><span style='color:#FF0000'>Your session has expired.  Please login again to continue.</span></td>\n");
									print("<td width='20' class='lg-right'>&nbsp;</td>\n");
        					print("</tr>\n");
								}
							?>
							<tr>
								<td width="20" id="lg-bl">&nbsp;</td>
								<td width="260" id="lg-bot">&nbsp;</td>
								<td width="20" id="lg-br">&nbsp;</td>
							</tr>
						</table>
						<p>&nbsp;</p>
          </td>
          <td width="223">&nbsp</td>
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



