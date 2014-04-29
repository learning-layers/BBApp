<?php
// Set up the REDIRECT_URI -- which is just the URL for this file.
// define("REDIRECT_URI", 'http://localhost/podio-php/examples/server-auth.php');
define("REDIRECT_URI", 'http://learning-toolbox.glyn.in/php/podio-add-a-suggestion.php');

  // Include the config file and the Podio library
  require_once '../podio/config.php';
  require_once '../podio/PodioAPI.php';

  // Setup the API client reference. Client ID and Client Secrets are defined
  // as constants in config.php
  Podio::setup( CLIENT_ID, CLIENT_SECRET );
?>

<!DOCTYPE html>

<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.1.1
Version: 2.0.2
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Make a suggestion!</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="../assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="../assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
<link href="../assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="../assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="../assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="../assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
	
	<?php

  if (Podio::is_authenticated()) {
	
	$item_collection = PodioItem::filter( 7881683 );
	
	?>

<!-- BEGIN HEADER -->
<div class="header navbar navbar-fixed-top">
    <!-- BEGIN TOP NAVIGATION BAR -->
    <div class="header-inner">
        <!-- BEGIN LOGO -->
        <a class="navbar-brand" href="index.html">
            <img src="../assets/img/logo.png" alt="logo" class="img-responsive"/>
        </a>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <img src="../assets/img/menu-toggler.png" alt=""/>
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
    </div>
    <!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN PAGE CONTENT-->

					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i> Make a Suggestion!
							</div>
							<div class="tools">
								<a href="" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="" class="reload">
								</a>
								<a href="" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
							<form role="form">
								<div class="form-body">
									<div class="form-group">
										<label for="exampleInputEmail1">Subject</label>
										<input type="email" class="form-control" id="exampleInputEmail1" placeholder="A short name for your suggestion">
										<span class="help-block">
											 The subject will help you identify your suggestion in the table 'My Suggestions'.
										</span>
									</div>
									<div class="form-group">
										<label>Nature of your suggestion</label>
										<select class="form-control">
											<option>Question</option>
											<option>Suggestion</option>
											<option>Problem</option>
										</select>
									</div>
									<div class="form-group">
										<label>Description</label>
										<textarea class="form-control" rows="3"></textarea>
									</div>
									<div class="form-group">
										<label>Status</label>
										<select class="form-control">
											<option>Open</option>
											<option>Pending</option>
											<option>Solved</option>
										</select>
									</div>
									<div class="form-group">
										<label>Email Address</label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-envelope"></i>
											</span>
											<input type="text" class="form-control" placeholder="Email Address">
										</div>
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Password</label>
										<div class="input-group">
											<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
											<span class="input-group-addon">
												<i class="fa fa-user"></i>
											</span>
										</div>
									</div>
									<div class="form-group">
										<label>Left Icon</label>
										<div class="input-icon">
											<i class="fa fa-bell-o"></i>
											<input type="text" class="form-control" placeholder="Left icon">
										</div>
									</div>
									<div class="form-group">
										<label>Right Icon</label>
										<div class="input-icon right">
											<i class="fa fa-microphone"></i>
											<input type="text" class="form-control" placeholder="Right icon">
										</div>
									</div>
									<div class="form-group">
										<label>Input With Spinner</label>
										<input class="form-control spinner" type="text" placeholder="Process something"/>
									</div>
									<div class="form-group">
										<label>Static Control</label>
										<p class="form-control-static">
											 email@example.com
										</p>
									</div>
									<div class="form-group">
										<label>Disabled</label>
										<input type="text" class="form-control" placeholder="Disabled" disabled>
									</div>
									<div class="form-group">
										<label>Readonly</label>
										<input type="text" class="form-control" placeholder="Readonly" readonly>
									</div>
									<div class="form-group">
										<label>Dropdown</label>
										<select class="form-control">
											<option>Option 1</option>
											<option>Option 2</option>
											<option>Option 3</option>
											<option>Option 4</option>
											<option>Option 5</option>
										</select>
									</div>
									<div class="form-group">
										<label>Multiple Select</label>
										<select multiple class="form-control">
											<option>Option 1</option>
											<option>Option 2</option>
											<option>Option 3</option>
											<option>Option 4</option>
											<option>Option 5</option>
										</select>
									</div>
									<div class="form-group">
										<label>Textarea</label>
										<textarea class="form-control" rows="3"></textarea>
									</div>
									<div class="form-group">
										<label for="exampleInputFile1">File input</label>
										<input type="file" id="exampleInputFile1">
										<p class="help-block">
											 some help text here.
										</p>
									</div>
									<div class="form-group">
										<label>Checkboxes</label>
										<div class="checkbox-list">
											<label>
											<input type="checkbox"> Checkbox 1 </label>
											<label>
											<input type="checkbox"> Checkbox 2 </label>
											<label>
											<input type="checkbox" disabled> Disabled </label>
										</div>
									</div>
									<div class="form-group">
										<label>Inline Checkboxes</label>
										<div class="checkbox-list">
											<label class="checkbox-inline">
											<input type="checkbox" id="inlineCheckbox1" value="option1"> Checkbox 1 </label>
											<label class="checkbox-inline">
											<input type="checkbox" id="inlineCheckbox2" value="option2"> Checkbox 2 </label>
											<label class="checkbox-inline">
											<input type="checkbox" id="inlineCheckbox3" value="option3" disabled> Disabled </label>
										</div>
									</div>
									<div class="form-group">
										<label>Radio</label>
										<div class="radio-list">
											<label>
											<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked> Option 1</label>
											<label>
											<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2"> Option 2 </label>
											<label>
											<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" disabled> Disabled </label>
										</div>
									</div>
									<div class="form-group">
										<label>Inline Radio</label>
										<div class="radio-list">
											<label class="radio-inline">
											<input type="radio" name="optionsRadios" id="optionsRadios4" value="option1" checked> Option 1 </label>
											<label class="radio-inline">
											<input type="radio" name="optionsRadios" id="optionsRadios5" value="option2"> Option 2 </label>
											<label class="radio-inline">
											<input type="radio" name="optionsRadios" id="optionsRadios6" value="option3" disabled> Disabled </label>
										</div>
									</div>
								</div>
								<div class="form-actions">
									<button type="submit" class="btn blue">Submit</button>
									<button type="button" class="btn default">Cancel</button>
								</div>
							</form>
						</div>
					</div>
					<!-- END SAMPLE FORM PORTLET-->
					
            <!-- END PAGE CONTENT-->
        </div>
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="footer">
    <div class="footer-inner">
         2014 &copy; Learning Layers. Design by Metronic.
    </div>
    <div class="footer-tools">
        <span class="go-top">
            <i class="fa fa-angle-up"></i>
        </span>
    </div>
</div>
	<?php
	
  }
  elseif (!isset($_GET['code'])) {
    // If $_GET['code'] is not set it means we are not trying to authenticate.
    // In that case just display a link to start the serv flow
    $auth_url = htmlentities(Podio::authorize_url(REDIRECT_URI));
    print "<a href='{$auth_url}'>Start authenticating</a>";
  }
  else {
    // Otherwise try to authenticate using the code provided.

    // $_GET['error'] is set if there was a problem
    if (!isset($_GET['error'])) {
      Podio::authenticate('authorization_code', array('code' => $_GET['code'], 'redirect_uri' => REDIRECT_URI));
      $access_token = Podio::$oauth->access_token;
      print "You have been authenticated. Wee!<br>";
      print "Your access token is {$access_token}<br><br>";
      print "Hang onto this access token along with the refresh token (store them in a session or similar) so you don't have to re-authenticate for every request.<br><br>";

      // Now you can start making API calls. E.g. get your user status
      $status = PodioUserStatus::get();
      print "Your user id is <b>{$status->user->id}</b> and you have <b>{$status->inbox_new}</b> unread messages in your inbox.<br><br>";
    }
    else {
      $error_description = htmlspecialchars($_GET['error_description']);
      print "There was a problem. The server said: {$error_description}<br>";
    }
  }
?>

<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="assets/plugins/respond.min.js"></script>
<script src="assets/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="../assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="../assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="../assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script src="../assets/scripts/core/app.js"></script>
<script>
jQuery(document).ready(function() {       
   // initiate layout and plugins
   App.init();
});
</script>
<script type="text/javascript">  var _gaq = _gaq || [];  _gaq.push(['_setAccount', 'UA-37564768-1']);  _gaq.push(['_setDomainName', 'keenthemes.com']);  _gaq.push(['_setAllowLinker', true]);  _gaq.push(['_trackPageview']);  (function() {    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);  })();</script>
</body>
<!-- END BODY -->
</html>