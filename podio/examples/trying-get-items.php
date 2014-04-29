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
define("REDIRECT_URI", 'http://localhost/podio-php/examples/server-auth.php');

?><html>
<head>
  <title>Trying - Get items from Podio table</title>
</head>
<body>
<?php

  // Include the config file and the Podio library
  require_once 'config.php';
  require_once '../PodioAPI.php';

  // Setup the API client reference. Client ID and Client Secrets are defined
  // as constants in config.php
  Podio::setup( CLIENT_ID, CLIENT_SECRET );

  if (Podio::is_authenticated()) {
    // Use Podio::is_authenticated() to check is there's already an active session.
    // If there is you can make API calls right away.
    print "You were already authenticated and no authentication is needed. Close and reopen your browser to start over.<br>";

    $status = PodioUserStatus::get();
    print "Your user id is <b>{$status->user->id}</b> and you have <b>{$status->inbox_new}</b> unread messages in your inbox.<br><br>";
	// Get a single item by item_id
	// $item will hold an instance of the PodioItem class.
	// See the available properties in PodioItem.php
	$item = PodioItem::get( 147526348 );
	
	// You can for example print the title
	print "Title: {$item->title}.<br>";
	
	$subject_field = $item->field('subject');
	print "Subject: {$subject_field->humanized_value()}<br>";
	print($subject_field->values[0]['value'])."<br>";
	// print "Subject: {$subject_field->values}.<br>";
	
	// You can access the fields in the 'fields' property (an array of PodioItemField instances)
	foreach ($item->fields as $field) {
	  print "This field has the external_id: {$field->external_id}<br>";
	}
		
	// Even easier you can access individual fields by external_id or field_id using the 'field' method.
	// E.g. to get the field with an external_id of 'title' you would do:
	$field = $item->field('subject');
	
	// You can also get all fields of a specific type. E.g. if you want to get all date fields:
	$text_fields = $item->fields_of_type('text');
	
	// Now that you have a PodioItemField you can print the 'humanized_value' (a value that's easy to read for humans)
	print "Subject: {$field->humanized_value()}<br>";
	
	// The raw values are in the 'values' property. Their format depends on the field type.
	print_r($field->values);
	print "<br>";
	
	// E.g. to change the value of a text field:
	print "Subject (before save): {$item->field('subject')}<br>";
	$item->field('subject')->set_value('This is the new subject of this message');
	$item->save();
	print "Subject (after save): {$item->field('subject')}<br>";
	
	// Often you want to get a collection of items rather than a single one. You do so with 'filter'
	$item_collection = PodioItem::filter( 7881683 );
	
	// A collection is an associative array with some extra data in addition to the list of items.
	// print $item_collection['total']."<br>"; // The total amount of items in the app
	// print $item_collection['filtered']."<br>"; // Number of items matching the current filter
	print "<br>";
	print_r($item_collection['items'][0]); // Array of PodioItem instances
	// print "<br>";
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
