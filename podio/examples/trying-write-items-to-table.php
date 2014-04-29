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
define("REDIRECT_URI", 'http://learning-toolbox.glyn.in/podio/examples/trying-write-items-to-table.php');

  // Include the config file and the Podio library
  require_once 'config.php';
  require_once '../PodioAPI.php';

  // Setup the API client reference. Client ID and Client Secrets are defined
  // as constants in config.php
  Podio::setup( CLIENT_ID, CLIENT_SECRET );

?><html>
<head>
  <title>Trying - Write Podio items into HTML table</title>  
</head>
<body>
<?php

  if (Podio::is_authenticated()) {
    // Use Podio::is_authenticated() to check is there's already an active session.
    // If there is you can make API calls right away.
    print "You were already authenticated and no authentication is needed. Close and reopen your browser to start over.<br>";

    $status = PodioUserStatus::get();
    print "Your user id is <b>{$status->user->id}</b> and you have <b>{$status->inbox_new}</b> unread messages in your inbox.<br><br>";
	// Get a single item by item_id
	// $item will hold an instance of the PodioItem class.
	// See the available properties in PodioItem.php
	
	// $item = PodioItem::get( 147526348 );
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
	
	// You can for example print the title
	print "Title: {$item->title}.<br>";
	
	$subject_field = $item->field('subject');
	print "Subject: {$subject_field->humanized_value()}<br>";
	print($subject_field->values[0]['value'])."<br>";
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

	// $item = PodioItem::get( 147526348 );
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

    }
    else {
      $error_description = htmlspecialchars($_GET['error_description']);
      print "There was a problem. The server said: {$error_description}<br>";
    }
  }
?>
</body>
</html>
