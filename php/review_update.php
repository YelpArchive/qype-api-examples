<?php
require_once ('config.php');

if (count($_SERVER['argv']) != 2) {
  print "Usage: php review_update.php <api URI of review>\n";
  exit;
}
$review_uri = $_SERVER['argv'][1];

// Updates an existing review
try {
  set_access_token($oauth);

  $review = file_get_contents("../data/review.json");

  $oauth->fetch($review_uri,           // the URI of the review
                $review,               // JSON representation of a review
                OAUTH_HTTP_METHOD_PUT, // do a HTTP PUT for updating a review
                array("Content-Type" => "application/json", "Accept" => "application/json") // the API needs to know we're sending and expecting JSON
  );

  $response = $oauth->getLastResponseInfo();
  $response_body = $oauth->getLastResponse();

  if ($response['http_code'] == 200) {
    print "Successfully updated this review";
  } else {
    print $response_body;
  }

  print "\n";
} catch(OAuthException $E) {
  print_r($E);
}
