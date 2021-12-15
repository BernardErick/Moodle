<?php
require('../../config.php');

$curl = curl_init();
global $USER, $CFG;


curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://digitallibrary.zbra.com.br/DigitalLibraryIntegrationService/AuthenticatedUrl',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => '<?xml version="1.0" encoding="utf-8"?>
<CreateAuthenticatedUrlRequest 
	xmlns="http://dli.zbra.com.br" 
	xmlns:xsd="http://www.w3.org/2001/XMLSchema"
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
		<FirstName>'.$USER->firstname.'</FirstName> 
		<LastName>'.$USER->lastname.'</LastName>
		<Email>'.$USER->email.'</Email>
		<CourseId xsi:nil="true"/>
		<Tag xsi:nil="true"/>
		<Isbn xsi:nil="true"/>
</CreateAuthenticatedUrlRequest>',
    CURLOPT_HTTPHEADER => array(
        'Content-type: text/xml',
        'X-DigitalLibraryIntegration-API-Key: 8fd46853-0882-430c-ae39-37eb87276b11'
    ),
));


$curl_response = curl_exec($curl);
curl_close($curl);

$xml= new SimpleXMLElement($curl_response);

header("location:{$xml->AuthenticatedUrl}");

