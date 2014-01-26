<?php
require_once __DIR__.'/vendor/autoload.php';

$config = require_once __DIR__.'/config/config.php';

$client = new \Guzzle\Http\Client($config['base_url']);

$feeds = $config['feeds'];

$xmlResponses = array();

foreach ($feeds as $name => $uri) { 
	$request = $client->get($uri);
	$response = $request->send();

	$xmlResponses[formatKey($name)] = filterXmlResponse($response->xml());
}

echo json_encode($xmlResponses, true);

//	#############
//	# Functions #
//  #############

function filterXmlResponse(\SimpleXmlElement $xml){ 
	$entries = array();

	$count = 0;
	foreach($xml->entry as $k => $child){
		if ($count){ 
			$entries[] = $child;
		}
		$count++;
	}

	return $entries;
}

function formatKey($string){
	return ucwords(str_replace('_',' ',$string));
}
