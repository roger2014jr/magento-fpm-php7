<?php

require '../../vendor/autoload.php';

use \DTS\eBaySDK\Shopping\Services;
use \DTS\eBaySDK\Shopping\Types;

// Create the service object.
$service = new Services\ShoppingService(array(
    'apiVersion' => '863',
    'appId' => 'DirectCa-0424-466f-abc0-e2c14fe8fb36'
));

// Create the request object.
$request = new Types\GeteBayTimeRequestType();

// Send the request to the service operation.
$response = $service->geteBayTime($request);

// Output the result of calling the service operation.
printf("The official eBay time is: %s\n", $response->Timestamp->format('H:i (\G\M\T) \o\n l jS Y'));