Qype API PHP examples
=====================

These files are are a command line based example for doing the OAuth dance
in PHP for the Qype API. Most of the resources in the API are actually read
only but if you want to review places, upload photos or checkin you need
to authenticate your users using OAuth.

See [http://apidocs.qype.com/readwriteaccess](http://apidocs.qype.com/readwriteaccess)
to read about the details.

These PHP examples use the [pecl oauth](http://pecl.php.net/package/oauth)
extension which is considered the de facto standard according
to [the official site](http://oauth.net/code/).

Step 0
------

Configure PHP to have the oauth extension installed (if it's not already there)

    $ pecl install oauth

Get an API key [here](http://www.qype.co.uk/api_consumers) and put the
consumer key and secret into the `config.php` file.


Step 1
------

Ask the API for a request token.

    $ php 1_request_token.php

This should get the request token from the API and store it in a temporary
file. You now need to authorize this token. So just open the displayed URL
in a browser and click yes.

Copy the displayed verifier.


Step 2
------

Exchange the authorized request token for an access token.

    $ php 2_access_token.php <copied verifier>

This will return a valid access token which you normally store in your
database. Here it's also stored in a temporary file so that we can use for
further requests.


Step 3
------

Test if it actually works.

    $ php 3_test_request.php

This does a simple test request with the stored access token.


Creating, updating and deleting reviews
---------------------------------------

A more evolved example of how to do the different HTTP requests
to update data:

Create a new review on the [API sandbox place](http://www.qype.co.uk/place/537582-Qype-API-sandbox-Hamburg):

    $ php review_create.php

Should display a URI to www.qype.co.uk and one to the API. You use the API URI
to for the two other scripts.

Update the review:

    $ php review_update.php http://api.qype.com/v1/reviews/ID_OF_YOUR_REVIEW


Delete the review:

    $ php review_update.php http://api.qype.com/v1/reviews/ID_OF_YOUR_REVIEW


That's it. If you have any questions please post them in the
[Qype API group](http://groups.google.com/group/qype-api)

