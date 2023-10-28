<?php

    header('Content-Type: application/json; charset=utf-8');
    /*-------------------------------------
        IP Check - Only certain IPs can
        run this script.
    --------------------------------------*/
    function getUserIpAddr(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    $allowedIps = ['<IP_ADDRESS_1','IP_ADDRESS_2'];
    $userIP = getUserIpAddr();

    if (in_array($userIP, $allowedIps)) {
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

    } else {

        echo 'Your not on the list. So you can not come in!';

    }
?>