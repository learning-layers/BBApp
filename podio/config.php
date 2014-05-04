<?php

define("CLIENT_ID", "learning-toolbox");
define("CLIENT_SECRET", "pzGca3nRRYjUvwaUQBK8Czvj4ZiPshSyAV4yKrkUA8PXgqoaQig2BswZ4GAjc0DK");
define("USERNAME", "");
define("PASSWORD", "");

// Set up the root directory of the application.
if ($_SERVER['HTTP_HOST'] == "localhost") {
    $rootDir = "http://$_SERVER[HTTP_HOST]/learning-toolbox";
}
else {
    $rootDir = "http://$_SERVER[HTTP_HOST]";
}

// Make sure errors are output to the screen
ini_set('display_errors', '1');
