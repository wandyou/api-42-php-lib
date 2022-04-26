<?php

namespace FourtyTwo;

/*
	CHANGE ONLY THIS INFORMATION

	These are the values you can change to fit your app (create a new app threw your intra : https://profile.intra.42.fr/oauth/applications/)
	I highly recommend creating two apps (prod and dev).

*/
//const REDIRECT_URI = "http://localhost:8888/phoenix-dashboard/sign-in.php";
const REDIRECT_URI = "http://localhost:8888/api-42-php-lib/sign-in.php";
const UID = "e4b69796f35613ac811b4c3df345aab46a0005ee87f6c101d4f0fb978aaef907";
const SECRET = "640471a04755e191dca31572322f6a8e9a1845c002543fdd05cc0e1560abff4a";

const DEV_MODE = 0; // Change to 1 to switch to dev mode
const DEV_UID = "";
const DEV_SECRET = "";

/*

	DO NOT TOUCH

	These are the consts, needed for the app to work

*/
const API_ENDPOINT = "https://api.intra.42.fr/";
const AUTHORIZATION_ENDPOINT = "https://api.intra.42.fr/oauth/authorize";
const TOKEN_ROUTE = "oauth/token";
const TOKEN_ENDPOINT = "https://api.intra.42.fr/oauth/token";

$GLOBALS["token"] = "";
$GLOBALS[""] = "";

class FourtyTwo
{
	protected static $token_expire = 0;
	protected static $_token = "";

	public static function get_authorization_endpoint() { return AUTHORIZATION_ENDPOINT; }
	public static function get_redirect_uri() { return REDIRECT_URI; }
	public static function get_token_endpoint() { return TOKEN_ENDPOINT; }

	public static function getToken()
	{
		if ($GLOBALS["token"] == ""):
			$data = array(
			"grant_type" => "client_credentials"
			);
			$result = self::makeRequest(TOKEN_ROUTE, $data, 'POST');

			$GLOBALS["token"] = $result->access_token;
		endif;

		self::$_token = $GLOBALS["token"];
		return (self::$_token);
	}

	public static function makeRequest($url, $data = false, $method = "GET", $options = NULL)
	{
		$tmp_url = "v2/" . $url;
		if (empty($data))
			$data = array("access_token" => self::getToken());

		$data["client_id"] = self::getUid();
		$data["client_secret"] = self::getPrivate();

		$request_options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => $method,
			'content' => http_build_query($data)
		)
		);

		// Handle the options
		if ($options != NULL)
		{
			$options_url = $options->generate();

			if ($options_url != "")
				if (!str_contains($tmp_url, '?'))
					$tmp_url .= "?";

			$tmp_url .= $options_url;
		}

		$context  = stream_context_create($request_options);
		$result = file_get_contents(API_ENDPOINT . $tmp_url, false, $context);

		if (str_contains($http_response_header[0], "429"))
		{
			preg_match_all('!\d+!', $http_response_header[6], $matches);
			sleep($matches[0][0]);
			return (self::makeRequest($url, $data, $method, $options));
		}
		else if ($result === FALSE)
			return "error";

		return (json_decode($result));
	}

	public static function getUid()
	{
		if (DEV_MODE)
		return (DEV_UID);
		else
		return (UID);
	}

	public static function getPrivate()
	{
		if (DEV_MODE)
		return (DEV_SECRET);
		else
		return (SECRET);
	}
}