<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

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

	foreach($xml->entry as $k => $child){
		$meta = parseSummaryForDate($child->summary);
		$entries[] = $child;
	}

	return $entries;
}

/*
 * Manipulates summary field to find start and end dates
 * @var \SimpleXmlElement
 * @return array
 */
function parseSummaryForDate(\SimpleXmlElement $summary) {
	$str = strtolower($summary->__toString());

	$duration = substr($str, 0, strpos($str,'<br>'));

	$start = substr($duration, 6, strpos($duration, ' to ') - 6);

	$end = substr($duration, 
		(strpos($duration, 'to')+3), 
		strlen(substr($duration, (strpos($duration, 'to')+3)))-10
	);

	$tz = substr($duration, -3);

	var_dump($duration, $start, $end, $tz);
}

function formatKey($string){
	return ucwords(str_replace('_',' ',$string));
}
