<?php
require_once ('config.php');

// Step 3 - Do a test request with the access token
try {
  set_access_token($oauth);

  print "Doing a test request\n";

  $oauth->fetch("http://api.qype.com/oauth/test_request");

  print $oauth->getLastResponse();
  print "\n";
} catch(OAuthException $E) {
  print_r($E);
}
