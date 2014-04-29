<?php
/*

This example shows you how to authenticate using the server flow.
You are stringly encouraged to read about the different authentication methods
at https://developers.podio.com/authentication to determine which is best for
your use.

To run this example:
* Follow the guidelines in the README to setup your configuration


To run this example you must perform some quick configuration. Follow these steps:

* Go to https://podio.com/settings/api and create an API client id and client secret. The domain you use must be the domain you will be running these examples under (the domain "localhost" will always work).
* Create a copy of the file config.sample.php and call it config.php
* Open this new config.php and fill in your client id, client secret and your Podio username and password
* Specify your REDIRECT_URI (the URL of this file) below
* Run this file in your browser.

 */

// Set up the REDIRECT_URI -- which is just the URL for this file.
// define("REDIRECT_URI", 'http://localhost/podio-php/examples/server-auth.php');
define("REDIRECT_URI", 'http://learning-toolbox.glyn.in/php/podio-questions-to-table.php');

  // Include the config file and the Podio library
  require_once '../podio/config.php';
  require_once '../podio/PodioAPI.php';

  // Setup the API client reference. Client ID and Client Secrets are defined
  // as constants in config.php
  Podio::setup( CLIENT_ID, CLIENT_SECRET );

?><html>
<head>
	<meta charset="utf-8"/>
	<title>Trying - Write Podio items into HTML table</title>
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
<body>
<?php

  if (Podio::is_authenticated()) {
	
	$item_collection = PodioItem::filter( 7881683 );
	
	?>
		<table border="1" cellspacing="1" cellpadding="5">
			<tr>
			   <td>Subject</td>
			   <td>Nature</td>
			   <td>State</td>
			</tr>
	<?php
	foreach ($item_collection['items'] as $item ){
		$subject = $item->field('subject')->humanized_value();
		$nature = $item->field('nature-of-ticket')->humanized_value();
		$state = $item->field('state-of-ticket')->humanized_value();
	?>
	     <tr>
	       <td><?php echo $subject; ?></td>
	       <td><?php echo $nature; ?></td>
	       <td><?php echo $state; ?></td>
	     </tr>
	<?php
	}
	?>
						<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>Simple Table
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="javascript:;" class="reload">
								</a>
								<a href="javascript:;" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-responsive">
								<table class="table table-hover">
								<thead>
								<tr>
									<th>
										 #
									</th>
									<th>
										 First Name
									</th>
									<th>
										 Last Name
									</th>
									<th>
										 Username
									</th>
									<th>
										 Status
									</th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<td>
										 1
									</td>
									<td>
										 Mark
									</td>
									<td>
										 Otto
									</td>
									<td>
										 makr124
									</td>
									<td>
										<span class="label label-sm label-success">
											 Approved
										</span>
									</td>
								</tr>
								<tr>
									<td>
										 2
									</td>
									<td>
										 Jacob
									</td>
									<td>
										 Nilson
									</td>
									<td>
										 jac123
									</td>
									<td>
										<span class="label label-sm label-info">
											 Pending
										</span>
									</td>
								</tr>
								<tr>
									<td>
										 3
									</td>
									<td>
										 Larry
									</td>
									<td>
										 Cooper
									</td>
									<td>
										 lar
									</td>
									<td>
										<span class="label label-sm label-warning">
											 Suspended
										</span>
									</td>
								</tr>
								<tr>
									<td>
										 4
									</td>
									<td>
										 Sandy
									</td>
									<td>
										 Lim
									</td>
									<td>
										 sanlim
									</td>
									<td>
										<span class="label label-sm label-danger">
											 Blocked
										</span>
									</td>
								</tr>
								</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
	<?php
	
	// // You can for example print the title
	// print "Title: {$item->title}.<br>";
// 	
	// $subject_field = $item->field('subject');
	// print "Subject: {$subject_field->humanized_value()}<br>";
	// print($subject_field->values[0]['value'])."<br>";
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
</body>
</html>
