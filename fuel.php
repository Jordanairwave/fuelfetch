<?php

    /*-------------------------------------
        IP Check - Only certain IPs can
        run this script.
    --------------------------------------*/
    $allowedIps = ['<IP_ADDRESS_1'];
    $userIP = array_values(array_filter(explode(',',$_SERVER['HTTP_X_FORWARDED_FOR'])));

    if (array_intersect($userIP, $allowedIps)) {
        /*-------------------------------------
            URL of JSON file to get
        --------------------------------------*/
        $clientURL = 'https://<URL_OF_WEBSITE/dataclient.json';

        /*-------------------------------------
            CURL to get JSON file.
        --------------------------------------*/
        echo 'Fetching Data from client</br>';


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

        echo 'Finished Fetching Data from Client</br>';

        /*-------------------------------------
            Add JSON to new file on our server
        --------------------------------------*/ 
        echo 'Adding Data to new file</br>';
        file_put_contents('data.json', $jsonFile);

        echo 'All done!';

    } else {

        echo 'Your not on the list. So you can not come in!';

    }
?>