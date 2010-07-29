<?php
require_once ('config.php');

if (count($_SERVER['argv']) != 2) {
  print "Usage: php review_delete.php <api URI of review>\n";
  exit;
}
$review_uri = $_SERVER['argv'][1];

// Deletes an existing review
try {
  set_access_token($oauth);

  // Do a HTTP DELETE on the review URI, no request body or additional headers needed
  $oauth->fetch($review_uri, NULL, OAUTH_HTTP_METHOD_DELETE);

  $response = $oauth->getLastResponseInfo();
  $response_body = $oauth->getLastResponse();

  // A successful delete returns a "200 OK"
  // everything else a status code in the 400 range
  if ($response['http_code'] == 200) {
    print "Successfully deleted the review";
  } else {
    print $response_body;
  }

  print "\n";
} catch(OAuthException $E) {
  print_r($E);
}
