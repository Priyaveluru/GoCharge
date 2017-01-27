<?php
require_once('./dbconnect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.ico">

    <title>Narrow Jumbotron Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
	<link href="bootswatch/paper/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/jumbotron-narrow.css" rel="stylesheet">

	<!-- Custom styles for SmartPark -->
    <link href="css/style.css" rel="stylesheet">
	
	<!-- beautiful fonts -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,300" rel="stylesheet" type="text/css">
	
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation"><a href="udashboard.php">Home</a></li>
            <li role="presentation"><a href="about.php">About</a></li>
            <li role="presentation" class="active"><a href="contact.php">Contact</a></li>
			<li role="presentation"><a href="logout.php">Logout</a></li>
          </ul>
        </nav>
        <h3 class="page-header">Go Charge</h3>
      </div>

        <div class="jumbotron">
        <h3>Contact Us</h3>
        <p class="lead" style="color:#fff;">contact details as follows</p>
		<td style="margin-right:400px">
                <img class="email" src="./img/email_icon.png" border="5" style="width:47px;margin-left:2px;"></img>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						<img src="./img/phone-icon.jpg" style="width:47px;"></img>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						<img src="./img/facebook.png" style="width:48px"></img>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						<img src="./img/Twitter_image.jpg" style="width:48px"></img>
                     </td>
					 <p style="margin-left:-12px">Gocharge@sjsu.edu &nbsp&nbsp+15107665818 &nbsp&nbsp&nbspFb/GoCharge&nbsp&nbspTwitter/GoCharge</p>
					 
		<p class="lead">Tech Crusaders<br>
		</div> 		

      

      <footer class="footer">
        <p>&copy; Go Charge 2016</p>
      </footer>

    <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
<style type="text/css"> 
.email img p {
	display:none;}
.email img:hover p {
	display:block;} 


div.sprite {
width: 20%;
height: 0;
padding-bottom: 20%;
background-image: url("images/ourimage.png");
background-position: 0 0;
background-size: 200%;
display:block;
}
</style>
