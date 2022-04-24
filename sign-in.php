<?php
session_start();

use App\FourtyTwo;

error_reporting(E_ALL);
ini_set("display_errors", 1);

require("vendor/autoload.php");

require("app/Autoloader.php");
\App\Autoloader::register();

$client_id = FourtyTwo::getUid();
$client_secret = FourtyTwo::getPrivate();

$client = new OAuth2\Client($client_id, $client_secret);

if (!isset($_GET['code']))
{
	$auth_url = $client->getAuthenticationUrl(FourtyTwo::get_authorization_endpoint(), FourtyTwo::get_redirect_uri());
	header('Location: ' . $auth_url);
	die('Redirect');
}
else
{
	$params = array('code' => $_GET['code'], 'redirect_uri' => FourtyTwo::get_redirect_uri());
	$response = $client->getAccessToken(FourtyTwo::get_token_endpoint(), 'authorization_code', $params);
	$client->setAccessToken($response['result']['access_token']);
	$response = $client->fetch('https://api.intra.42.fr/v2/me');

	$_SESSION["user"] = array(
		"id" => $response["result"]["id"],
		"displayname" => $response["result"]["displayname"],
		"img" => $response["result"]["new_image_url"]
	);

	header('Location: index.php');
	die('Redirect');
}