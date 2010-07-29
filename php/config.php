<?php

// we use the pecl oauth library, make sure it's loaded
dl('oauth.so');

$consumer_key    = 'YOUR_CONSUMER_KEY';
$consumer_secret = 'YOUR_CONSUMER_SECRET';

$request_token_endpoint = 'http://api.qype.com/oauth/request_token';
$access_token_endpoint  = 'http://api.qype.com/oauth/access_token';
$authorize_endpoint     = 'http://www.qype.com/mobile/authorize';

define('OAUTH_TMP_DIR', function_exists('sys_get_temp_dir') ? sys_get_temp_dir() : realpath($_ENV["TMP"]));

$oauth = new OAuth($consumer_key, $consumer_secret, OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_URI);

function set_access_token($oauth) {
  $access_token = unserialize(file_get_contents(OAUTH_TMP_DIR . "/access_token_resp"));
  if (!$access_token) {
    print "\nNo access token found, please first do the OAuth dance\n";
    exit;
  } else {
    $oauth->setToken($access_token["oauth_token"], $access_token["oauth_token_secret"]);
  }
}

?>
