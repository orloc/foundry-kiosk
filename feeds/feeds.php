<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__.'/vendor/autoload.php';

$config = require_once __DIR__.'/config/config.php';

$client = new \Guzzle\Http\Client($config['base_url']);
$preProcessor = new Preprocessor();

$feeds = $config['feeds'];

$xmlResponses = array();

$count = 0;
foreach ($feeds as $name => $uri) { 
	$request = $client->get($uri);
	$response = $request->send();

	$arr = json_decode(json_encode($preProcessor->enhanceXmlResponse($response->xml(), $name), true));
	$xmlResponses[$preProcessor->formatKey($name)] = array_reverse($arr);
		
}

echo json_encode($xmlResponses, true);
