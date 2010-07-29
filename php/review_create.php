<?php
require_once ('config.php');

// simple function for doing link reflection on the response
function find_link($array, $rel) {
  foreach ($array as $link) {
    if ($link->rel == $rel)
      return $link->href;
  }
}

// Creates a new review on the API sandbox place
// http://www.qype.co.uk/place/537582-Qype-API-sandbox-Hamburg
try {
  set_access_token($oauth);

  $review = file_get_contents("../data/review.json");

  $oauth->fetch("http://api.qype.com/v1/places/537582/reviews", // the URI to POST to
                $review,                                        // JSON representation of a review
                OAUTH_HTTP_METHOD_POST,                         // use the HTTP method POST
                array("Content-Type" => "application/json", "Accept" => "application/json") // the API needs to know we're sending and expecting JSON
  );

  $response = $oauth->getLastResponseInfo();
  $response_body = $oauth->getLastResponse();

  // A successful creation returns with "201 Created" and the
  // response body includes the newly created review in JSON
  if ($response['http_code'] == 201) {
    $review_json = json_decode($response_body);

    print "Successfully created this review\n";
    print "On Qype:    " . find_link($review_json->review->links, 'alternate') . "\n";
    print "On the API: " . find_link($review_json->review->links, 'self');
  } else {
    print $response_body;
  }

  print "\n";
} catch(OAuthException $E) {
  print_r($E);
}
