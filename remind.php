<?php
include 'connect.php';
require_once('libraries/gmail.php');
$email	 = $_POST['email'];
$search = mysql_query("SELECT password FROM user WHERE email='".$email."'");
?>
<!doctype html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>The Virginia Academy of Science</title>
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/jquery.kwicks.min.css">
		<link rel="stylesheet" href="css/smoothness/jquery-ui-1.10.4.custom.min.css" />
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,100italic,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Julius+Sans+One' rel='stylesheet' type='text/css'>
		<style type='text/css'>
            .kwicks {
                height: 300px;
                border: 5px solid #ffffff;
                background-color: #ffffff;
            }
        </style>
		<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.10.4.custom.min.js"></script>
		<script type="text/javascript" src="js/accordionImageMenu-0.4.min.js"></script>
		<script type="text/javascript" src="js/jquery.kwicks.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				var $container = $('.kwicks').kwicks({
					minSize : 70,
					spacing: 5,
                    behavior: 'menu'
				});

				$( "#dialog-form" ).dialog({
      				autoOpen: false,
      				height: 300,
      				width: 350,
      				modal: true,
      				buttons: {
        				"Login": function() {
          				
        				},
        				Cancel: function() {
        		 		 $( this ).dialog( "close" );
       			 		}
      				},
      				close: function() {

      				}
    			});

				$( ".login-button" ).click(function() {
        			$( "#dialog-form" ).dialog( "open" );
      			});



			});
		</script>
		
	</head>
	<body>
		<div id="container">
			<div id="login">
				<div class="login-button">member login <span style="font-size: 8pt">&#9660</span></div>
				<div id="dialog-form" title="Member Login">
				
				 
					<form>
				 		<fieldset>
				    		<label for="email">Email</label>
				    		<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all"><br>
				    		<label for="password">Password</label>
				    		<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all">
						</fieldset>
					</form>
                  <p><a href="forgot.php">Forgot your password?</a></p><br />
					<p>Not a member yet? <a href="sign_up.php">Sign up now!</a></p>
				</div>
			</div>
			<div id="sub-header">
              
				<div id="logo">
				<!--	<img src="images/vas_logo.png" /> -->
                  <a href="index.php">
                    	<img src="images/vas_logo_no_text.svg" height="100" />
                    </a>
				</div>

                 <div id="sub-navigation">
					<ul>
                      <li class="selected"><a href="about.php">about</a><br /><br />
          				<ul>
                          <li><a href="history.php">History</a></li>
                          <li><a href="council.php">Council Members</a></li>
          				</ul>
        			</li>
                    <li><a href="membership.php">membership</a></li>
                    <li><a href="events.php">events</a></li>
                    <li><a href="grants_scholarships.php">grants & scholarships</a></li>
                    <li><a href="journals.php">journals</a><br /><br />
                      <ul>
                          <li><a href="styleManual.php">Style Manual</a></li>
          				</ul>
                    </li>
                    <li><a href="contact.php">contact</a></li>
                  </ul>
				</div>
            
			</div>
			<div id="content">
<?php
if(mysql_num_rows($search)!=0)
{
$row = mysql_fetch_array($search);
$pass = $row['password'];




$message = '
 
An email was requested for the password that goes with this email address. It listed below.<br>
 
------------------------<br>
Password: '.$pass.'<br>
------------------------<br>
'; 
                     
$headers = 'From:noreply@VASForum' . "\r\n"; // Set from headers
$mail->isHTML(true);  
$mail->From = 'from@example.com';
$mail->FromName = 'Virginia Academy of Science';
$mail->addAddress($email);  // Add a recipient
$mail->addReplyTo('info@example.com', 'Information');
$mail->Subject    = "Forgot Password/Username";
$mail->Body       = $message;
if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}
?>
<center><font size="5">An email has been sent to your address with your credentials. </font></center>
<?php


}
else
{
?>
 <center>  <font size="3">There is no user with that email address on this forum.</font><br /><br />
   <a href="forgot.php">Try again</a></center>
 <?php } ?>
			

			</div>
			
			
		</div>
	</body>
</html>
