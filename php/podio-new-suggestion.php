<?php
    /*
     * Copyright (c) 2014 Gilbert Peffer
     *
     * Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except
     * in compliance with the License. You may obtain a copy of the License at
     *
     * http://www.apache.org/licenses/LICENSE-2.0
     *
     * Unless required by applicable law or agreed to in writing, software distributed under the License
     * is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express
     * or implied. See the License for the specific language governing permissions and limitations under
     * the License.
     */
 
    // Include the config file and the Podio API library
    require_once '../podio/config.php';
    require_once '../podio/PodioAPI.php';
    
    define("REDIRECT_URI", $rootDir."/suggestions.html");
    
    // Setup the API client reference. Client ID and Client Secrets are defined
    // as constants in config.php
    Podio::setup( CLIENT_ID, CLIENT_SECRET );
      
    if(!isset($_GET['code']) && !Podio::is_authenticated()) {
        $_SESSION['preauthurl'] = $rootDir."/php/podio-new-suggestion.php";
        header( 'Location: grant-podio-access.php' ) ;
    }
?>

<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->

<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>Make a Suggestion!</title>
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
    <link href="../assets_ltb/css/child/style-child.css" rel="stylesheet" type="text/css"/>
    <link href="../assets_ltb/css/child/style-responsive-child.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="../assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    
    <link rel="shortcut icon" href="favicon.ico"/>
    
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="page-header-fixed page-sidebar-closed">
	
	<?php

  if (Podio::is_authenticated()) {
	
	$item_collection = PodioItem::filter( 7881683 );
	
	?>

<!-- BEGIN HEADER -->
<div class="header navbar navbar-fixed-top">
    
    <!-- BEGIN TOP NAVIGATION BAR -->
    <div id="includeTopNavbar"></div>
    <!-- END TOP NAVIGATION BAR -->
    
</div>
<!-- END HEADER -->

<div class="clearfix">
</div>

<!-- BEGIN CONTAINER -->
<div class="page-container">

    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <div class="page-sidebar navbar-collapse collapse">
            <!-- add "navbar-no-scroll" class to disable the scrolling of the sidebar menu -->
            
            <!-- BEGIN SIDEBAR MENU -->
            <div id="includeSidebarMenu"></div>
            <!-- END SIDEBAR MENU -->
            
        </div>
    </div>
    <!-- END SIDEBAR -->

    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">

            <!-- BEGIN PAGE CONTENT-->

					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet box red">
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
							<form action="podio-add-suggestion.php" method="post" enctype="multipart/form-data">
								<div class="form-body">
									<div class="form-group">
										<label for="subject">Subject</label>
										<input type="text" class="form-control" name="formSubject" id="subject" placeholder="A short name for your suggestion">
										<span class="help-block">
											 The subject will help you identify your suggestion in the table 'My Suggestions'
										</span>
									</div>
									<div class="form-group">
										<label>Nature of your suggestion</label>
										<select class="form-control" name="formNature">
											<option value = "Question">Question</option>
											<option value = "Suggestion">Suggestion</option>
											<option value = "Problem">Problem</option>
										</select>
									</div>
									<div class="form-group">
										<label>Description</label>
										<textarea class="form-control" rows="3" name="formDesc"></textarea>
									</div>
									<div class="form-group">
										<label>Status</label>
										<select class="form-control" name="formStatus">
											<option value = "Open">Open</option>
											<option value = "Pending">Pending</option>
											<option value = "Solved">Solved</option>
										</select>
									</div>
									<div class="form-group">
										<label for="exampleInputFile1">Attachments</label>
										<input type="file" id="exampleInputFile1" name="formFile">
										<p class="help-block">
											 You can upload files with more details about your suggestion
										</p>
									</div>
								</div>
								<div class="form-actions">
									<button type="submit" value="submit" name="formSubmit" class="btn red">Submit</button>
									<a href="../suggestions.html">
										<button type="button" class="btn default">Cancel</button>
									</a>
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

<?php
  }
  // elseif (!isset($_GET['code'])) {
    // If $_GET['code'] is not set it means we are not trying to authenticate.
    // In that case just display a link to start the serv flow
    // $auth_url = htmlentities(Podio::authorize_url(REDIRECT_URI));
    // print "<a href='{$auth_url}'>Start authenticating</a>";
    // $_SESSION['preauthurl'] = "http://$_SERVER[HTTP_HOST]/learning-toolbox/php/podio-new-suggestion.php";
    // header( 'Location: grant-podio-access.php' ) ;
  // }
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

<!-- BEGIN FOOTER -->
<div class="footer">
    <div class="footer-inner">
         2014 &copy; Learning Layers. Design based on Metronic.
    </div>
    <div class="footer-tools">
        <span class="go-top">
            <i class="fa fa-angle-up"></i>
        </span>
    </div>
</div>
<!-- END FOOTER -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

<!-- BEGIN CORE PLUGINS -->

<!--[if lt IE 9]>
<script src="assets/plugins/respond.min.js"></script>
<script src="assets/plugins/excanvas.min.js"></script> 
<![endif]-->

<script src="../assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="../assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
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

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-48091512-2', 'glyn.in');
  ga('send', 'pageview');
</script>

<script> 
    $(function(){
      $("#includeTopNavbar").load("snippets/top-navbar.html"); 
    });
</script> 

<script>
    $(function(){
      $("#includeSidebarMenu").load("snippets/sidebar-menu.html"); 
    });
</script> 
<!-- END JAVASCRIPTS -->

</body>
<!-- END BODY -->

</html>
