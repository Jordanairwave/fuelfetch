<?php

    header('Content-Type: application/json; charset=utf-8');

    //echo 'Starting Getting Fuel Prices Data</br>';

    /*-------------------------------------
        URL of JSON file to get
    --------------------------------------*/
    $clientURL = 'https://<URL_OF_WEBSITE/dataclient.json';

    /*-------------------------------------
        CURL to get JSON file.
    --------------------------------------*/
    //echo 'Fetching Data from client</br>';


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS | CURLPROTO_HTTP);
    curl_setopt($ch, CURLOPT_REDIR_PROTOCOLS, CURLPROTO_HTTPS);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_URL, $clientURL);
    $jsonFile = curl_exec($ch);
    curl_close($ch);

    //echo 'Finished Fetching Data from Client</br>';


    echo $jsonFile;

    //echo 'All done!';

?>