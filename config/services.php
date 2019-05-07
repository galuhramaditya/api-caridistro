<?php

return [
	'google' => [
	    'client_id' 	=> env('GOOGLE_CLIENT_ID'),         // Your GOOGLE Client ID
	    'client_secret'	=> env('GOOGLE_CLIENT_SECRET'), // Your GOOGLE Client Secret
	    'redirect' 		=> env('GOOGLE_REDIRECT'),
	],
	'facebook' => [
	    'client_id' 	=> env('FACEBOOK_CLIENT_ID'),         // Your FACEBOOK Client ID
	    'client_secret'	=> env('FACEBOOK_CLIENT_SECRET'), // Your FACEBOOK Client Secret
	    'redirect' 		=> env('FACEBOOK_REDIRECT'),
	]
];