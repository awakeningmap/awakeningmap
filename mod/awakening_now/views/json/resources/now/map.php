<?php

$svc = elgg()->maps;
/* @var $svc \hypeJunction\MapsOpen\MapsService */

$location = get_input('location');
$lat = get_input('lat');
$long = get_input('long');
	
if ($location) {
	if ($lat && $long) {
		$location = new \hypeJunction\MapsOpen\LatLong($lat, $long, $location);
	} else {
		$location = \hypeJunction\MapsOpen\LatLong::fromLocation($location);
	}
} else if ($lat && $long) {
	$location = \hypeJunction\MapsOpen\LatLong::fromLatLong($lat, $long);
}

if (!$location) {
	$location = $svc->getDefaultMapCenter();
}

$radius = get_input('radius');
if (!$radius) {
	$radius = 1000;
}

$query = get_input('query', '');

$dbprefix = elgg_get_config('dbprefix');
$options = [
	'type' => 'object',
	'subtype' => \Awakenings\Now\NowEvent::SUBTYPE,
	'limit' => 0,
	'batch' => true,
];

$options = $svc->addLocationSearchClauses($options, $location, $radius);

$users = elgg_get_entities($options);

elgg_set_viewtype('default');

$markers = [];

foreach ($users as $user) {
	$marker = $svc->getMarker($user);
	$marker->icon = 'far fa-clock';

	$markers[] = $marker->toArray();
}

$response['markers'] = $markers;
$response['search'] = [
	'query' => $query,
	'radius' => $radius,
	'location' => $location->getLocation(),
	'lat' => $location->getLat(),
	'long' => $location->getLong(),
];

elgg_set_http_header('Content-Type: application/json');
echo json_encode($response);
return;
