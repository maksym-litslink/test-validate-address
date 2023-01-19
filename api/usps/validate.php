<?php

if (false === isset($_POST['addressLine1'], $_POST['addressLine2'], $_POST['city'], $_POST['state'], $_POST['zip'])) {
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Invalid Request']);
    exit;
}

$addressLine1 = $_POST['addressLine1'];
$addressLine2 = $_POST['addressLine2'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];

$apiUrl = 'https://secure.shippingapis.com/ShippingAPI.dll';
$apiUsername = getenv('USPS_USERNAME');
if (false === $apiUsername) {
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json');
    echo json_encode(['error' => 'USPS API Username Not Set']);
    exit;
}
$apiXml = <<<XML
<AddressValidateRequest USERID="$apiUsername">
  <Revision>1</Revision>
  <Address ID="0">
    <Address1>$addressLine1</Address1>
    <Address2>$addressLine2</Address2>
    <City>$city</City>
    <State>$state</State>
    <Zip5>$zip</Zip5>
    <Zip4/>
  </Address>
</AddressValidateRequest>
XML;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'API=Verify&XML=' . $apiXml);

$response = curl_exec($ch);
curl_close($ch);

// parse the response to extract the standardized address
$xml = simplexml_load_string($response);
if (false === property_exists($xml, 'Address')) {
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Invalid USPS response']);
    exit;
}

header('Content-Type: application/json');
echo json_encode([
    'originalAddress' => [
        'addressLine1' => $addressLine1,
        'addressLine2' => $addressLine2,
        'city' => $city,
        'state' => $state,
        'zip' => $zip,
    ],
    'standardizedAddress' => [
        'addressLine1' => (string)$xml->Address->Address1,
        'addressLine2' => (string)$xml->Address->Address2,
        'city' => (string)$xml->Address->City,
        'state' => (string)$xml->Address->State,
        'zip' => (string)$xml->Address->Zip5,
    ],
]);
