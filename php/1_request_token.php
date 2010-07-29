<?php
require_once ('config.php');

try {
  // Step 1 - Generate request token and redirect user to Qype to authorize
  $request_token_info = $oauth->getRequestToken($request_token_endpoint);
  $token = $request_token_info['oauth_token'];
  $token_secret = $request_token_info['oauth_token_secret'];

  // Store the request token temporarily
  file_put_contents(OAUTH_TMP_DIR ."/request_token_resp", serialize($request_token_info));

  print "Open this in your browser: ". $authorize_endpoint . '?oauth_token=' . $token;
  print "\n";
  print "Copy the shown identifier and run the second script with it\n";
  print "php 2_access_token.php <verifier from webpage>";
  print "\n";
} catch(OAuthException $E) {
  print_r($E);
}
