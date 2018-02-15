 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
<head>
<meta name="generator" content="GNU Emacs 20.4.1 html-helper-mode.el (X11; I; Linux 2.2.12-20 i586)">
<title>Add Location</title>

<style type="text/css">
<!--
BODY { font-family: sans-serif; }
H1, H2, H3, H4, H5, H6 { font-family: sans-serif; }
H2 { margin-bottom: 0; }
TD { font-family: sans-serif; }
TH { font-family: sans-serif; }
OL { font-family: sans-serif; }
P { font-family: sans-serif; }
LI { font-family: sans-serif; }
ADDRESS { font-family: sans-serif; 
	font-style: normal; 
	font-size: 10pt; }
-->
</style>
	<?php require("../includes/admin.inc"); ?>
</head>
<body text="#000000" bgcolor="#FFFFFF" link="#0000EF" vlink="#55188A" alink="#FF0000" >
  <div style="background-color: navy; color: white; font-family: Arial, sans-serif; height: 100;">
   <img alt="" src="../images/sidebar_logo.gif" width="123" height="95" border="0" align="RIGHT"> 
   <hr>
  </div>
<h2> Add Location</h2>
<table summary="Orientation to process" width="500" border="1" cellspacing="0" cellpadding="3">
<tr>

<td valign="top">
<ol>
  <li>Add Location</li>
  <li>Add Map </li>
  <li>Add Testing Dates</li>
</ol>

</td>
<td valign="top">
<p align="left">
Information will be immediately available to the public as added to database.
</p>
</td>
</tr>

</table>
<form action="add_location_v.php" method="post">
<p align="left">
Location:<br>
<input type="TEXT" name="location" size="50" maxlength='75'>
</p>
<p align="left">
Address:<br>
<textarea name="address" rows="4" cols="40"></textarea>
</p>
<p align="left">
Phone Number:<br>
<input type="TEXT" name="phone_number" size="50" maxlength='25'>
</p>
<p align="left">
Driving Instructions:<br>
<textarea name="driving_inst" rows="5" cols="50"></textarea>
</p>
<p align="left">
Memo Field:<br>
<textarea name="memo" rows="15" cols="50"></textarea>
</p>
<input type="SUBMIT" value="Add Location">
</form>
<table summary="Purpose of Table">
<tr>
<td>
<form action="./index.php" method="post">
    <input type="SUBMIT" value="Return Main Admin Page">
</form>
</td>    
</tr>
</table>



<hr width="50%" align="left" title="Copyright, Contact and Page Information Section">
<div align="left">
 	<?php include("../includes/nav_sub.inc"); ?>
	<?php include("../includes/address.inc"); ?>
</div>
</body> </html>
