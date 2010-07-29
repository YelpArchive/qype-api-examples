<?php
require_once ('config.php');

if (count($_SERVER['argv']) != 2) {
  print "Usage: php 2_access_token.php <verifier>\n";
  exit;
}

$request_token = unserialize(file_get_contents(OAUTH_TMP_DIR . "/request_token_resp"));
$req_token_verifier = $_SERVER['argv'][1];

try {
  // Step 2 - Exchange the authorized request token for an access token

  print "Using request token " . $request_token["oauth_token"] . "\n";

  $oauth->setToken($request_token["oauth_token"], $request_token["oauth_token_secret"]);
  $access_token_info = $oauth->getAccessToken($access_token_endpoint, NULL, $req_token_verifier);

  // Store the access token, we need this for all API requests
  // In your application you can store these access tokens forever
  file_put_contents(OAUTH_TMP_DIR . "/access_token_resp", serialize($access_token_info));

  print "Successfully got the access token!\n";
  print "You can do the test request now ...\n";
} catch(OAuthException $E) {
  print_r($E);
}
